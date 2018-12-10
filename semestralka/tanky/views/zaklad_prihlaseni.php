<?php

/**
 * Trida vypisujici HTML hlavicky stranky pro prihlaseni a registraci uzivatele
 */
class ZakladPrihlaseni {
    
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
            <meta charset="utf8">
            <title><?php echo $title; ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="views/css/CSS_zaklad_prihlaseni.css">
            
            <script>
                // Testovani shodnosti hesel pri zmene hesla uzivatele
                function testPassword() {
                    if (document.getElementById('pass1').value == document.getElementById('pass2').value) {
                        document.getElementById('submitBtn').disabled=false;
                        document.getElementById('output').innerHTML = "";
                    }
                    else {
                        document.getElementById('output').innerHTML = "Nestejná hesla";
                        document.getElementById('submitBtn').disabled=true;
                    }
                }  
            </script>
        </head>
        <body>
            <header>
                <div id="title">
                    <?php echo $title ?>
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