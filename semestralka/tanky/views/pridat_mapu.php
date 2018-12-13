<?php
// Sablona pro pridani nove mapy

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData["title"]); ?>
    <div class="background2">
        <div class="myContainer">
            <h2 id="title2">Nová mapa</h2>
            <div class="specifies">
                <form action="index.php?page=novaMapa" method="post" enctype="multipart/form-data">
                    <table>
                        <tr><td id="spec">Název mapy:</td><td class="value2"><input type="text" name="nazev" required> </td></tr>
                        <tr><td id="spec">Typ:</td><td class="value2"><input type="text" name="typ" required> </td></tr>
                        <tr><td id="spec">Velikost:</td><td class="value2"><input type="text" name="velikost" required></td></tr>
                        <tr><td id="spec">Módy:</td><td class="value2"><input type="text" name="mody" required></td></tr>
                        <tr><td id="spec">Popis:</td><td class="value2"><textarea name="popis" cols="40" rows="8"></textarea></td></tr>
                        <tr><td id="spec">Obrázek tanku:</td><td><input type="file" name="img" id="img" accept="image/*"></td>
                    </table><br>
                        
                    <input id="addBtn" type="submit" name="addNewMap" value="Přidat">
                </form>
            </div>
        </div>
    </div>
<?php
$hlavicky->getFooter();
?>