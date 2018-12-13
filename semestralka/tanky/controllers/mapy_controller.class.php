<?php

// Kontroler pro stranku se seznamem map
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
        
        // Zjistime, zda je prihlaseny uzivatel autor nebo admin
        if ($this->db->isUserLogged()) {
            if ($_SESSION["user"]["idpravo"] != 3) {
                $tplData["isA"] = true;
            }
            else {
                $tplData["isA"] = false;
            }
        }
        else {
            $tplData["isA"] = false;
        }
        
        $_SESSION["logoutPage"] = "mapy";
   
        $tplData['title'] = "Mapy";
        
        // Testujem, zda je treba provest filtraci map
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