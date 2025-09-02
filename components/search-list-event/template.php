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
    <mc-loading :condition="loading && page == 1"></mc-loading>
    <div v-if="!loading || page > 1" class="col-9 search-list__cards">
        <div class="grid-12">
            <div v-for="eventGroup in groupedEvents" :key="eventGroup.event.id" class="col-12 event-group">
                <div class="entity-card__header occurrence-card__card">
                    <div class="entity-card__header occurrence-card__header">
                        <mc-avatar :entity="eventGroup.event" size="medium"></mc-avatar>
                        <div class="user-info">
                            <a :href="eventGroup.event.singleUrl">
                                <mc-title  tag="h2" class="bold">
                                    {{eventGroup.event.name}}
                                </mc-title>
                            </a>
                            <div class="user-info__attr">
                                <span> {{eventGroup.event.subTitle}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="entity-card__header user-slot">
                        <slot name="labels"></slot>
                    </div>
                </div>
                <div class="entity-card__content--event-info">
                    <div class="entity-card__content--occurrence-info">
                        <div class="ageRating">
                            <span class="ageRating__class uppercase"><?= i::__('Classificação') ?><strong>: </strong></span>
                            <span class="ageRating__value uppercase">{{eventGroup.event.classificacaoEtaria}}</span>
                        </div>
                    </div>
                    <div class="entity-card__content--terms">
                        <div v-if="eventGroup.event.terms && eventGroup.event.terms.tag && eventGroup.event.terms.tag.length > 0" class="entity-card__content--terms-tag">
                            <label class="tag__title">
                                <?php i::_e('Tags:') ?> ({{eventGroup.event.terms.tag.length}}):
                            </label>
                            <p class="terms event__color"> {{eventGroup.event.terms.tag.join(', ')}} </p>
                        </div>
                        <div v-if="eventGroup.event.terms && eventGroup.event.terms.linguagem && eventGroup.event.terms.linguagem.length > 0" class="entity-card__content--terms-linguagem">
                            <label class="linguagem__title">
                                <?php i::_e('linguagens:') ?> ({{eventGroup.event.terms.linguagem.length}}):
                            </label>
                            <p class="terms event__color"> {{eventGroup.event.terms.linguagem.join(', ')}} </p>
                        </div>
                    </div>
                    <div v-if="eventGroup.event.seals && eventGroup.event.seals.length > 0" class="entity-card__footer--info">
                        <div class="seals">
                            <label class="seals__title">
                                <?php i::_e('Selos') ?> ({{eventGroup.event.seals.length}}):
                            </label>
                            <div v-for="seal in eventGroup.event.seals.slice(0, 2)" class="seals__seal"></div>
                            <div v-if="eventGroup.event.seals.length > 2" class="seals__seal more">+{{eventGroup.event.seals.length - 2}}</div>
                        </div>
                    </div>
                </div>
                <div v-for="occurrence in eventGroup.occurrences" :key="occurrence._reccurrence_string" class="col-12">
                    <occurrence-card :occurrence="occurrence" ></occurrence-card>
                </div>
            </div>

            <div v-if="occurrences.metadata && occurrences.metadata.page < occurrences.metadata.numPages" class="col-12 load-more">
                <mc-loading :condition="loading && page > 1"></mc-loading>
                <button v-if="!loading" class="button--large button button--primary-outline" @click="loadMore()"><?php i::_e('Carregar Mais') ?></button>
            </div>
        </div>
    </div>
</div>
