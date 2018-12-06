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
        $_SESSION["logoutPage"] = "tank";
        require "controllers/logout.php";
        
        // Nastaveni globalnich promennych pro sablonu
        global $tplData;
        
        // Naplneni globalnich promennych
        $tplData["tank"] = $this->db->getTank($_GET["tank"]);
        $tplData["title"] = "Tank ".$tplData["tank"]["nazev_tanku"];
        
        $tplData["rating"] = $this->db->getTankRating($tplData["tank"]["nazev_tanku"]);
        
        if($this->db->isUserLoged()) {
            $tplData["prihlasen"] = true;
        }
        else {
            $tplData["prihlasen"] = false;
        }
        
        // vypsani prislusne sablony
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/tank.php";
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
?>