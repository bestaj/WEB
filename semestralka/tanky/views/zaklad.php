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

            <link rel="stylesheet" href="views/css/CSS_zaklad.css">

        </head>
        <body>
            <header>
                <div class="loginPanel">Oficiální stránky World of Tanks: <a href="https://worldoftanks.eu/">worldoftanks.eu</a>
                <?php $this->getLoginBox()?>
                </div>
                <p id="title">Buď lepší<br><span>ve</span><br>World of Tanks</p>                
            <div class="myNav">
                <!--
                <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                </div>
                -->
                <div id="myNavbar">
                    <ul>
                        <li><a href="index.php?page=domu">Domů</a></li>
                        <li><a href="index.php?page=tanky">Tanky</a></li> 
                        <li><a href="index.php?page=mapy">Mapy</a></li> 
                        <li><a href="index.php?page=tipy">Rady a Tipy</a></li> 
                    </ul>
                </div>
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
    
    /**
     * Pro prihlaseneho uzivatele vypise do praveho horniho rohu jeho rozbalovaci tlacitko s jeho loginem.
     * Po rozbaleni se zobrazi moznost prepnuti na profil nebo odhlaseni.
     * Pro neprihlaseneho uzivatele je misto toho vypsan odkaz pro prihlaseni.
     */
    public function getLoginBox() {
        if(isset($_SESSION["user"])) { ?>
            <div class="dropdown">
                <button class="userBtn dropdown-toggle glyphicon glyphicon-user" type="button" data-toggle="dropdown">
                    <?php echo $_SESSION["user"]["login"] ?></button>
                <ul class="dropdown-menu">
                    <li><a id="log" href="index.php?page=profil">Profil</a></li>
                    <li><form action="index.php?page=<?php echo $_SESSION['logoutPage']?>" method="post">
                            <input id="log" type="submit" name="logout" value="Odhlásit">
                        </form>
                    </li>
                </ul>
            </div>
            
            <?php
        }
        else { ?>
            <a id="login" href="index.php?page=prihlaseni">Přihlásit</a>
        <?php
        }
    }
}
?>