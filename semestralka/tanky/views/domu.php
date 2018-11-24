<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
    <div class="myContainer">
        <div class="clanek">
            <h1>Účel webových stránek</h1>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Fusce nibh. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Vivamus luctus egestas leo. Duis viverra diam non justo. Fusce suscipit libero eget elit. Mauris metus. Quisque tincidunt scelerisque libero. Etiam egestas wisi a erat. Mauris dictum facilisis augue. In enim a arcu imperdiet malesuada. Nulla est. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Nunc tincidunt ante vitae massa. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Praesent in mauris eu tortor porttitor accumsan. Aliquam erat volutpat. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Nulla pulvinar eleifend sem.
        </div>
        
        <div class="clanek">
            <h1>Co je World of Tanks</h1>
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Fusce nibh. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Vivamus luctus egestas leo. Duis viverra diam non justo. Fusce suscipit libero eget elit. Mauris metus. Quisque tincidunt scelerisque libero. Etiam egestas wisi a erat. Mauris dictum facilisis augue. In enim a arcu imperdiet malesuada. Nulla est. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Nunc tincidunt ante vitae massa. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Praesent in mauris eu tortor porttitor accumsan. Aliquam erat volutpat. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Nulla pulvinar eleifend sem.
        </div>
    </div>

<?php 
$hlavicky->getFooter();
?>