<?php

class PrihlaseniController {
    
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
        
        // overi prihlaseni uzivatele
        $this->confirmLogin();
        // Naplneni globalnich promennych
        $tplData['title'] = "Přihlášení";
        // $tplData['data'] = $this->db->getAllIntroductions();
        
        
        
        // vypsani prislusne sablony
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/prihlaseni.php";
        
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();
        
        // vratim sablonu naplnenou daty
        return $obsah;
    }
    
    public function confirmLogin() {
        global $tplData;
        $tplData['prihlaseniOK'] = true;
        // prihlaseni uzivatele
        if(isset($_POST["login"])){
            $res = $this->db->userLogin($_POST["log-in"],$_POST["pass"]); 
            if(!$res){
                $tplData['prihlaseniOK'] = false;
            }
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