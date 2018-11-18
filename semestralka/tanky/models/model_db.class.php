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
    
    /** Zjisti zda je uzivatel prihlasen */
    public function isUserLoged() {
        return isset($_SESSION["user"]);
    }
}

?>