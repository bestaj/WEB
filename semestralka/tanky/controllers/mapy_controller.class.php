<?php

class MapyController {
    
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
        $_SESSION["logoutPage"] = "mapy";
        require "controllers/logout.php";
        
        // Nastaveni globalnich promennych pro sablonu
        global $tplData;
        
        // Naplneni globalnich promennych
        $tplData['title'] = "Mapy";
        //    $tplData['data'] = $this->db->getAllIntroductions();
        
        // vypsani prislusne sablony
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/mapy.php";
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}