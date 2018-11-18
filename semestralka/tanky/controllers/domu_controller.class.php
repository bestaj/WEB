<?php

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
        // Nastaveni globalnich promennych pro sablonu
        global $tplData;
        // Naplneni globalnich promennych
        $tplData['title'] = "Domů";
        
        //$tplData['data'] = $this->db->getAllIntroductions();
       
        if($this->db->isUserLoged()) {
            $tplData['prihlasen'] = true;
        }
        else {
            $tplData['prihlasen'] = false;
        }
       
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