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
            <h1><?= $this->text('title', i::__('A Funarte realiza circuitos artísticos pelo Brasil')) ?></h1>
            <div class="hero-circuits--image---brasil">
                <img src="<?= $circuits_brasil_url ?>" alt="Logo brasil descontruído" />
            </div>
            <p><?= $this->text('title', i::__('Conheça e acompanhe as apresentações, espetáculos, shows, circos itinerantes, exposições, além de atividades de intercâmbio, mediação e formação apoiados pelo <strong>Programa Funarte de Difusão Nacional</strong> por meio dos cinco <strong>circuitos artísticos</strong> voltados a cada uma das linguagens artísticas de atribuição da Funarte: o Circuito Funarte de Artes Visuais Marcantonio Vilaça, o Circuito Funarte de Circo Carequinha, o Circuito Funarte de Dança Klauss Vianna, o Circuito Funarte de Música Pixinguinha e o Circuito Funarte de Teatro Myriam Muniz.')) ?></p>
        </div>
        <div class="hero-circuits--image">
            <img src="<?= $circuits_url ?>" alt="Imagem de Pessoas vibrando" />
        </div>
    </div>
    <button>
        <a href="<?= $app->createUrl("search","events")?>"><?= $this->text('title', i::__('Ver Circuitos Artísticos')) ?></a>
    </button>
</section>