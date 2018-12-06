<?php

// Soubor se zakladnim nastavenim

global $db_server, $db_name, $db_user, $db_pass; 

// Pripojeni k databazi
$db_server = "localhost";
$db_name = "tanky";
$db_user = "root";
$db_pass = "root";

// Stranky webu
const WEB_PAGES = [
    "domu" => array("file" => "domu_controller.class.php", "object" => "DomuController", "title" => "Domů"),
    "tanky" => array("file" => "tanky_controller.class.php", "object" => "TankyController", "title" => "Tanky"),
    "tank" => array("file" => "tank_controller.class.php", "object" => "TankController", "title" => "Tank"),
    "mapy" => array("file" => "mapy_controller.class.php", "object" => "MapyController", "title" => "Mapy"),
    "mapa" => array("file" => "mapa_controller.class.php", "object" => "MapaController", "title" => "Mapa"),
    "tipy" => array("file" => "tipy_controller.class.php", "object" => "TipyController", "title" => "Rady a tipy"),
    "profil" => array("file" => "profil_controller.class.php", "object" => "ProfilController", "title" => "Profil uživatele"),
    "prihlaseni" => array("file" => "prihlaseni_controller.class.php", "object" => "PrihlaseniController", "title" => "Přihlášení"),
    "registrace" => array("file" => "registrace_controller.class.php", "object" => "RegistraceController", "title" => "Registrace"),
];

// Defaultni webova stranka
const DEFAULT_WEB_PAGE = "domu";

// Adresar s kontrolery
const CONTROLLERS_DIRECTORY = "controllers";

?>
