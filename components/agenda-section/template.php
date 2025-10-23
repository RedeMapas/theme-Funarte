<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-icon
    mc-loading
');
?>

<div class="agenda-section">
    <div class="agenda-content">
        <div v-if="agendaLoading && agendaOccurrences.length === 0" class="agenda-loading">
            <mc-loading></mc-loading>
            <span><?php i::_e('Carregando agenda...') ?></span>
        </div>

        <div v-else-if="!hasAgendaEvents && hasAgendaLoaded" class="no-events-message">
            <p>
                <mc-icon name="calendar"></mc-icon>
                <?php i::_e('Não há eventos cadastrados.') ?>
            </p>
        </div>

        <div v-else-if="hasAgendaEvents" class="agenda-events">
            <div
                v-for="eventGroup in groupedEvents"
                :key="eventGroup.event.id"
                class="event-row"
            >
                <div class="event-name">
                    <h4><a :href="eventGroup.event.singleUrl">{{ eventGroup.event.name }}</a></h4>
                </div>
                <div class="event-occurrences-wrapper">
                    <div class="occurrences-container" :ref="'container_' + eventGroup.event.id">
                        <div
                            v-for="occurrence in eventGroup.occurrences"
                            :key="occurrence.id"
                            class="occurrence-item"
                        >
                            <div class="occurrence-date">
                                <mc-icon name="calendar"></mc-icon>
                                <span>{{ occurrence.starts.date('short') }} <?= i::__('às') ?> {{ occurrence.starts.time() }}</span>
                            </div>
                            <div v-if="occurrence.space" class="occurrence-location">
                                <mc-icon name="map-marker"></mc-icon>
                                <div class="location-details">
                                    <div class="space-name">
                                        <strong><?php i::_e('Nome do Espaço:') ?></strong>
                                        <span>{{ occurrence.space.name }}</span>
                                    </div>
                                    <div v-if="occurrence.space.endereco" class="space-address">
                                        {{ occurrence.space.endereco }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

