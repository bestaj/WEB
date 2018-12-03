<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']); ?>
    <div class="content2">
        <div class="myContainer">
            <div class="filter">
                <span>Národ:</span>
                <select>
                    <option value="vse">Vše</option>
                    <option value="nemecko">Německo</option>
                    <option value="sssr">SSSR</option>
                    <option value="usa">USA</option>
                    <option value="cina">Čína</option>
                    <option value="francie">Francie</option>
                    <option value="britanie">Británie</option>
                    <option value="japonsko">Japonsko</option>
                    <option value="cesko">Československo</option>
                    <option value="svedsko">Švédsko</option>
                    <option value="polsko">Polsko</option>
                    <option value="italie">Itálie</option>
                </select>
                <span>Typ:</span>
                <select>
                    <option value="vse">Vše</option>
                    <option value="lt">Lehké tanky</option>
                    <option value="mt">Střední tanky</option>
                    <option value="ht">Těžké tanky</option>
                    <option value="td">Stíhače tanků</option>
                    <option value="spg">Dělostřelectvo</option>
                </select>
                <span>Úroveň:</span>
                <select>
                    <option value="vse">Vše</option>
                    <option value="1">I</option>
                    <option value="2">II</option>
                    <option value="3">III</option>
                    <option value="4">IV</option>
                    <option value="5">V</option>
                    <option value="6">VI</option>
                    <option value="7">VII</option>
                    <option value="8">VIII</option>
                    <option value="9">IX</option>
                    <option value="10">X</option>
                </select>
                <button type="button" value="filtruj">Filtruj</button>
            </div>
        </div>
    </div>

<?php
$hlavicky->getFooter();
?>