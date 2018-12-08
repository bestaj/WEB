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
        global $tplData;
        
        // Testujeme odhlaseni uzivatele
        if (isset($_POST["logout"])) {
            $this->db->userLogout();
        }
        
        $_SESSION["logoutPage"] = "tanky";
        
        // Naplneni globalnich promennych
        $tplData['title'] = "Tanky";
        
        if (isset($_POST["filtruj"])) {
            echo $_POST["uroven"];
            $tplData["tanks"] = $this->db->filterTanks($_POST["narod"], $_POST["typ"], $_POST["uroven"]);
        }
        else {
            $tplData["tanks"] = $this->db->getAllTanks();     
        }
      
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/tanky.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
}
?>