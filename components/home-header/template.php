<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */
?>

<?php
$logo_url = $app->view->asset('img/home/home-header/logo-banner.png', false);
?>

<?php
$mapa_url = $app->view->asset('img/home/home-header/mapa-banner.jpg', false);
?>

<section class="hero">
    <div class="hero-text">
      <img src="<?= $logo_url ?>" alt="Logo Funarte" />
      <h1>Bem-vindo à Plataforma<br>Rede das Artes</h1>
      <p>
        Aqui você se conecta com <strong>iniciativas culturais de todo o Brasil</strong>. Descobre
        <strong>eventos</strong>, encontra <strong>oportunidades</strong> e <strong>fortalece parcerias</strong>
        em uma rede viva e colaborativa de quem faz arte acontecer.
      </p>
    </div>
    <div class="hero-image">
      <img src="<?= $mapa_url ?>" alt="Mapa com Linhas Culturais" />
    </div>
</section>
