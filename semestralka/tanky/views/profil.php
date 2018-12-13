<?php
// Sablona pro profil uzivatele

// Pripojime objekt pro vypis hlavicky a paticky HTML.
require("views/zaklad_prihlaseni.php");

$hlavicky = new ZakladPrihlaseni();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
    <div class="profilBox">
        <a id="homeLink" class="glyphicon glyphicon-home" href="index.php?page=domu">Domů</a>
        
        <!-- Zobrazeni profilu, nelze menit osobni udaje -->
        <?php 
            if (!$tplData["userInfoChange"]) { 
        ?>
        <form class="row" href="index.php?page=profil" method="post">
                <input id="changeBtn" name="changeUserInfoON" type="submit" value="Změnit osobní údaje">
            </form>
        <!-- Vypis udaju o uzivateli -->
        <div class="userInfo">
            <table class="row">
                <tr>
                    <td>Uživatelské jméno:</td>
                    <td class="value"><?php echo $_SESSION["user"]["login"] ?></td>
                </tr>
                <tr>
                    <td>Jméno ve hře:</td>
                    <td class="value"><?php echo $_SESSION["user"]["jmeno_ve_hre"] ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td class="value"><?php echo $_SESSION["user"]["email"] ?></td>
                </tr>
                <tr>
                    <td>Právo:</td>
                    <td class="value"><?php echo $_SESSION["user"]["nazev"] ?></td>
                </tr>
            </table>
            
            <?php // Admin muze prirazovat prava uzivatelum
                if ($tplData["isAdmin"]) { 
            ?>
            <div id="spravaUzivatelu">
                <p>Správa uživatelů</p>
                <form class="row" href="index.php?page=profil" method="post">
                    <div class="col-md-6">
                        <span>Uživatel: 
                        <select name="uzivatel">
                            <?php foreach($tplData["users"] as $user) {
                                    echo "<option value=\"".$user['login']."\">".$user['login']." (".$user['nazev'].")</option>";
                                } ?>
                        </select></span>
                    </div>
                    <div class="col-md-4">
                        <span>Právo:
                        <select name="pravo">
                            <?php foreach($tplData["rights"] as $right) {
                                    echo "<option value=\"".$right."\">".$right."</option>";
                                } ?>
                        </select></span>
                    </div>
                    <div class="col-md-2">
                    <input id="changeBtn" type="submit" name="changeRight" value="Přiřaď">
                    </div>
                </form>
            </div>
            <?php 
                } 
            ?>
        </div>
        
        <!-- Zobrazeni vsech prispevku daneho uzivatele -->
       <button id="reportsBtn" data-toggle="collapse" data-target="#userReports">Seznam příspěvků</button>
        
        <div id="userReports" class="collapse">
            <?php 
                if ($tplData["reports"] != null) 
                    foreach($tplData["reports"] as $report) { 
            ?>
            <div class="report">
                <div class="line">
                    <span id="date"><?php echo $report["datum_prispevku"]?></span><br>
                    <span id="name"><?php echo $report["nazev"]?></span><br>
                </div>
                <p align="justify"><?php echo $report["popis"]?></p><br>
            </div>
                        
            <?php   
                    }
                else {
            ?>
                <span id="noReports"> Žádné příspěvky.</span>
            <?php    
                }
            ?>
        </div>
        
        <?php } 
        /* Zmena osobnich udaju */ 
            else { 
        ?>
            <a id="changeBtn" href="index.php?page=profil">Zpět</a> 
             <div class="items">        
                <form action="index.php?page=profil" method="post" oninput="testPassword()">
                    <fieldset>
                        <legend>Změna hesla</legend>
                        <table>
                            <tr>
                                <td><label for="pass1">Nové heslo:</label></td>
                                <td class="value2"><input type="password" name="newPass" id="pass1"></td><br>
                            </tr>
                            
                            <tr>
                                <td><label for="pass2">Zopakovat heslo:</label></td>
                                <td class="value2"><input type="password" name="repeatPass" id="pass2"></td>
                            </tr>
                            <tr>
                                <td></td><td class="value2"><output id="output" name="out" for="pass1 pass2"></output></td>
                            </tr>
                        </table>
                        <input id="submitBtn" type="submit" name="changePassword" value="Změnit">       
                    </fieldset>
                </form>
                <form action="index.php?page=profil" method="post">
                    <fieldset>
                        <legend>Změna jména ve hře</legend>
                        <table>
                            <tr>
                                <td><label for="nick">Nové jméno:</label></td>
                                <td class="value2"><input type="text" name="gameNick" id="nick"></td>
                            </tr>
                        </table>
                        <input id="submitBtn" type="submit" name="changeNick" value="Změnit">
                    </fieldset>
                </form>  
            </div>
        <?php 
            } 
        ?>    
    </div>

<?php 
$hlavicky->getFooter();
?>