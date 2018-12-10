<?php

class RegistraceController {
    
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
        $this->confirmRegistration();
        // Naplneni globalnich promennych
        $tplData['title'] = "Registrace";
        // $tplData['data'] = $this->db->getAllIntroductions();
        
        // vypsani prislusne sablony
        // Zapneme output buffer pro odchyceni vypisu sablony
        ob_start();
        // Pripojime sablonu
        require "views/registrace.php";
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
    
    // stara se o registraci noveho uzivatele
    public function confirmRegistration() {
        global $tplData;
        $tplData['loginAlreadyExist'] = false;
        $tplData['differentPassword'] = false;
        
        // zpracovani formulace
        if(isset($_POST['potvrzeni'])){ // nova registrace
            if($_POST["pass1"]==$_POST["pass2"]){
                if($this->db->allUserInfo($_POST["log-in"])!=null){ // tento uzivatel uz existuje
                    $tplData['loginAlreadyExist'] = true;
                } else {
                    $this->db->addNewUser(htmlspecialchars($_POST["log-in"]), htmlspecialchars($_POST["pass1"]), htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["nick"]));         
                   
                    $this->db->userLogin($_POST["log-in"],$_POST["pass1"]);
                    ?>
                    <script>
                        document.location.href = "http://localhost/web/sp/semestralka/tanky/index.php?page=domu";
                    </script>
                    <?php
                }
            } else {
                $tplData['differentPassword'] = true;
            }
        }
    }
}

?>