<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad_prihlaseni.php");

$hlavicky = new ZakladPrihlaseni();

global $tplData;

$hlavicky->getHeader($tplData['title']);

?>
    <div class="profilBox">
        <a class="homeLink glyphicon glyphicon-home" href="index.php?page=domu">Domů</a>
        <!-- Zobrazeni profilu, nelze menit osobni udaje -->
        
        <?php if (!$_SESSION["userInfoChange"]) { ?>
        <div class="userInfo">
            <button id="userInfoChangeBtn" type="button" onclick="<?php $_SESSION['userInfoChange'] = true ?>">
                    <a href="index.php?page=profil">Změnit osobní údaje</a></button>
            <table>
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
        </div>
        
       <button id="listOfContributionsBtn" data-toggle="collapse" data-target="#userAdded">Seznam příspěvků</button>
        
        <div id="userAdded" class="collapse">
        dkjshgfjshgfihjgiehgrjknvkjegniewnfij
        </div>
        
        <?php } 
        /* Zmena osobnich udaju */ 
        else { ?>
      
            <button id="userInfoChangeBtn" type="button" onclick="<?php $_SESSION['userInfoChange'] = false ?>">
                    <a href="index.php?page=profil">Zpět</a></button>
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
                                <td class="value2"><output id="output" name="out" for="pass1 pass2"></output></td>
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
        <?php } ?>    
    </div>
    

<?php 
$hlavicky->getFooter();
?>