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
            <div class="list">
                <?php if ($tplData["maps"] != null)
                            foreach($tplData["maps"] as $mapa) { 
                ?>
                <a href="index.php?page=mapa&mapa=<?php echo $mapa["idmapa"] ?>">
                    
                    <div class="item">
                        <span id="name"><?php echo $mapa["nazev_mapy"]?></span><br>
                        
                        <img src="views/images/maps/<?php echo $mapa['img'] ?>"> 
                        <table>
                            <tr><td>Typ:</td><td><span class="value"><?php echo $mapa["typ"]?></span></td></tr>
                            <tr><td>Velikost:</td><td><span class="value"><?php echo $mapa["velikost"]?></span></td></tr>
                            <tr><td>Mód:</td><td><span class="value"><?php echo $mapa["mody"]?></span></td></tr>
                        </table>
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