<?php
// Sablona pro domovskou stranku

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
    <div class="background1">
        <div class="myContainer">
            <div class="article">
                <h1>Poděl se o své zkušenosti ze světa tanků prostřednictvím hodnocení jednotlivých tanků a map, a pomož tak se zlepšit začínajícím hráčům!</h1>

                <h2>Tvorba a obsah webu</h2>
                <p align="justify">Tento web byl vytvořen za účelem sdílení svých zkušeností z "wotka" mezi hráči, tak aby se každý tankista mohl přiučit něco nového a lépe tak ovládnout bojiště s jakýmkoliv tankem.
                Každý hráč se zde může podělit o své dosavadní zkušenosti a poznatky ze hry a tak pomoct začínajícím, avšak zapáleným tankistům, kteří se touží zlepšovat v této hře.</p>

                <h2>Tanky</h2>
                <p align="justify">V této sekci se nachází seznam jednotlivých tanků. Každý tankista si zde může vybrat tank, který ho zajímá a zobrazit si jeho stručný popis se základními vlastnostmi. Tanky je možné ohodnotit dle stanovených specifikací a také přidat příspěvěk k jakémukoliv tanku.</p>
                
                <h2>Mapy</h2>
                <p align="justify">V této sekci se nachází seznam jednotlivých map, které opět obsahují stručný popis. Stejně jako u tanků je možné mapy hodnotit a přidávat k nim příspěvky.</p>
                
                <h2>Rady a tipy</h2>
                <p align="justify">V této sekci jsou vypsány různé rady a tipy, jak být lepším hráčem wotka.</p> 
            </div>
        </div>
     </div>
<?php 
$hlavicky->getFooter();
?>