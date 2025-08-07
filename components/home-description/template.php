<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\Funarte\Theme $this
 */

use MapasCulturais\i;

$mapa_img = $app->view->asset('img/home/home-description/mapa.svg', false);
?>

<section class="home-network">
    <div class="home-network__container">
        <div class="home-network__text">
            <h2 class="title">EM REDE, AS ARTES BRASILEIRAS<br>SE FORTALECEM!</h2>
            <p class="description">
                A <strong>Rede das Artes</strong> é uma plataforma colaborativa onde as artes brasileiras se encontram, se conectam e se fortalecem. Um mapa vivo de <strong>agentes, projetos, eventos e espaços artísticos</strong> compõe este retrato dinâmico dos circuitos artísticos que tecem redes criativas no Brasil, permitindo identificar e articular parcerias, compartilhar oportunidades e construir uma agenda cultural ampla e acessível para todo o público.<br/><br/>

                <strong>Faça parte!</strong> Experimente a plataforma, crie ou atualize seu perfil, registre seus espaços e iniciativas artísticas e divulgue suas atividades. Em rede, as artes são ainda mais potentes!
            </p>
        </div>
        <div class="home-network__image">
            <img src="<?= $mapa_img ?>" alt="Mapa do Brasil por regiões" />
        </div>
    </div>
</section>
