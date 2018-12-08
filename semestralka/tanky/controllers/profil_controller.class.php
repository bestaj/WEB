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
        global $tplData;
        
        $this->confirmUserChanges();
        
        $_SESSION["logoutPage"] = "domu";
        
        if (isset($_POST["changeRight"])) {
            $this->db->changeRight($_POST["uzivatel"], $_POST["pravo"]);
        }
     
        // Nastaveni nazvu stranky
        $tplData["title"] = "Profil uživatele ".$_SESSION['user']['login'];
        
        /* Ulozime si hodnotu, ktera nam rika, jaky obsah profilu se ma zobrazit v sablone
                i) profil bez moznosti zmeny udaju
                ii) okno pro zmenu udaju uzivatele
        */
        if (isset($_POST["changeUserInfoON"])) {
            $tplData["userInfoChange"] = true;
        }else {
            $tplData["userInfoChange"] = false;
        }
        
        $tplData["reports"] = $this->db->getAllUserReports($_SESSION["user"]["login"]);
        $tplData["rights"] = $this->db->getAllRights();
        $tplData["users"] = $this->db->getAllUsers($_SESSION["user"]["login"]);
        $tplData["userRight"] = $this->db->getRight($_SESSION["user"]["login"]);
        $tplData["isAdmin"] = $_SESSION["user"]["idpravo"] == 1 ? true : false;
        
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/profil.php";
        // Ziskame obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // Vratime sablonu naplnenou daty
        return $obsah;
    }
    
    /* Testuje zda si uzivatel nezmenil heslo nebo jmeno ve hre */
    public function confirmUserChanges() {
        if (isset($_POST["changePassword"])) {
            $this->db->changePassword($_POST["newPass"]);
        }
        
        if (isset($_POST["changeNick"])) {
            $this->db->changeGameNick($_POST["gameNick"]);
        }
    }
}