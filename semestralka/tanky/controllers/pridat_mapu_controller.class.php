<?php

class PridatMapuController {
    
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
        
        if (isset($_POST["addNewMap"])) {
            $this->db->addNewMap($_POST["nazev"], $_POST["typ"], $_POST["velikost"], $_POST["mody"], $_POST["popis"], $_FILES["img"]["name"]);
            
            $target_dir = "views/images/maps/";
            $target_file = $target_dir.basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        }
        
        $_SESSION["logoutPage"] = "domu";
    
        global $tplData;
        
        // Naplneni globalnich promennych
        $tplData["title"] = "Nová mapa";
        
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/pridat_mapu.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
}

?>