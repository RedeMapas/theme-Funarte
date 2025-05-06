<?php 
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

// Adiciona ícones exclusivos do tema da Funarte.
$app->hook('component(mc-icon).iconset', function(&$iconset) {
    $iconset['dateDay'] = 'fa-solid:calendar-day';
    $iconset['dateCheck'] = 'fa-solid:calendar-check';
    $iconset['dateWeek'] = 'fa-solid:calendar-week';
    $iconset['docs'] = 'bxs:file';
});

?>
<iconify :class="{'iconify--link':isLink}" :icon="icon"></iconify>