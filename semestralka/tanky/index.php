<?php
// Vstupni bod webove aplikace

// Nacteni nastaveni
include("settings.inc.php");

// test, na existenci pozadovane stranky, jinak defaultni
if (isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)) {
    $page = $_GET["page"]; // Nastavim vybranou stranku
}
else {
    $page = DEFAULT_WEB_PAGE; // Nastavim defaultni stranku
}

// Nacteni odpovidajiciho kontroleru
require(CONTROLLERS_DIRECTORY."/".WEB_PAGES[$page]['file']);

$tmp = WEB_PAGES[$page]['object'];

// Vytvoreni instance prislusneho kontroleru, odpovidajici vybrane strance
$con = new $tmp();

// Zobrazeni obsahu stranky
echo $con->getResult();

?>


