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

<div class="project-occurrences">
    <mc-loading :condition="loading"></mc-loading>

    <div v-if="!loading">
        <div v-if="occurrences.length" class="project-occurrences__section project-occurrences__occurs">
            <h4><?= i::__('Próximas ocorrências') ?></h4>
            <div class="grid-12">
                <div class="col-12" v-for="occ in occurrences" :key="occ._reccurrence_string">
                    <occurrence-card :occurrence="occ"></occurrence-card>
                </div>
            </div>
        </div>
        <div v-if="!occurrences.length" class="project-occurrences__section">
            <span class="project-occurrences__meta"><?= i::__('Sem eventos ou ocorrências vinculadas.') ?></span>
        </div>
    </div>
</div>
