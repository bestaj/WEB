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
        global $tplData;
        
        // Testujeme odhlaseni uzivatele
        if (isset($_POST["logout"])) {
            $this->db->userLogout();
        }
        
        $_SESSION["logoutPage"] = "mapy";
        
        // Naplneni globalnich promennych
        $tplData['title'] = "Mapy";
        
        if (isset($_POST["filtruj"])) {
            $tplData["maps"] = $this->db->filterMaps($_POST["typ"], $_POST["mod"]);
        }
        else {
            $tplData["maps"] = $this->db->getAllMaps();     
        }
    
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/mapy.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
}