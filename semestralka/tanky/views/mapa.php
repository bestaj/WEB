<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
        <div class="myContainer">
             <div class="itemPanel">
                <span id="itemName"><?php echo $tplData["mapa"]["nazev_mapy"]?></span><br>
                <img src="views/images/maps/<?php echo $tplData['mapa']['img']?>"><br>
                <span><?php echo $tplData["mapa"]["popis"] ?></span><br>
                <table align="center">
                    <tr><td>Typ mapy (kamufláž):</td><td class="value"><?php echo $tplData["mapa"]["typ"] ?></td></tr>
                    <tr><td>Velikost:</td><td class="value"><?php echo $tplData["mapa"]["velikost"] ?></td></tr>
                    <tr><td>Možné režimy bitev:</td><td class="value"><?php echo $tplData["mapa"]["mody"] ?></td></tr>
                </table>
                 
                <label id="ratingLbl">Hodnocení mapy</label><br>
        

                <?php 
                    if ($tplData["rating"] != null) { 
                 ?>
                <div class="rating">
                    <table>
                        <tr><td>Vyváženost mapy (hratelnostně)</td><td><span id="avgValue"><?php echo $tplData["rating"][0] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Bohatost vegetace</td><td><span id="avgValue"><?php echo $tplData["rating"][1] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Množství budov</td><td><span id="avgValue"><?php echo $tplData["rating"][2] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Vhodná pro spotování</td><td><span id="avgValue"><?php echo $tplData["rating"][3] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Prostor k manévrování (objíždění tanků)</td><td><span id="avgValue"><?php echo $tplData["rating"][4] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Koridorová</td><td><span id="avgValue"><?php echo $tplData["rating"][5] ?></span> / <span id="maxValue">10</span></td></tr>
                        <tr><td>Kempící pozice</td><td><span id="avgValue"><?php echo $tplData["rating"][6] ?></span> / <span id="maxValue">10</span></td></tr>
                    </table>
                 </div>
                    <?php 
                        } else { 
                    ?>
                        <span>Tato mapa dosud nemá žádné hodnocení.</span><br>

                    <?php
                        }
                        // Prihlaseny uzivatel ma moznost hodnotit mapu
                        if ($tplData["isUserLogged"]) {
                    ?>
                    <button id="rateBtn" data-toggle="collapse" data-target="#ratePanel">Vaše hodnocení</button><br>
                    <div id="ratePanel" class="collapse">
                        <table>
                            <form id="rate" action="index.php?page=mapa" method="post">
                                <tr><td>Vyváženost mapy (hratelnostně):</td><td><input type="number" name="vyvazenost" min="0" max="10" size="2" step="1"></td></tr> 
                                <tr><td>Bohatost vegetace:</td><td><input type="number" name="vegetace" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Množství budov:</td><td><input type="number" name="budovy" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Vhodná pro spotování:</td><td><input type="number" name="spotovani" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Prostor k manévrování (objíždění tanků):</td><td><input type="number" name="manevrovani" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Koridorová:</td><td><input type="number" name="koridorova" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td>Kempící pozice:</td><td><input type="number" name="kempeni" min="0" max="10" size="2" step="1"></td></tr>
                                <tr><td></td><td id="noTableRow"><input id="rateBtn" type="submit" name="rating" value="Potvrdit"></td></tr>
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
                 
                 <!-- Panel s prispevkama od uzivatelu k dane mape -->
                <div class="contributionPanel">
                    <?php 
                        if ($tplData["isUserLogged"]) {
                    ?>
                    <label id="prispevekLbl" for="novyPrispevek">Nový příspěvek:</label>
                    <form action="index.php?page=mapa" method="post">
                        <textarea class="novyPrispevek" name="popis" placeholder="Přidat vlastní příspěvek..."></textarea><br>
                        <input id="addBtn" type="submit" name="addReport" value="Přidat">
                    </form>
                    
                    <?php 
                        }
                     if ($tplData["reports"] != null) {
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
                     } 
                     else { 
                    ?>
                    <span id="prispevekLbl">Žádné komentáře... </span>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>

        


<?php
$hlavicky->getFooter();
?>