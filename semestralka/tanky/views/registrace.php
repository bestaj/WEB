<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad_prihlaseni.php");

$hlavicky = new ZakladPrihlaseni();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
    <div class="contentBox">
        <div class="form">
            <?php if ($tplData['loginAlreadyExist']) { ?>
                    <span>Tento login již existuje.</span>
            <?php } else { 
                        if ($tplData['differentPassword']) { ?>
                            <span>Hesla nejsou stejná.</span>
                <?php   }
                    }
            ?>
            <form class="reg-form" action="index.php?page=registrace" method="post">
                <label for="login">*Uživatelské jméno</label>
                <input type="text" name="log-in" id="login" required>
                <label for="p1">*Heslo</label>
                <input type="password" name="pass1" id="p1" required>
                <label for="p2">*Zopakovat heslo</label>
                <input type="password" name="pass2" id="p2" required>
                <output name="comp" for="p1 p2"></output>
                <label for="email">*Email</label>
                <input type="email" name="email" id="email" required>
                <label for="nick">Jméno ve hře</label>
                <input type="text" name="nick" id="nick">
                <p>*povinné údaje</p>
                <input id="submitBtn" type="submit" name="potvrzeni" value="Zaregistrovat">
                 <p class="zprava">Již jste zaregistrovaní?<br><a href="index.php?page=prihlaseni">Přihlásit</a></p>
            </form>
            <a href="index.php?page=domu">Zpět na domovskou stránku</a>
        </div>
    </div>

<?php 
$hlavicky->getFooter();
    
?>