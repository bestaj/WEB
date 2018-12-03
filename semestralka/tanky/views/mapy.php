<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
    <div class="content2">
        <div class="myContainer">
            <div class="filter">
                <span>Typ:</span>
                <select>
                    <option value="vse">Vše</option>
                    <option value="letni">Letní</option>
                    <option value="poustni">Pouštní</option>
                    <option value="zimni">Zimní</option>
                </select>
                <span>Mód:</span>
                <select>
                    <option value="vse">Vše</option>
                    <option value="standardni">Standardní bitva</option>
                    <option value="stretnuti">Střetnutí</option>
                    <option value="utok">Útok</option>
                </select>
                <button type="button" value="filtruj">Filtruj</button>
            </div>
        </div>
    </div>

<?php 
$hlavicky->getFooter();
?>