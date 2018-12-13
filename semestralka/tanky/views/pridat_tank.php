<?php
// Sablona pro pridani noveho tanku

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
                        <tr><td id="spec">Název tanku:</td><td class="value2"><input type="text" name="nazev" required> </td></tr>
                        <tr><td id="spec">Národ:</td><td class="value2"><input type="text" name="narod" required> </td></tr>
                        <tr><td id="spec">Tier:</td><td class="value2"><input type="number" name="tier" required></td></tr>
                        <tr><td id="spec">Typ:</td><td class="value2"><input type="text" name="typ" required></td></tr>
                        <tr><td id="spec">Výdrž:</td><td class="value2"><input type="number" name="vydrz" required></td></tr>
                        <tr><td id="spec">Poškození:</td><td class="value2"><input type="text" name="poskozeni" required></td></tr>
                        <tr><td id="spec">Průbojnost:</td><td class="value2"><input type="text" name="prubojnost" required></td></tr>
                        <tr><td id="spec">Poškození za minutu (DPM):</td><td class="value2"><input type="number" name="dpm" required></td></tr>
                        <tr><td id="spec">Pancíř věže:</td><td class="value2"><input type="text" name="pancir_veze" required></td></tr>
                        <tr><td id="spec">Pancíř korby:</td><td class="value2"><input type="text" name="pancir_korby" required></td></tr>
                        <tr><td id="spec">Maximální rychlost dopředu:</td><td class="value2"><input type="number" name="rychlost_dopredu" required></td></tr>
                        <tr><td id="spec">Maximální rychlost dozadu:</td><td class="value2"><input type="number" name="rychlost_dozadu" required></td></tr>
                        <tr><td id="spec">Deprese děla:</td><td class="value2"><input type="number" name="deprese" required></td></tr>
                        <tr><td id="spec">Elevace děla:</td><td class="value2"><input type="number" name="elevace" required></td></tr>
                        <tr><td id="spec">Dohled:</td><td class="value2"><input type="number" name="dohled" required></td></tr>
                        <tr><td id="spec">Rychlost nabíjení:</td><td class="value2"><input type="number" name="rychlost_nabijeni" step="0.01" required></td></tr>
                        <tr><td id="spec">Doba nabití celého zásobníku:</td><td class="value2"><input type="number" name="doba_nabiti_zasobniku" step="0.01"></td></tr> 
                        <tr><td id="spec">Rychlost zaměření:</td><td class="value2"><input type="number" name="rychlost_zamereni" step="0.01" required></td></tr>
                        <tr><td id="spec">Popis:</td><td class="value2"><textarea name="popis" cols="40" rows="8"></textarea></td></tr>
                        <tr><td id="spec">Obrázek tanku:</td><td><input type="file" name="img" id="img" accept="image/*"></td>
                </table><br>
                        
                    <input id="addBtn" type="submit" name="addNewTank" value="Přidat">
                </form>
            </div>
        </div>
    </div>
<?php
$hlavicky->getFooter();
?>