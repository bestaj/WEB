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
        $_SESSION["logoutPage"] = "mapa";
        require "controllers/logout.php";
        
        // Nastaveni globalnich promennych pro sablonu
        global $tplData;
        
        // Naplneni globalnich promennych
        $tplData["mapa"] = $this->db->getMap($_GET["mapa"]);
        $tplData["title"] = "Mapa ".$tplData["mapa"]["nazev_mapy"];
        $tplData["rating"] = $this->db->getMapRating($_SESSION["item"]["nazev_mapy"]);
        
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
        require "views/mapa.php";
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
?>