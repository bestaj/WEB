<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']); ?>
    <div class="content2">
        <div class="myContainer">
            <div class="filter">
                <form action="index.php?page=tanky" method="post">
                    <span>Národ:</span>
                    <select name="narod">
                        <option value="vse">Vše</option>
                        <option value="Německo">Německo</option>
                        <option value="SSSR">SSSR</option>
                        <option value="USA">USA</option>
                        <option value="Čína">Čína</option>
                        <option value="Francie">Francie</option>
                        <option value="Británie">Británie</option>
                        <option value="Japonsko">Japonsko</option>
                        <option value="Československo">Československo</option>
                        <option value="Švédsko">Švédsko</option>
                        <option value="Polsko">Polsko</option>
                        <option value="Itálie">Itálie</option>
                    </select>
                    <span>Typ:</span>
                    <select name="typ">
                        <option value="vse">Vše</option>
                        <option value="Lehký tank">Lehké tanky</option>
                        <option value="Střední tank">Střední tanky</option>
                        <option value="Těžký tank">Těžké tanky</option>
                        <option value="Stíhač tanků">Stíhače tanků</option>
                        <option value="Dělostřelectvo">Dělostřelectvo</option>
                    </select>
                    <span>Úroveň:</span>
                    <select name="uroven">
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
                    <input type="submit" name="filtruj" value="Filtruj">
                
                </form>
            </div>
            <div class="list">
                <?php if ($tplData["tanks"] != null)
                        foreach($tplData["tanks"] as $tank) { 
                ?>
                <a href="index.php?page=tank&tank=<?php echo $tank["idtank"] ?>">
                     
                    <div class="item">
                        <span id="name"><?php echo $tank["nazev_tanku"]?></span><br>
                        <img src="views/images/tanks/<?php echo $tank['img']?>">
                        <table>
                            <tr><td><span>Národ:</span></td><td><span class="value"><?php echo $tank["narod"]?></span></td></tr>
                            <tr><td> <span>Úroveň:</span></td><td><span class="value"><?php echo $tank["uroven"]?></span></td></tr>
                            <tr><td><span>Typ:</span></td><td><span class="value"><?php echo $tank["typ"]?></span></td></tr>
                        </table>
                        
                        
                        
                    </div>
                </a>
                <?php } else {  ?>
                    <div id="noItems">
                        Nebyly nalezeny žádné tanky.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
$hlavicky->getFooter();
?>