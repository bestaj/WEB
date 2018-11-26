<?php

class DomuController {
    
    private $db;
    // Nastaveni globalnich promennych pro sablonu
    
    
    public function __construct() {
        require_once("models/model_db.class.php");
        $this->db = new Databaze();
    }
    
    
    /**
     *  Vrati obsah stranky
     *  @return string Obsah stranky
     */
    public function getResult() {
        $_SESSION["logoutPage"] = "domu";
        require "controllers/logout.php";
    
        global $tplData;
        
    
        // Naplneni globalnich promennych
        $tplData['title'] = "Domů";
        /*
        foreach($pole as $r) {
            echo $r;
        }
        */
        //$tplData['data'] = $this->db->getAllIntroductions();
        
        // vypsani prislusne sablony
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/domu.php";
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}

?>