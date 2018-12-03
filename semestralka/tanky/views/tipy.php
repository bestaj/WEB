<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
<div class="content3">
        <div class="myContainer">
            
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip1">1. Sleduj minimapu.</button><br>
                <div id="tip1" class="collapse">
                    Minimapa je největším pomocníkem. Díky ní hráč ví, co se děje po celý mapě a i kolem něj.
                </div>
            </div>
            
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip2">2. Šetři si každé HP.</button><br>
                <div id="tip2" class="collapse">
                    V některých situacích rozhodují jednotky HP a někdy i to, že přijdeš o nepatrný množství HP kvůli nedbalé jízdě, Tě může nakonec stát vítězství. Nebuď zbytečně agresivní, pokud si to situace nevyžaduje.
                </div>
            </div>
            
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip3">3. Nikdy se nevzdávej.</button><br>
                <div id="tip3" class="collapse">

                </div>
            </div>
                
            <div class="tipBox">    
                <button id="tip" data-toggle="collapse" data-target="#tip4">4. Snaž se doměřovat rány.</button><br>
                <div id="tip4" class="collapse">

                </div>
            </div>
            
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip5">5. Tvůj tank není neprůstřelný.</button><br>
                <div id="tip5" class="collapse">

                </div>
            </div>
                
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip6">6. Nespoléhej na spoluhráče.</button><br>
                <div id="tip6" class="collapse">

                </div>
            </div>
            
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip7">7. Analyzuj sestavu týmů před bitvou.</button>
                <div id="tip7" class="collapse">

                </div>
            </div>
            
            
        </div>
</div>



<?php
$hlavicky->getFooter();
?>