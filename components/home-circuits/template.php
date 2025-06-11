<?php

/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\Funarte\Theme $this
 */

use MapasCulturais\i;

?>

<div class="circuits" style="background-image: url('<?php $image_circuits = $app->view->asset("img/home/home-circuits/home-circuits2.jpg") ?>');">
    <div class="circuits--text">
        <h1>Circuitos Artísticos</h1>
        <p>Os Circuitos Artísticos, que traçam rotas no mapa do Brasil, promovem encontros entre territórios, saberes e linguagens; ampliando o <strong>acesso</strong>, a <strong>circulação</strong>e a valorização da <strong>produção artística </strong>brasileira em todas as regiões.</p>
        <ul>
            <li>Atividades gratuitas em diferentes cidades</li>
            <li>Programação diversa e itinerante</li>
            <li>Projetos selecionados via chamadas da Funarte</li>
        </ul>
        <button>
            <a href="<?= $app->createUrl("search", "events") ?>">Ver Circuitos Artísticos</a>
        </button>
    </div>
</div>