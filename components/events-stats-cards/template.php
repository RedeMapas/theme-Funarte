<?php

/**
 * @var MapasCulturais\App $app
 * @var Funarte\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-icon 
');

?>

<div class="events-stats-cards">
    <div class="events-stats-cards__container">
        <div class="events-stats-cards__container__content">
            <div class="events-stats-cards__container__content__header">
                <p class="events-stats-cards__container__content__header__quantity">{{ countRegisteredEvents }}</p>
                <div class="events-stats-cards__container__content__header__icon">
                    <mc-icon name="docs"></mc-icon>
                </div>
            </div>
            <p class="events-stats-cards__container__content__description"><?= i::__('evento(s) cadastrado(s)') ?></p>
        </div>
    </div>

    <div class="events-stats-cards__container">
        <div class="events-stats-cards__container__content">
            <div class="events-stats-cards__container__content__header">
                <p class="events-stats-cards__container__content__header__quantity">{{ countOccurrences }}</p>
                <div class="events-stats-cards__container__content__header__icon">
                    <mc-icon name="dateWeek"></mc-icon>
                </div>
            </div>
            <p class="events-stats-cards__container__content__description"><?= i::__('evento(s) realizado(s)') ?></p>
        </div>
    </div>

    <div class="events-stats-cards__container">
        <div class="events-stats-cards__container__content">
            <div class="events-stats-cards__container__content__header">
                <p class="events-stats-cards__container__content__header__quantity">{{ countFinishedOcurrences }}</p>
                <div class="events-stats-cards__container__content__header__icon">
                    <mc-icon name="dateCheck"></mc-icon>
                </div>
            </div>
            <p class="events-stats-cards__container__content__description"><?= i::__('evento(s) finalizado(s)') ?></p>
        </div>
    </div>

    <div class="events-stats-cards__container">
        <div class="events-stats-cards__container__content">
            <div class="events-stats-cards__container__content__header">
                <p class="events-stats-cards__container__content__header__quantity">{{ countLastSevenDaysEvents }}</p>
                <div class="events-stats-cards__container__content__header__icon">
                    <mc-icon name="dateDay"></mc-icon>
                </div>
            </div>
            <p class="events-stats-cards__container__content__description"><?= i::__('cadastrado(s) nos últimos 7 dias') ?></p>
        </div>
    </div>
</div>