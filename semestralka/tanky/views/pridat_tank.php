<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData["title"]); ?>
    <div class="background2">
        <div class="myContainer">
            <h2 id="title2">Nový tank</h2>
            <div class="specifies">
                <form action="index.php?page=novyTank" method="post" enctype="multipart/form-data">
                    <table>
                        <tr><td>Název tanku:</td><td class="value2"><input type="text" name="nazev" required> </td></tr>
                        <tr><td>Národ:</td><td class="value2"><input type="text" name="narod" required> </td></tr>
                        <tr><td>Tier:</td><td class="value2"><input type="number" name="tier" required></td></tr>
                        <tr><td>Typ:</td><td class="value2"><input type="text" name="typ" required></td></tr>
                        <tr><td>Výdrž:</td><td class="value2"><input type="number" name="vydrz" required></td></tr>
                        <tr><td>Poškození:</td><td class="value2"><input type="text" name="poskozeni" required></td></tr>
                        <tr><td>Průbojnost:</td><td class="value2"><input type="text" name="prubojnost" required></td></tr>
                        <tr><td>Poškození za minutu (DPM):</td><td class="value2"><input type="number" name="dpm" required></td></tr>
                        <tr><td>Pancíř věže:</td><td class="value2"><input type="text" name="pancir_veze" required></td></tr>
                        <tr><td>Pancíř korby:</td><td class="value2"><input type="text" name="pancir_korby" required></td></tr>
                        <tr><td>Maximální rychlost dopředu:</td><td class="value2"><input type="number" name="rychlost_dopredu" required></td></tr>
                        <tr><td>Maximální rychlost dozadu:</td><td class="value2"><input type="number" name="rychlost_dozadu" required></td></tr>
                        <tr><td>Deprese děla:</td><td class="value2"><input type="number" name="deprese" required></td></tr>
                        <tr><td>Elevace děla:</td><td class="value2"><input type="number" name="elevace" required></td></tr>
                        <tr><td>Dohled:</td><td class="value2"><input type="number" name="dohled" required></td></tr>
                        <tr><td>Rychlost nabíjení:</td><td class="value2"><input type="number" name="rychlost_nabijeni" step="0.01" required></td></tr>
                        <tr><td>Doba nabití celého zásobníku:</td><td class="value2"><input type="number" name="doba_nabiti_zasobniku" step="0.01"></td></tr> 
                        <tr><td>Rychlost zaměření:</td><td class="value2"><input type="number" name="rychlost_zamereni" step="0.01" required></td></tr>
                        <tr><td>Popis:</td><td class="value2"><textarea name="popis" cols="40" rows="8"></textarea></td></tr>
                        <tr><td>Obrázek tanku:</td><td><input type="file" name="img" id="img" accept="image/*"></td>
                </table><br>
                        
                    <input type="submit" name="addNewTank" value="Přidat">
                </form>
            </div>
        </div>
    </div>
<?php
$hlavicky->getFooter();
?>