<?php

// pripojim objekt pro vypis hlavicky a paticky HTML
require("views/zaklad.php");

$hlavicky = new Zaklad();

global $tplData;

$hlavicky->getHeader($tplData['title']);
?>
<div class="background3">
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
                    Dokud žiješ, tak jsi ještě neprohrál. I přesto, že stav bitvy nevypadá příliš přívětivě pro tvojí stranu, tak pořád můžeš udělat hodně v té bitvě. Nebuď jeden z těch, co vzdávají bitvu, ještě před tím, než vůbec začla. 
                </div>
            </div>
                
            <div class="tipBox">    
                <button id="tip" data-toggle="collapse" data-target="#tip4">4. Snaž se doměřovat rány.</button><br>
                <div id="tip4" class="collapse">
                    Někdy i jediná neproměnená rána, může mít velké následky. Proto pokud máš čas doměřit ránu, udělej to!
                </div>
            </div>
            
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip5">5. Tvůj tank není neprůstřelný.</button><br>
                <div id="tip5" class="collapse">
                    Nespoléhej na to, že tvůj tank nepřítel neprostřelí. Každý hráč má možnost střílet "goldovou" munici a najednou se tvůj neprůstřelný tank, změní v papír.
                </div>
            </div>
                
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip6">6. Nespoléhej na spoluhráče.</button><br>
                <div id="tip6" class="collapse">
                    Wotko je sice týmová hra, ale na "publicu" (v náhodných bitvách) je velmi nebezpečné spoléhat na své spoluhráče. 
                </div>
            </div>
            
            <div class="tipBox">
                <button id="tip" data-toggle="collapse" data-target="#tip7">7. Analyzuj sestavu týmů před bitvou.</button>
                <div id="tip7" class="collapse">
                    Ještě před tím, než začne bitva, projdi si sestavy obou týmů. Představ si, kam by jsi jel, kdybys byl na jejich místě a podle toho uzpůsob svojí taktiku. 
                </div>
            </div>
        </div>
</div>

<?php
$hlavicky->getFooter();
?>