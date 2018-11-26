<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad_prihlaseni.php");

$hlavicky = new ZakladPrihlaseni();

global $tplData;

$hlavicky->getHeader($tplData['title']);

?>
    <div class="profilBox">
        <a class="glyphicon glyphicon-home" href="index.php?page=domu"></a>
        <div class="userInfo">
            <span>Uživatelské jméno:    <?php echo $_SESSION["user"]["login"] ?></span> <br>
            <span>Jméno ve hře:         <?php echo $_SESSION["user"]["jmeno_ve_hre"] ?></span> <br>
            <span>Email:                <?php echo $_SESSION["user"]["email"] ?></span> <br>
            <span>Přidělené právo:      <?php echo $_SESSION["user"]["nazev"] ?></span> <br>
        </div>
        
       <button data-toggle="collapse" data-target="#userAdded">Seznam příspěvků</button>
        
        <div id="userAdded" class="collapse">
        dkjshgfjshgfihjgiehgrjknvkjegniewnfij
        </div>
        
    </div>


<?php 
$hlavicky->getFooter();
?>