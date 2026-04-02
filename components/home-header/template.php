<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    home-search
');

/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */
$banner_url = $app->view->asset('img/home/home-main-header/banner.png', false);
$logos_url = $app->view->asset('img/home/home-main-header/logos.png', false);

/* <div :class="['home-header', {'home-header--withBanner' : banner}] "> */
/*     <div class="home-header__content"> */
?>
<section class="hero-banner">
  <div class="hero-banner__content">
    <div class="hero-banner__text">
      <h2>
        Promover encontros<br>
        Aproximar territórios<br>
        Tecer redes
      </h2>

      <p>
        Faça parte da Rede das Artes!<br>
      </p>

      <img src="<?= $logos_url ?>" alt="Logos em tons de branco" />


    </div>

    <div v-if="banner || secondBanner" class="home-header__banners">
        <div v-if="banner" class="home-header__banner">
            <a v-if="bannerLink" :href="bannerLink" :download="downloadableLink ? '' : undefined"  :target="!downloadableLink ? '_blank' : null">
                <img :src="banner" />
            </a>
            <img v-if="!bannerLink" :src="banner" />
        </div>

        <div v-if="secondBanner" class="home-header__banner">
            <a v-if="secondBannerLink" :href="secondBannerLink" :download="secondDownloadableLink ? '' : undefined"  :target="!secondDownloadableLink ? '_blank' : null">
                <img :src="secondBanner" />
            </a>
            <img v-if="!secondBannerLink" :src="secondBanner" />
        </div>

        <div v-if="thirdBanner" class="home-header__banner">
            <a v-if="thirdBannerLink" :href="thirdBannerLink" :download="thirdDownloadableLink ? '' : undefined"  :target="!thirdDownloadableLink ? '_blank' : null">
                <img :src="thirdBanner" />
            </a>
            <img v-if="!thirdBannerLink" :src="thirdBanner" />
        </div>
    </div>
  
    <div class="hero-banner__image">
      <img src="<?= $banner_url ?>" alt="Formas gráficas coloridas" />
    </div>
  </div>
</section>
