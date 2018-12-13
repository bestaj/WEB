<?php

// Kontroler domovske stranky
class DomuController {
    
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
        // Testujeme odhlaseni uzivatele
        if (isset($_POST["logout"])) {
            $this->db->userLogout();
        }
        
        $_SESSION["logoutPage"] = "domu";
    
        global $tplData;
        
        $tplData['title'] = "Domů";
        
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/domu.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
}

?>