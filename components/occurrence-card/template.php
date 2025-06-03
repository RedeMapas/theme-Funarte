<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-avatar
    mc-icon
    mc-link
    mc-title
');
?>
<div class="entity-card occurrence-card">
    <div class="entity-card__content">
        <div class="entity-card__content--occurrence-data">
            <mc-icon name="event"></mc-icon> {{occurrence.starts.date('long')}} <?= i::_e('às') ?> {{occurrence.starts.time()}}
        </div>
        <div v-if="!hideSpace" class="entity-card__content--occurrence-space">
            <div class="link"><mc-icon class="link space__color" name="pin"></mc-icon></div>
            <div class="space-adress">
                <mc-link :entity="space">
                    <span class="space-adress__name space__color">{{space.name}}</span>
                </mc-link>
                <span class="space-adress__adress" v-if="space.endereco">- {{space.endereco}}</span>

            </div>
        </div>
        <div class="entity-card__content--occurrence-info">
            <div v-if="occurrence.price" class="price ageRating">
                <span class="ageRating__class"><?= i::__('Entrada') ?><strong>: </strong></span>

                <span class="ageRating__value">{{occurrence.price}}</span>
            </div>
        </div>
    </div>
</div>
