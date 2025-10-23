<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('search-list-agenda');
?>

<div class="search-list-agenda-lazy" ref="lazyContainer">
    <div v-if="!isVisible" class="agenda-placeholder">
        <div class="loading-placeholder">
            <span>Carregando agenda...</span>
        </div>
    </div>
    <search-list-agenda 
        v-if="isVisible"
        ref="agendaList"
        :pseudo-query="pseudoQuery"
        :group-by-event="groupByEvent"
        :per-event-limit="perEventLimit"
        :limit="limit"
        :select="select"
        :space-select="spaceSelect"
    />
    <!-- Fallback: Botão manual caso o observer falhe -->
    <div v-if="!isVisible && !hasLoaded" class="manual-load">
        <button @click="forceLoad" class="button button--primary-outline">
            Carregar Agenda
        </button>
    </div>
</div>