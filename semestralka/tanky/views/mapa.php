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
                 
                <label id="ratingLbl">Hodnocení mapy</label>
        

                <?php if ($tplData["rating"] != null) { ?>
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

                    <button id="rateBtn" data-toggle="collapse" data-target="#ratePanel">Hodnotit</button><br>
                    <div id="ratePanel" class="collapse">
                    <table>
                        <form id="rate" action="index.php?page=mapa" method="post">
                            <tr><td>Vyváženost mapy (hratelnostně):</td><td><input type="number" name="vyvazenost" value="0" min="0" max="10" size="3" step="1"></td></tr> 
                            <tr><td>Bohatost vegetace:</td><td><input type="number" name="vegetace" value="0" min="0" max="10" size="3" step="1"></td></tr>
                            <tr><td>Množství budov:</td><td><input type="number" name="budovy" value="0" min="0" max="10" size="3" step="1"></td></tr>
                            <tr><td>Vhodná pro spotování:</td><td><input type="number" name="spotovani" value="0" min="0" max="10" size="3" step="1"></td></tr>
                            <tr><td>Prostor k manévrování (objíždění tanků):</td><td><input type="number" name="manevrovani" value="0" min="0" max="10" size="3" step="1"></td></tr>
                            <tr><td>Koridorová:</td><td><input type="number" name="koridorova" value="0" min="0" max="10" size="3" step="1"></td></tr>
                            <tr><td>Kempící pozice:</td><td><input type="number" name="kempeni" value="0" min="0" max="10" size="3" step="1"></td></tr>
                            <tr><td id="noTableRow"><input id="rateBtn" type="submit" name="odeslatHodnoceni" value="Potvrdit"></td></tr>
                        </form>
                    </table>
                </div>
                </div>
                <?php } else { ?>
                        <span>Tato mapa dosud nemá žádné hodnocení.</span>

                    <?php   } ?>
                
            </div>
        </div>

        


<?php
$hlavicky->getFooter();
?>