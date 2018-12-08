<?php

class PridatTankController {
    
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
        
        if (isset($_POST["addNewTank"])) {
            $this->db->addNewTank($_POST["nazev"], $_POST["narod"], $_POST["tier"], $_POST["typ"], $_POST["vydrz"], $_POST["poskozeni"], $_POST["prubojnost"], $_POST["dpm"], $_POST["pancir_veze"], $_POST["pancir_korby"], $_POST["rychlost_dopredu"], $_POST["rychlost_dozadu"], $_POST["deprese"], $_POST["elevace"], $_POST["dohled"], $_POST["rychlost_nabijeni"], $_POST["doba_nabiti_zasobniku"], $_POST["rychlost_zamereni"], $_POST["popis"], $_FILES["img"]["name"]);
            
            $target_dir = "views/images/tanks/";
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        }
        
        $_SESSION["logoutPage"] = "domu";
    
        global $tplData;
        
        // Naplneni globalnich promennych
        $tplData["title"] = "Nový tank";
        
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/pridat_tank.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
}

?>