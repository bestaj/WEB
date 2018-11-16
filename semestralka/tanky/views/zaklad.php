<?php

/**
 * Trida vypisujici HTML hlavicky stranky
 */
class Zaklad {
    
    /**
     *  Vrati vrsek stranky az po oblast, 
     *  ve ktere se vypisuje obsah stranky.
     *  @param string $title Nazev stranky.
     */
    public function getHeader($title) {
    ?>

    <!doctype>
    <html lang="cs">
        <head>
            <meta charset="utf-8">
            <title><?php echo $title; ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1">


            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <link rel="stylesheet" href="views/css/CSS_default.css">

        </head>
        <body>
            <header>
                <span class="loginPanel">Login</span>
                <p class="title">Buď lepší<br><span>ve</span><br>World of Tanks</p>                
            <div> 
                <ul class="myNav">
                    <li class="active"><a href="index.php?page=domu">Domů</a></li>
                    <li><a href="index.php?page=tanky">Tanky</a></li> 
                    <li><a href="index.php?page=mapy">Mapy</a></li> 
                    <li><a href="index.php?page=tipy">Rady/Tipy</a></li> 
                </ul>
            </div>
            </header>                
    <?php
        }

    /**
     *  Vrati paticku stranky.
     */
    public function getFooter() {
    ?>          
            
        </body>
    </html>

    <?php
    }
}
?>