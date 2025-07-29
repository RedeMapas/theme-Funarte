<?php

/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\Funarte\Theme $this
 */

use MapasCulturais\i;

?>

<?php
$circuits_url = $app->view->asset('img/home/home-circuits/circuits.gif', false);
?>

<?php
$circuits_brasil_url = $app->view->asset('img/home/home-circuits/artBrasil.png', false);
?>

<section class="hero-circuits">
    <div class="hero-circuits--top">
        <div class="hero-circuits--text">
            <h1>Circuitos Artísticos</h1>
            <div class="hero-circuits--image---brasil">
                <img src="<?= $circuits_brasil_url ?>" alt="Logo brasil descontruído" />
            </div>
            <p>Dos pampas gaúchos ao sertão nordestino, os <strong>Circuitos Artísticos</strong> percorrem o país levando música, teatro, dança, literatura e muito mais. São eventos que integram projetos contemplados pelos editais da Rede das Artes, promovendo encontros entre territórios, saberes e linguagens.</p>
        </div>
        <div class="hero-circuits--image">
            <img src="<?= $circuits_url ?>" alt="Imagem de Pessoas vibrando" />
        </div>
    </div>
    <button>
        <a href="<?= $app->createUrl("search","events")?>">Ver Circuitos Artísticos</a>
    </button>
</section>