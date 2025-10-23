<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-loading
    occurrence-card
');
?>

<div class="grid-12 search-list">
    <mc-loading :condition="loading && page === 1"></mc-loading>

    <!-- Compact, grouped by event -->
    <template v-if="groupByEvent">
        <div v-if="!loading || page > 1" class="col-12 search-list__cards">
            <div class="grid-12">
                <div v-if="!loading && groupedEvents.length === 0" class="col-12 no-results">
                    <h3><?= i::__('Nenhuma ocorrência encontrada.') ?></h3>
                </div>
                <div v-for="group in groupedEvents" :key="group.event.id" class="col-12 compact-event-group">
                    <a class="compact-event-title" :href="group.event.singleUrl">{{ group.event.name }}</a>
                    <ul class="compact-occ-list">
                        <li v-for="occurrence in group.occurrences" :key="occurrence._reccurrence_string">
                            {{ occurrence.starts.date('short') }} <?= i::__('às') ?> {{ occurrence.starts.time() }}
                            <template v-if="occurrence.space">
                                — <a :href="occurrence.space.singleUrl">{{ occurrence.space.name }}</a>
                            </template>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </template>

    <!-- Default cards layout -->
    <template v-else>
        <div v-if="!loading || page > 1" class="col-12 search-list__cards">
            <div class="grid-12">
                <div v-for="occurrence in occurrences" :key="occurrence._reccurrence_string" class="col-4">
                    <div v-if="newDate(occurrence)" class="search-list__cards--date">
                        <div class="search-list__cards--date-info">
                            <h2 v-if="occurrence.starts.isToday()" class="actual-date">
                                <?= i::__('Hoje') ?>
                                <label class="month"><?= i::__('{{occurrence.starts.month()}}') ?></label>
                            </h2>
                            <h2 v-else-if="occurrence.starts.isTomorrow()" class="actual-date">
                                <?= i::__('Amanhã') ?>
                                <label class="month"><?= i::__('{{occurrence.starts.month()}}') ?></label>
                            </h2>
                            <h2 v-else-if="occurrence.starts.isYesterday()" class="actual-date">
                                <?= i::__('Ontem') ?>
                                <label class="month"><?= i::__('{{occurrence.starts.month()}}') ?></label>
                            </h2>
                            <template v-else>
                                <h2 class="actual-date">
                                    {{ occurrence.starts.day() }}
                                    <label class="month"><?= i::__('{{occurrence.starts.month()}}') ?></label>
                                </h2>
                            </template>
                            <label class="weekend">{{ occurrence.starts.weekday() }}</label>
                        </div>
                        <div class="search-list__cards--date-line"></div>
                    </div>
                    <occurrence-card :occurrence="occurrence"></occurrence-card>
                </div>
            </div>
        </div>
    </template>
</div>
