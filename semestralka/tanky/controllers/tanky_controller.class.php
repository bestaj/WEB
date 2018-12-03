<?php

class TankyController {
    
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
        $_SESSION["logoutPage"] = "tanky";
        require "controllers/logout.php";
        // Nastaveni globalnich promennych pro sablonu
        global $tplData;
       
        // Naplneni globalnich promennych
        $tplData['title'] = "Tanky";
        $tplData['data'] = $this->db->getAllTanks();
        
        
        // vypsani prislusne sablony
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/tanky.php";
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
?>