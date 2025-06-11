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

<div class="agenda-wrapper">
    <div class="grid-12 search-list">
        <mc-loading :condition="loading && page === 1"></mc-loading>

        <div v-if="!loading || page > 1" class="col-12">
            <div class="search-section" v-if="occurrences.some(o => o.starts.isToday())">
                <div class="agenda-title"><?= i::__('Hoje') ?></div>
                <div class="grid-12 with-gap">
                    <div
                        v-for="occurrence in occurrences.filter(o => o.starts.isToday())"
                        :key="occurrence._reccurrence_string"
                        class="col-4"
                    >
                        <occurrence-card :occurrence="occurrence"></occurrence-card>
                    </div>
                </div>
            </div>

            <div class="search-section" v-if="occurrences.some(o => !o.starts.isToday())">
                <div class="agenda-title"><?= i::__('Próximos eventos') ?></div>
                <div class="grid-12 with-gap">
                    <div
                        v-for="occurrence in occurrences.filter(o => !o.starts.isToday())"
                        :key="occurrence._reccurrence_string"
                        class="col-4"
                    >
                        <occurrence-card :occurrence="occurrence"></occurrence-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>