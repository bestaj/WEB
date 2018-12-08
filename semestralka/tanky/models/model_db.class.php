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
        // dotaz kvuli diakritice cestiny
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
        
        $sql = "INSERT INTO uzivatel VALUES (:login,:heslo,:email,:jmenoVeHre,:idpravo)";
        
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
        
        $sql = "SELECT u.iduzivatel, u.login, u.heslo, u.email, u.jmeno_ve_hre, u.idpravo, p.nazev 
                FROM uzivatel u, pravo p
                WHERE u.login = :login AND p.idpravo = u.idpravo;";
    
        $query = $this->db->prepare($sql);
        $query->bindParam(':login', $login);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();

        if($res != null && count($res) > 0){
            return $res[0];
        } else {
            return null;
        }
    }
    
    /* Vrati vsechny tanky */
    public function getAllTanks() {
        $sql = "SELECT * FROM tank ORDER BY narod, uroven, typ;";
        $query = $this->db->prepare($sql);
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
    
        foreach($res as $r) {
            $newRes[$r["nazev_tanku"]] = $r;
        }
        return $newRes;
    }
    
    /* Vrati vsechny tanky podle filtru */
    public function filterTanks($narod, $typ, $uroven) {
        $sql = "SELECT * FROM tank t WHERE t.narod = :narod AND t.typ = :typ AND t.uroven = :uroven;";
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':narod', $narod);
        $query->bindParam(':typ', $typ);
        $query->bindParam(':uroven', $uroven);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
    
        
        if ($res != null) {
            foreach($res as $r) {
                $newRes[$r["nazev_tanku"]] = $r;
            }
            return $newRes;
        }
        else {
            return null;
        }
    }
    
    /* Vrati vsechny mapy */
    public function getAllMaps() {
        $sql = "SELECT * FROM mapa ORDER BY typ;";
        $query = $this->db->prepare($sql);
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
    
        foreach($res as $r) {
            $newRes[$r["nazev_mapy"]] = $r;
        }
        return $newRes;
    }
    
    /* Vrati vsechny mapy podle filtru */
    public function filterMaps($typ, $mod) {
        $sql = "SELECT * FROM mapa m WHERE m.typ = :typ AND m.mod LIKE %:mod%;";
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':typ', $typ);
        $query->bindParam(':mod', $mod);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
    
        
        if ($res != null) {
            foreach($res as $r) {
                $newRes[$r["nazev_mapy"]] = $r;
            }
            return $newRes;
        }
        else {
            return null;
        }
    }
    
    /* Vrati vsechny prispevky daneho uzivatele */
    public function getAllUserReports($login) {
        $sql = "SELECT n.nazev_tanku AS nazev, n.popis, n.datum_prispevku FROM 
                (SELECT t.nazev_tanku, p.popis, p.datum_prispevku, p.iduzivatel FROM tank t INNER JOIN prispevek_k_tanku p ON t.idtank = p.idtank) AS n
                WHERE n.iduzivatel = (SELECT uzivatel.iduzivatel FROM uzivatel WHERE uzivatel.login = :login)
                UNION 
                SELECT n.nazev_mapy AS nazev, n.popis, n.datum_prispevku FROM 
                (SELECT m.nazev_mapy, p.popis, p.datum_prispevku, p.iduzivatel FROM mapa m INNER JOIN prispevek_k_mape p ON m.idmapa = p.idmapa) AS n
                WHERE n.iduzivatel = (SELECT uzivatel.iduzivatel FROM uzivatel WHERE uzivatel.login = :login);";
            
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':login', $login);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        
        return $res;
    }
    
    /* Vrati vsechny prispevky k dane mape */
    public function getAllTankReports($idtank) {
        $sql = "SELECT n.popis, n.datum_prispevku, u.login FROM (SELECT * FROM prispevek_k_tanku p WHERE p.idtank = :idtank ORDER BY datum_prispevku DESC) n, uzivatel u WHERE n.iduzivatel = u.iduzivatel;";
        
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':idtank', $idtank);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        return $res;
    } 

    
    
    /* Vrati vsechny prispevky k dane mape */
    public function getAllMapReports($idmapa) {
        $sql = "SELECT n.popis, n.datum_prispevku, u.login FROM (SELECT * FROM prispevek_k_mape p WHERE p.idmapa = :idmapa ORDER BY datum_prispevku DESC) n, uzivatel u WHERE n.iduzivatel = u.iduzivatel;";
        
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':idmapa', $idmapa);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        return $res;
    } 
    
    /* Vrati login uzivatele podle jeho ID */
    public function getLoginById($iduzivatel) {
        $sql = "SELECT login FROM uzivatel WHERE iduzivatel = :iduzivatel;";
        
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':iduzivatel', $iduzivatel);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        return $res;
    }
    
    /* Vrati hodnoceni daneho tanku */
    public function getTankRating($tank) {
        $sql = "SELECT * FROM hodnoceni_tanku WHERE idtank = (SELECT idtank FROM tank WHERE nazev_tanku = :tank)";
        
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':tank', $tank);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        
        $temp = array(0,0,0,0,0,0);
        $cTemp = count($res);
        if ($cTemp > 0) {
            foreach($res as $r) {
                for ($i = 0; $i < 6; $i++) {
                    $temp[$i] += $r[$i+2];
                }
            }
            for ($i = 0; $i < count($temp); $i++) {
                $temp[$i] /= $cTemp; 
            }
            return $temp;
        }
        else {
            return null;
        }
    }
    
    /* Vrati hodnoceni dane mapy 
       Zprumeruje vsechny polozky v hodnoceni
    */
    public function getMapRating($mapa) {
        $sql = "SELECT * FROM hodnoceni_mapy WHERE idmapa = (SELECT idmapa FROM mapa WHERE nazev_mapy = :mapa)";
        
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':mapa', $mapa);
    
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        
        $temp = array(0,0,0,0,0,0,0);
        $cTemp = count($res);
        if ($cTemp > 0) {
            foreach($res as $r) {
                for ($i = 0; $i < 7; $i++) {
                    $temp[$i] += $r[$i + 2];
                }
            }
            for ($i = 0; $i < count($temp); $i++) {
                $temp[$i] /= $cTemp; 
            }
            return $temp;
        }
        else {
            return null;
        }   
    }
    
    /* Vrati vsechna prava */
    public function getAllRights() {
        $sql = "SELECT nazev FROM pravo";
        
        $query = $this->db->prepare($sql);
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        
        for ($i = 0; $i < count($res); $i++) {
            $newRes[$i] = $res[$i]["nazev"];
        }
        return $newRes;
    }
    
    /* Vrati pravo daneho uzivatele 
       @param $login login uzivatele, jehoz pravo chci ziskat    
    */
    public function getRight($login) {
        $sql = "SELECT nazev FROM pravo WHERE idpravo = (SELECT idpravo FROM uzivatel WHERE login = :login)";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':login', $login);
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        return $res;
    }
    
    /* Vrati vsechny uzivatele, krome sebe 
        @param $me login me sameho
    */
    public function getAllUsers($me) {
        $sql = "SELECT n.login, p.nazev FROM (SELECT u.login, u.idpravo FROM uzivatel u WHERE u.login NOT IN (:me)) n, pravo p WHERE n.idpravo = p.idpravo;";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':me', $me);
        
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        
        return $res;
    }
    
    /* Zmeni danemu uzivateli pravo 
        @param $login jmeno uzivatele
        @param $pravo nove pravo
    */
    public function changeRight($login, $pravo) {
        $sql = "UPDATE uzivatel SET idpravo = ".$this->convertRight($pravo)." WHERE login = :login";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':login', $login);
        
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        
        if($res == null){
            return false;
        } else {
            $_SESSION["user"] = $this->allUserInfo($_SESSION["user"]["login"]);
            return true;
        }
    }
    
    public function convertRight($pravo) {
        $sql = "SELECT idpravo FROM pravo WHERE nazev = :pravo;";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':pravo', $pravo);
        
        $res = $this->executeQuery($query);
        
        $res = $query->fetchAll();

        return $res[0]["idpravo"];
    }
    
    public function saveTankReport($iduzivatel, $idtank, $popis, $datum) {
        $sql = "INSERT INTO prispevek_k_tanku (iduzivatel, idtank, popis, datum_prispevku) VALUES (:iduzivatel, :idtank, :popis, :datum);";
        
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':iduzivatel', $iduzivatel);
        $query->bindParam(':idtank', $idtank);
        $query->bindParam(':popis', $popis);
        $query->bindParam(':datum', $datum);
        
        $res = $this->executeQuery($query);
    }
    
    public function saveMapReport($iduzivatel, $idmapa, $popis, $datum) {
        $sql = "INSERT INTO prispevek_k_mape (iduzivatel, idmapa, popis, datum_prispevku) VALUES (:iduzivatel, :idmapa, :popis, :datum);";
        
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':iduzivatel', $iduzivatel);
        $query->bindParam(':idmapa', $idmapa);
        $query->bindParam(':popis', $popis);
        $query->bindParam(':datum', $datum);
        
        $res = $this->executeQuery($query);
    }
    
    public function saveTankRating($iduzivatel, $idtank, $presnost, $nabijeni, $rychlost, $pohyblivost, $dohled, $pancir, $datum) {
        
        if ($this->alreadyRatedTank($iduzivatel, $idtank)) {
            $sql = "UPDATE hodnoceni_tanku h SET presnost_dela = :presnost, rychlost_nabijeni = :nabijeni, 
            maximalni_rychlost = :rychlost, pohyblivost = :pohyblivost, dohled = :dohled, pancir = :pancir, 
            datum_hodnoceni = :datum WHERE h.iduzivatel = :iduzivatel AND h.idtank = :idtank;";
        }
        else {
            $sql = "INSERT INTO hodnoceni_tanku (iduzivatel, idtank, presnost_dela, rychlost_nabijeni, maximalni_rychlost, pohyblivost, dohled, pancir, datum_hodnoceni) VALUES (:iduzivatel, :idtank, :presnost, :nabijeni, :rychlost, :pohyblivost, :dohled, :pancir, :datum);";
        }
        
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':iduzivatel', $iduzivatel);
        $query->bindParam(':idtank', $idtank);
        $query->bindParam(':presnost', $presnost);
        $query->bindParam(':nabijeni', $nabijeni);
        $query->bindParam(':rychlost', $rychlost);
        $query->bindParam(':pohyblivost', $pohyblivost);
        $query->bindParam(':dohled', $dohled);
        $query->bindParam(':pancir', $pancir);
        $query->bindParam(':datum', $datum);
        
        $res = $this->executeQuery($query);
        
    }
    
    public function saveMapRating($iduzivatel, $idmapa, $vyvazenost, $vegetace, $budovy, $spotovani, $manevrovani, $koridorova, $kempeni, $datum) {
        if ($this->alreadyRatedMap($iduzivatel, $idmapa)) {
            $sql = "UPDATE hodnoceni_mapy h SET vyvazena = :vyvazenost, bohatost_vegetace = :vegetace, mestska = :budovy, vhodna_ke_spotovani = :spotovani, prostor_k_objizdeni = :manevrovani, koridorova = :koridorova, 
            kempici_pozice = :kempeni, datum_hodnoceni = :datum WHERE h.iduzivatel = :iduzivatel AND h.idmapa = :idmapa;";
            echo "update map";
        }
        else {
            $sql = "INSERT INTO hodnoceni_mapy (iduzivatel, idmapa, vyvazena, bohatost_vegetace, mestska, vhodna_ke_spotovani, prostor_k_objizdeni, koridorova, kempici_pozice, datum_hodnoceni) VALUES (:iduzivatel, :idmapa, :vyvazenost, :vegetace, :budovy, :spotovani, :manevrovani, :koridorova, :kempeni, :datum);";
        }
            
        $query = $this->db->prepare($sql);
        
        $query->bindParam(':iduzivatel', $iduzivatel);
        $query->bindParam(':idmapa', $idmapa);
        $query->bindParam(':vyvazenost', $vyvazenost);
        $query->bindParam(':vegetace', $vegetace);
        $query->bindParam(':budovy', $budovy);
        $query->bindParam(':spotovani', $spotovani);
        $query->bindParam(':manevrovani', $manevrovani);
        $query->bindParam(':koridorova', $koridorova);
        $query->bindParam(':kempeni', $kempeni);
        $query->bindParam(':datum', $datum);
        
        $res = $this->executeQuery($query);
    }
    
    public function alreadyRatedMap($iduzivatel, $idmapa) {
        $sql = "SELECT * FROM hodnoceni_mapy h WHERE :idmapa = h.idmapa AND :iduzivatel = h.iduzivatel;";

        $query = $this->db->prepare($sql);
        $query->bindParam(':idmapa', $idmapa);
        $query->bindParam(':iduzivatel', $iduzivatel);
        
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
        
        if (!$res)
            return false;
        else
            return true;
    }
    
    public function alreadyRatedTank($iduzivatel, $idtank) {
        $sql = "SELECT * FROM hodnoceni_tanku h WHERE :idtank = h.idtank AND :iduzivatel = h.iduzivatel;";

        $query = $this->db->prepare($sql);
        $query->bindParam(':idtank', $idtank);
        $query->bindParam(':iduzivatel', $iduzivatel);
        
        $res = $this->executeQuery($query);
        $res = $query->fetchAll();
       
        if (!$res) {
            return false;
        }
        else {
            return true;
        }
    }
    
    /* Vrati tank podle jeho id */
    public function getTank($idtank) {
        $sql = "SELECT * FROM tank WHERE tank.idtank = :idtank;";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':idtank', $idtank);
        
        $res = $this->executeQuery($query);
        
        $res = $query->fetchAll();
        return $res[0];
    }
    
    /* Vrati mapu podle jeji id */
    public function getMap($idmapa) {
        $sql = "SELECT * FROM mapa WHERE mapa.idmapa = :idmapa;";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':idmapa', $idmapa);
        
        $res = $this->executeQuery($query);
        
        $res = $query->fetchAll();
        return $res[0];
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