<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData["title"]); ?>
    <div class="content2">
        <div class="myContainer">
            <h2 id="title">Nová mapa</h2>
            <div class="specifies">
                <form action="index.php?page=novaMapa" method="post" enctype="multipart/form-data">
                    <table>
                        <tr><td>Název mapy:</td><td class="value2"><input type="text" name="nazev" required> </td></tr>
                        <tr><td>Typ:</td><td class="value2"><input type="text" name="typ" required> </td></tr>
                        <tr><td>Velikost:</td><td class="value2"><input type="text" name="velikost" required></td></tr>
                        <tr><td>Módy:</td><td class="value2"><input type="text" name="mody" required></td></tr>
                        <tr><td>Popis:</td><td class="value2"><textarea name="popis" cols="40" rows="8"></textarea></td></tr>
                        <tr><td>Obrázek tanku:</td><td><input type="file" name="img" id="img" accept="image/*"></td>
                    </table><br>
                        
                    <input type="submit" name="addNewMap" value="Přidat">
                </form>
            </div>
        </div>
    </div>
<?php
$hlavicky->getFooter();
?>