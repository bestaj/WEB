<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
    
        <div class="myContainer">
            <div class="itemPanel">
                <span id="itemName"><?php echo $tplData["tank"]["nazev_tanku"]?></span><br>
                <img src="views/images/tanks/<?php echo $tplData['tank']['img']?>"><br>
                <span><?php echo $tplData["tank"]["popis"] ?></span><br>
                
                <table>
                    <tr><td>Národ:</td><td class="value"><?php echo $tplData["tank"]["narod"] ?></td></tr>
                    <tr><td>Tier:</td><td class="value"><?php echo $tplData["tank"]["uroven"] ?></td></tr>
                    <tr><td>Typ:</td><td class="value"><?php echo $tplData["tank"]["typ"] ?></td></tr>
                    <tr><td>Výdrž:</td><td class="value"><?php echo $tplData["tank"]["vydrz"] ?> HP</td></tr>
                    <tr><td>Poškození:</td><td class="value"><?php echo $tplData["tank"]["poskozeni"] ?></td></tr>
                    <tr><td>Průbojnost:</td><td class="value"><?php echo $tplData["tank"]["prubojnost"] ?></td></tr>
                    <tr><td>Poškození za minutu (DPM):</td><td class="value"><?php echo $tplData["tank"]["dpm"] ?></td></tr>
                    <tr><td>Pancíř věže:</td><td class="value"><?php echo $tplData["tank"]["pancir_veze"] ?></td></tr>
                    <tr><td>Pancíř korby:</td><td class="value"><?php echo $tplData["tank"]["pancir_korby"] ?></td></tr>
                    <tr><td>Maximální rychlost dopředu:</td><td class="value"><?php echo $tplData["tank"]["max_rychlost_dopredu"] ?> km/h</td></tr>
                    <tr><td>Maximální rychlost dozadu:</td><td class="value"><?php echo $tplData["tank"]["max_rychlost_dozadu"] ?> km/h</td></tr>
                    <tr><td>Deprese děla:</td><td class="value"><?php echo $tplData["tank"]["deprese_dela"] ?>°</td></tr>
                    <tr><td>Elevace děla:</td><td class="value"><?php echo $tplData["tank"]["elevace_dela"] ?>°</td></tr>
                    <tr><td>Dohled:</td><td class="value"><?php echo $tplData["tank"]["dohled"] ?> m</td></tr>
                    <tr><td>Rychlost nabíjení:</td><td class="value"><?php echo $tplData["tank"]["rychlost_nabijeni"] ?> s</td></tr>
                    <?php if ($tplData["tank"]["cas_nabiti_celeho_zasobniku"]) { ?>
                    <tr><td>Doba nabití celého zásobníku:</td><td class="value"><?php echo $tplData["tank"]["cas_nabiti_celeho_zasobniku"] ?> s</td></tr>
                    <?php } ?>    
                    <tr><td>Rychlost zaměření:</td><td class="value"><?php echo $tplData["tank"]["rychlost_zamereni"] ?> s</td></tr>
                </table><br>
                
                <label id="ratingLbl">Hodnocení tanku</label><br>
        
                
                <?php if ($tplData["rating"] != null) { ?>
                <div class="rating">
                    <table>
                        <tr><td>Přesnost děla</td><td><span id="avgValue"><?php echo $tplData["rating"][0] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Rychlost nabíjení</td><td><span id="avgValue"><?php echo $tplData["rating"][1] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Maximální rychlost</td><td><span id="avgValue"><?php echo $tplData["rating"][2] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Pohyblivost</td><td><span id="avgValue"><?php echo $tplData["rating"][3] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Dohled</td><td><span id="avgValue"><?php echo $tplData["rating"][4] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Pancíř</td><td><span id="avgValue"><?php echo $tplData["rating"][5] ?></span> / <span id="maxValue">10</span></td></tr>
                    </table>
                    
                    
                </div>
                <?php 
                    } else { 
                ?>
                        <span id="infoNoReports">Tento tank dosud nemá žádné hodnocení.</span><br>

                    <?php   
                        } 
                        if ($tplData["isUserLogged"]) {
                    ?>
                <button id="rateBtn" data-toggle="collapse" data-target="#ratePanel">Vaše hodnocení</button><br>
                    <div id="ratePanel" class="collapse">
                        <table>
                            <form id="rate" action="index.php?page=tank" method="post">
                                <tr><td>Přesnost děla:</td><td><input type="number" name="presnost" min="0" max="10" size="2" step="1"></td></tr> 
                                <tr><td>Rychlost nabíjení:</td><td><input type="number" name="nabijeni" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Maximální rychlost:</td><td><input type="number" name="rychlost" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Pohyblivost:</td><td><input type="number" name="pohyblivost" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Dohled:</td><td><input type="number" name="dohled" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Pancíř:</td><td><input type="number" name="pancir" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td id="noTableRow"><input id="rateBtn" type="submit" name="rating" value="Potvrdit"></td></tr>
                            </form>
                        </table>
                    </div>
                <?php 
                    } 
                    else {
                ?>
                    <span>Hodnotit mohou pouze přihlášení uživatelé.</span>
                <?php
                    }
                ?>
                <!-- Panel s prispevkama od uzivatelu k danemu tanku -->
                <div class="contributionPanel">
                    <label id="prispevekLbl" for="novyPrispevek">Nový příspěvek:</label>
                    <form action="index.php?page=tank" method="post">
                        <textarea class="novyPrispevek" name="popis" placeholder="Přidat vlastní příspěvek..."></textarea><br>
                        <input id="addBtn" type="submit" name="addReport" value="Přidat">
                    </form>
                    
                    <?php 
                        foreach($tplData["reports"] as $report) {
                    ?>
                        <div class="report">
                            <div class="row">
                                <span id="author">Autor: <?php echo $report["login"] ?></span>
                                <span id="date">Datum příspěvku: <?php echo $report["datum_prispevku"] ?></span><br>
                            </div>
                            
                            <div id="describe"><?php echo $report["popis"] ?></div>
                        </div>
                    
                    <?php
                        }
                    ?>
                    
                </div>
                
            </div>
        </div>
   


<?php
$hlavicky->getFooter();
?>