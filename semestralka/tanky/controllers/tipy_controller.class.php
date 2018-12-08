<?php

class TipyController {
    
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
        }
        
        $_SESSION["logoutPage"] = "tipy"; 
        
        // Naplneni globalnich promennych
        $tplData['title'] = "Rady a tipy";
       
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/tipy.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
}