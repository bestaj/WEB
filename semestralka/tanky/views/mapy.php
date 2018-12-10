<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
    
    <div class="background2">
        <div class="myContainer">
            <?php 
            // Administrator a autor muze pridat novy tank 
            if ($tplData["isA"]) {
            ?>
                <a id="addNewBtn" href="index.php?page=novaMapa">Přidat novou mapu</a>
            <?php
                }
            ?>
            
            <div class="filter">
                <form action="index.php?page=mapy" method="post">
                    <span>Typ:</span>
                    <select name="typ">
                        <option value="vse">Vše</option>
                        <option value="Letní">Letní</option>
                        <option value="Pouštní">Pouštní</option>
                        <option value="Zimní">Zimní</option>
                    </select>
                    <span>Mód:</span>
                    <select name="mod">
                        <option value="vse">Vše</option>
                        <option value="Standardní">Standardní bitva</option>
                        <option value="Střetnutí">Střetnutí</option>
                        <option value="Útok">Útok</option>
                    </select>
                     <input type="submit" name="filtruj" value="Filtruj">
                </form>  
            </div>
            <!-- Vypis vsech vybranych polozek, podle filtru -->
            <div class="list">
                <?php if ($tplData["maps"] != null)
                            foreach($tplData["maps"] as $mapa) { 
                ?>
                <a href="index.php?page=mapa&mapa=<?php echo $mapa["idmapa"] ?>">
                    
                    <div class="item">
                        <span id="name" class="row"><?php echo $mapa["nazev_mapy"]?></span><br>
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 spec">
                            <span>Typ:</span><br>
                            <span>Velikost:</span><br>
                            <span>Mód:</span><br>
                        </div>
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4 spec">
                            <span class="value"><?php echo $mapa["typ"]?></span><br>
                            <span class="value"><?php echo $mapa["velikost"]?></span><br>
                            <span class="value"><?php echo $mapa["mody"]?></span><br>
                        </div>
                        <img class="col-xs-12 col-sm-4 col-md-4 col-lg-4" src="views/images/maps/<?php echo $mapa['img'] ?>">
                    </div>
                </a>
                <?php } else {  ?>
                    <div id="noItems">
                        Nebyly nalezeny žádné mapy.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php 
$hlavicky->getFooter();
?>