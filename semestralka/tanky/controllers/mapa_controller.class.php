<?php

class MapaController {
    
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
            $tplData["mapa"] = $this->db->getMap($_SESSION["itemId"]);
        }
        
        
        
        $_SESSION["logoutPage"] = "mapa";
        if (isset($_GET["mapa"])) {
            $_SESSION["itemId"] = $_GET["mapa"];
            
        }
        
        // Naplneni globalnich promennych
        $tplData["mapa"] = $this->db->getMap($_SESSION["itemId"]);
        
        if (isset($_POST["rating"])) {
            $this->db->saveMapRating($_SESSION["user"]["iduzivatel"],$tplData["mapa"]["idmapa"],$_POST["vyvazenost"], $_POST["vegetace"], $_POST["budovy"], $_POST["spotovani"], $_POST["manevrovani"], $_POST["koridorova"], $_POST["kempeni"], date("Y-m-d"));
        }
        
        // Testujeme zadost pro novy prispevek
        if (isset($_POST["addReport"])) {
            $this->db->saveMapReport($_SESSION["user"]["iduzivatel"], $tplData["mapa"]["idmapa"], $_POST["popis"], date("Y-m-d"));
        }
        
        $tplData["title"] = "Mapa ".$tplData["mapa"]["nazev_mapy"];
        $tplData["rating"] = $this->db->getMapRating($tplData["mapa"]["nazev_mapy"]);
        $tplData["reports"] = $this->db->getAllMapReports($_SESSION["itemId"]);
        
        if($this->db->isUserLogged()) {
            $tplData["isUserLogged"] = true;
        }
        else {
            $tplData["isUserLogged"] = false;
        }
        
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/mapa.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
}
?>