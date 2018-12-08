<?php

class TankController {
    
    private $db;
    
    public function __construct() {
        require_once("models/model_db.class.php");
        $this->db = new Databaze();
    }
    
    /**
     *  Vrati obsah stranky
     *  @return string Obsah stranky
     */
    public function getResult() {
        global $tplData;
        
        // Testujeme odhlaseni uzivatele
        if (isset($_POST["logout"])) {
            $this->db->userLogout();
            $tplData["tank"] = $this->db->getTank($_SESSION["itemId"]);
        }
        
        // Stranka, na kterou se prejde v pripade odhlaseni uzivatele
        $_SESSION["logoutPage"] = "tank";
        
        // Ulozime si ID tanku, ktery se ma zobrazit
        if (isset($_GET["tank"])) {
            $_SESSION["itemId"] = $_GET["tank"];    
        }
        
        
        
        // Naplneni globalnich promennych
        $tplData["tank"] = $this->db->getTank($_SESSION["itemId"]);
        
        // Testujeme zadost pro nove hodnoceni
        if (isset($_POST["rating"])) {
            $this->db->saveTankRating($_SESSION["user"]["iduzivatel"], $tplData["tank"]["idtank"], $_POST["presnost"], $_POST["nabijeni"], $_POST["rychlost"], $_POST["pohyblivost"], $_POST["dohled"], $_POST["pancir"], date("Y-m-d"));
        }
        
        // Testujeme zadost pro novy prispevek
        if (isset($_POST["addReport"])) {
            $this->db->saveTankReport($_SESSION["user"]["iduzivatel"], $tplData["tank"]["idtank"], $_POST["popis"], date("Y-m-d"));
        }
        
        $tplData["title"] = "Tank ".$tplData["tank"]["nazev_tanku"];
        $tplData["rating"] = $this->db->getTankRating($tplData["tank"]["nazev_tanku"]);
        $tplData["reports"] = $this->db->getAllTankReports($_SESSION["itemId"]);
        
        // Testujem, zda je uzivatel prihlasen
        if($this->db->isUserLogged()) {
            $tplData["isUserLogged"] = true;
        }
        else {
            $tplData["isUserLogged"] = false;
        }
        
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/tank.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
}
?>