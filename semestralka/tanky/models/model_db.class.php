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
        $q = "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'";
        $this->db->query($q);
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
    
    /** Zmeni heslo uzivatele */
    public function changePassword($newPass) {
        $sql = "UPDATE uzivatel SET heslo = :newPass WHERE login = :login";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':newPass', $newPass);
        $query->bindParam(':login', $_SESSION['user']['login']);
    
        $res = $this->executeQuery($query);
    
        if($res == null){
            return false;
        } else {
            $_SESSION["user"] = $this->allUserInfo($_SESSION["user"]["login"]);
            return true;
        }
    }
    
    /** Zmeni uzivateli jmeno ve hre */
    public function changeGameNick($newNick) {
        $sql = "UPDATE uzivatel SET jmeno_ve_hre = :newNick WHERE login = :login";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':newNick', $newNick);
        $query->bindParam(':login', $_SESSION['user']['login']);
    
        $res = $this->executeQuery($query);
        
        if($res == null){
            return false;
        } else {
            $_SESSION["user"] = $this->allUserInfo($_SESSION["user"]["login"]);
            return true;
        }
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
        
        $sql = "SELECT u.login, u.heslo, u.email, u.jmeno_ve_hre, p.nazev 
                FROM uzivatel u, pravo p
                WHERE u.login = :login AND p.idpravo = u.idpravo;";
    
        $query = $this->db->prepare($sql);
        $query->bindParam(':login', $login);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        /*
        if($res == null) {
            echo "neexistuje";
        }
        else {
            foreach($res[0] as $p) {
               echo $p;
            }
        }
        */
        if($res != null && count($res) > 0){
            return $res[0];
        } else {
            return null;
        }
    }
    
    public function getAllTanks() {
        $sql = "SELECT * FROM tank;";
        $query = $this->db->prepare($sql);
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
    
        foreach($res as $r) {
            $pole[$r["nazev_tanku"]]["id"] = $r["idtank"];
            $pole[$r["nazev_tanku"]]["nazev"] = $r["nazev_tanku"];
            $pole[$r["nazev_tanku"]]["narod"] = $r["narod"];
            $pole[$r["nazev_tanku"]]["uroven"] = $r["uroven"];
            $pole[$r["nazev_tanku"]]["typ"] = $r["typ"];
            $pole[$r["nazev_tanku"]]["popis"] = $r["popis"];
            $pole[$r["nazev_tanku"]]["vydrz"] = $r["vydrz"];
            $pole[$r["nazev_tanku"]]["poskozeni"] = $r["poskozeni"];
            $pole[$r["nazev_tanku"]]["prubojnost"] = $r["prubojnost"];
            $pole[$r["nazev_tanku"]]["dpm"] = $r["dpm"];
            $pole[$r["nazev_tanku"]]["vez"] = $r["pancir_veze"];
            $pole[$r["nazev_tanku"]]["korba"] = $r["pancir_korby"];
            $pole[$r["nazev_tanku"]]["dopredu"] = $r["max_rychlost_dopredu"];
            $pole[$r["nazev_tanku"]]["dozadu"] = $r["max_rychlost_dozadu"];
            $pole[$r["nazev_tanku"]]["deprese"] = $r["deprese_dela"];
            $pole[$r["nazev_tanku"]]["elevace"] = $r["elevace_dela"];
            $pole[$r["nazev_tanku"]]["dohled"] = $r["dohled"];
            $pole[$r["nazev_tanku"]]["nabijeni"] = $r["rychlost_nabijeni"];
            $pole[$r["nazev_tanku"]]["nabijeni_zasobniku"] = $r["cas_nabiti_celeho_zasobniku"];
            $pole[$r["nazev_tanku"]]["zamereni"] = $r["rychlost_zamereni"];
            $pole[$r["nazev_tanku"]]["img"] = $r["img"];
        }
        
        return $pole;
    }
    
    /**
     *  Provede dotaz a buď vrátí jeho výsledek, nebo null a vypíše chybu.
     *  @param string $dotaz    Dotaz.
     *  @return object          Vysledek dotazu.
     */
    private function executeQuery($query){
        // dotaz kvuli diakritice cestiny
        
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
    /*
    private function resultObjectToArray($obj){
        // získat po řádcích            
        /*while($row = $vystup->fetch(PDO::FETCH_ASSOC)){
            $pole[] = $row['login'].'<br>';
        }
        return $obj->fetchAll(); // všechny řádky do pole        
    }
        */

    
}

?>