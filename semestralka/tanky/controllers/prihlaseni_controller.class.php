<?php

// Kontroler pro stranku prihlaseni
class PrihlaseniController {
    
    private $db;
    
    public function __construct() {
        require_once("models/model_db.class.php");
        $this->db = new Databaze();
    }
    
    /**
     *  Vrati obsah stranky.
     *  @return string Obsah stranky
     */
    public function getResult() {
        global $tplData;
        
        // Overi prihlaseni uzivatele.
        $this->confirmLogin();
        
        $tplData['title'] = "Přihlášení";
        
        // Zapneme output buffer pro odchyceni vypisu sablony.
        ob_start();
        // Pripojime sablonu
        require "views/prihlaseni.php";
        
        // Ziskame obsah output bufferu, tj. vypsanou sablonu.
        $obsah = ob_get_clean();
        
        // Vratime sablonu naplnenou daty.
        return $obsah;
    }
    
    // Overi prihlaseni uzivatele.
    public function confirmLogin() {
        global $tplData;
        $tplData['prihlaseniOK'] = true;
        // prihlaseni uzivatele
        if(isset($_POST["login"])){
            $res = $this->db->userLogin(htmlspecialchars($_POST["log-in"]),htmlspecialchars($_POST["pass"])); 
            // nepovedlo se prihlasit
            if(!$res){
                $tplData['prihlaseniOK'] = false;
            }
            // uspesne prihlaseni, automaticke presmerovani na domovskou stranku
            else {
                $tplData['prihlaseniOK'] = true;
                ?>
                <script>
                    document.location.href = "http://localhost/web/sp/semestralka/tanky/index.php?page=domu";
                </script>
<?php
            }
        }
    }
}
?>