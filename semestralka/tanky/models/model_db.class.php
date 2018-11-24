<?php
include_once("settings.inc.php");

class Databaze {
    
    // PDO objekt databaze
    private $db; 
    
    public function __construct() {
        global $db_server, $db_name, $db_user, $db_pass; 
        // informace se berou ze settings
        $this->db = new PDO("mysql:host=$db_server; dbname=$db_name", $db_user, $db_pass);
        session_start();
    }
    
    /**
     *  Vytvori v databazi noveho uzivatele vcetne s atributem "jmenoVeHre".
     *
     *  @return boolean Podarilo se uzivatele vytvorit
     */
    public function addNewUserWithNick($login, $heslo, $email, $jmenoVeHre){
        // Kazdy novy uzivatel ma defaultne nastaveno pravo "Recenzent"
        $idpravo = 3;
        
        $sql = "INSERT INTO uzivatel(login,heslo,email,jmenoVeHre,idpravo)
                VALUES (:login,:heslo,:email,:jmenoVeHre,:idpravo)";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':login', $login);
        $query->bindParam(':heslo', $heslo);
        $query->bindParam(':email', $email);
        $query->bindParam(':jmenoVeHre', $jmenoVeHre);
        $query->bindParam(':idpravo', $idpravo);
        
        $res = $this->executeQuery($query);
        if($res == null){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *  Vytvori v databazi noveho uzivatele.
     *
     *  @return boolean Podarilo se uzivatele vytvorit
     */
    public function addNewUser($login, $heslo, $email){
        // Kazdy novy uzivatel ma defaultne nastaveno pravo "Recenzent"
        $idpravo = 3;
        
        $sql = "INSERT INTO uzivatel(login,heslo,email,idpravo)
                VALUES (:login,:heslo,:email,:idpravo)";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':login', $login);
        $query->bindParam(':heslo', $heslo);
        $query->bindParam(':email', $email);
        $query->bindParam(':idpravo', $idpravo);
        
        $res = $this->executeQuery($query);
    
        if($res == null){
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *  Overi heslo uzivatele a pokud je spravne, tak uzivatele prihlasi.
     *  @param string $login    Login uzivatele.
     *  @param string $pass     Heslo uzivatele.
     *  @return boolean         Podarilo se prihlasit.
     */
    public function userLogin($login, $pass){
        if(!$this->isPasswordCorrect($login,$pass)){// neni heslo spatne?
            return false; // spatne heslo
        }
        // ulozim uzivatele do session
        $_SESSION["user"] = $this->allUserInfo($login);
        return true;
    }
    
    /**
     *  Odhlasi uzivatele.
     */
    public function userLogout(){
        // odstranim session
        unset($_SESSION["user"]);
    }
    
    /**
     *  Overi, zda dany uzivatel ma dane heslo.
     *  @param string $login  Login uzivatele.
     *  @param string $pass     Heslo uzivatele.
     *  @return boolean         Jsou hesla stejna?
     */
    public function isPasswordCorrect($login, $pass) {
        $user = $this->allUserInfo($login);
        if($user == null){ // uzivatel neni v DB
            return false;
        }
        return $user["heslo"] == $pass; // je heslo stejne?
    }
    
    /** Zjisti zda je uzivatel prihlasen */
    public function isUserLoged() {
        return isset($_SESSION["user"]);
    }
    
    /**
     *  Vraci vsechny informace o uzivateli.
     *  @param string $login    Login uzivatele.
     *  @return array           Pole s informacemi o konkretnim uzivateli nebo null.
     */
    public function allUserInfo($login){
        $sql = "SELECT * FROM uzivatel, pravo
                WHERE uzivatel.login = :login
                  AND pravo.idpravo = uzivatel.idpravo;";
    
        $query = $this->db->prepare($sql);
        $query->bindParam(':login', $login);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();

        if($res != null && count($res)>0){
            // vracim pouze prvni radek, ve kterem je uzivatel
            return $res[0];
        } else {
            return null;
        }
    }
    
    /**
     *  Provede dotaz a buď vrátí jeho výsledek, nebo null a vypíše chybu.
     *  @param string $dotaz    Dotaz.
     *  @return object          Vysledek dotazu.
     */
    private function executeQuery($query){
        $res = $query->execute();
        if (!$res) {
            $error = $this->db->errorInfo();
            echo $error[2];
            return null;
        } else {
            return $res;            
        }
    }
    
    /**
     *  Prevede vysledny objekt dotazu na pole.
     *  @param object $obj  Objekt s vysledky dotazu.
     *  @return array       Pole s vysledky dotazu.
     */
    private function resultObjectToArray($obj){
        // získat po řádcích            
        /*while($row = $vystup->fetch(PDO::FETCH_ASSOC)){
            $pole[] = $row['login'].'<br>';
        }*/
        return $obj->fetchAll(); // všechny řádky do pole        
    }
}

?>