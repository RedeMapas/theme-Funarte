<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\Funarte\Theme $this
 */

use MapasCulturais\i;

?>

<?php
$circuits_url = $app->view->asset('img/home/home-circuits/circuits.jpg', false);
?>

<div class="custom-background">
    <div class="divider-line"></div>
</div>
<section class="hero-circuits">
    <div class="hero-circuits--text">
      <h1>Circuitos Artísticos</h1>
      <p>
        Os Circuitos Artísticos, que traçam rotas no mapa do Brasil, promovem encontros entre territórios, saberes e linguagens; ampliando o <strong>acesso</strong>, a <strong>circulação</strong> e a valorização da <strong>produção artística</strong> brasileira em todas as regiões.
      </p>
      <button>
            <a href="<?= $app->createUrl("search","events")?>">Ver Circuitos Artísticos</a>
        </button>
    </div>
    <div class="hero-circuits--image">
      <img src="<?= $circuits_url ?>" alt="Imagem de Pessoas vibrando" />
    </div>
</section>
<div class="custom-background">
    <div class="divider-line"></div>
</div>