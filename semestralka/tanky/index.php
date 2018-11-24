<?php
// Vstupni bod webove aplikace

//init_set('display_errors', 1);
//init_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Nacteni nastaveni
include("settings.inc.php");

//test, na existenci pozadovane stranky, jinak defaultni
if (isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)) {
    $page = $_GET["page"]; // Nastavim vybranou stranku
//    $_SESSION["page"] = $_GET["page"];
}
else {
    $page = DEFAULT_WEB_PAGE; // Nastavim defaultni stranku
//    $_SESSION["page"] = DEFAULT_WEB_PAGE;
}

// Nacteni odpovidajiciho kontroleru
require(CONTROLLERS_DIRECTORY."/".WEB_PAGES[$page]['file']);

$tmp = WEB_PAGES[$page]['object'];

// Vytvoreni instance prislusneho kontroleru, odpovidajici vybrane strance
$con = new $tmp();

// Zobrazeni obsahu stranky
echo $con->getResult();

?>


