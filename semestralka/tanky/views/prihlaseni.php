<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad_prihlaseni.php");

$hlavicky = new ZakladPrihlaseni();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
    <div class="loginPage">
        <div class="form">
            <?php if (!$tplData['prihlaseniOK']) { ?>
                    <span class="incorectLogin">Nesprávné jméno nebo heslo!</span>
                <?php } ?>
            <form class="log-form" action="index.php?page=prihlaseni" method="post">
                <label for="log-in">Uživatelské jméno</label>
                <input type="text" name="log-in" required>
                <label for="pass">Heslo</label>
                <input type="password" name="pass" required>
                <input id="submitBtn" type="submit" name="login" value="Přihlásit">
                <p class="zprava">Ještě nejste zaregistrovaní?<br><a href="index.php?page=registrace">Zaregistrovat</a></p>
            </form>
            <a href="index.php?page=domu">Zpět na domovskou stránku</a>
        </div>
    </div>

<?php 
$hlavicky->getFooter();
?>

