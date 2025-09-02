<?php

/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\Funarte\Theme $this
 */

use MapasCulturais\i;

?>
<?php $this->applyTemplateHook('mc-header-menu-circuitos', 'before') ?>
<li>
    <?php $this->applyTemplateHook('mc-header-menu-circuitos', 'begin') ?>
    <a href="<?= $app->createUrl('circuitos', 'index') ?>" class="mc-header-menu--item circuitos">
        <span class="icon"> <mc-icon name="circuitos"> </span>
        <p class="label"> <?php i::_e('Circuitos') ?> </p>
    </a>
    <?php $this->applyTemplateHook('mc-header-menu-circuitos', 'end') ?>
</li>
<?php $this->applyTemplateHook('mc-header-menu-circuitos', 'after') ?>