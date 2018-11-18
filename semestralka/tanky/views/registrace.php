<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad_prihlaseni.php");

$hlavicky = new ZakladPrihlaseni();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>

    <div class="formPanel">
        <form>
        
        </form>
    </div>

<?php 
$hlavicky->getFooter();
?>
