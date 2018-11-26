<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>   <div class="content">
        <div class="myContainer">
            <div class="article">
                <h1>Poděl se o své zkušenosti ze světa tanků a pomož tak se zlepšit začínajícím hráčům!</h1>

                <h2>Tvorba a obsah webu</h2>
                Tento web byl vytvořen za účelem sdílení svých zkušeností z "wotka" mezi hráči, tak aby se každý tankista mohl přiučit něco nového a lépe tak ovládnout bojiště s jakýmkoliv tankem.
                Každý hráč se zde může podělit o své dosavadní zkušenosti a poznatky ze hry a tak pomoct začínajícím, avšak zapáleným tankistům, kteří se touží zlepšovat v této hře.



                <h2>Co je World of Tanks</h2>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Fusce nibh. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Vivamus luctus egestas leo. Duis viverra diam non justo. Fusce suscipit libero eget elit. Mauris metus. Quisque tincidunt scelerisque libero. Etiam egestas wisi a erat. Mauris dictum facilisis augue. In enim a arcu imperdiet malesuada. Nulla est. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Nunc tincidunt ante vitae massa. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Praesent in mauris eu tortor porttitor accumsan. Aliquam erat volutpat. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Nulla pulvinar eleifend sem.
            </div>
        </div>
     </div>
<?php 
$hlavicky->getFooter();
?>