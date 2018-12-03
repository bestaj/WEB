<?php

class ProfilController {
    
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
        $_SESSION["logoutPage"] = "domu";
        require "controllers/logout.php";
        $this->confirmUserChanges();
        
        // Nastaveni globalnich promennych pro sablonu
        global $tplData;
        
        // Naplneni globalnich promennych
        $tplData["title"] = "Profil uživatele ".$_SESSION['user']['login'];
        
        if($this->db->isUserLoged()) {
            $tplData["prihlasen"] = true;
        }
        else {
            $tplData["prihlasen"] = false;
        }
        
        // vypsani prislusne sablony
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/profil.php";
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
    
    public function confirmUserChanges() {
        if (isset($_POST["changePassword"])) {
            $this->db->changePassword($_POST["newPass"]);
        }
        
        if (isset($_POST["changeNick"])) {
            $this->db->changeGameNick($_POST["gameNick"]);
        }
    }
}