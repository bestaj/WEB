<?php

// Soubor se zakladnim nastavenim

// Pripojeni k databazi
define("DB_SERVER", "localhost");
define("DB_NAME", "tanky");
define("DB_USER", "root");
define("DB_PASS", "root");

// Stranky webu
const WEB_PAGES = [
    "domu" => array("file" => "domu_controller.class.php", "object" => "DomuController", "title" => "Domů"),
    "tanky" => array("file" => "tanky_controller.class.php", "object" => "TankyController", "title" => "Tanky"),
    "mapy" => array("file" => "mapy_controller.class.php", "object" => "MapyController", "title" => "Mapy"),
    "tipy" => array("file" => "tipy_controller.class.php", "object" => "TipyController", "title" => "Rady a tipy")
];

// Defaultni webova stranka
const DEFAULT_WEB_PAGE = "domu";

// Adresar s kontrolery
const CONTROLLERS_DIRECTORY = "controllers";

?>
