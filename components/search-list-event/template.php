<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-loading
    mc-icon
    mc-avatar
    mc-title
');
?>
<div class="grid-12 search-list">
    <mc-loading :condition="loading && page == 1"></mc-loading>
    <div v-if="!loading || page > 1" class="col-12 search-list__cards">
        <div class="grid-12">
            <div v-for="eventGroup in groupedEvents" :key="eventGroup.event.id" class="col-12 event-group detailed-event-card">
                
                <!-- Header with avatar and title -->
                <div class="event-header">
                    <mc-avatar :entity="eventGroup.event" size="large"></mc-avatar>
                    <div class="event-title">
                        <h2 class="event-name">{{eventGroup.event.name}}</h2>
                        <span v-if="eventGroup.event.subTitle" class="event-subtitle">{{eventGroup.event.subTitle}}</span>
                    </div>
                </div>

                <!-- Metadata section -->
                <div class="event-metadata">
                    <div class="metadata-row">
                        <span class="metadata-label">Id:</span>
                        <span class="metadata-value">{{eventGroup.event.id}}</span>
                        
                        <span class="metadata-label">Tipo:</span>
                        <span class="metadata-value metadata-type">{{eventGroup.event.type ? eventGroup.event.type.name : 'Evento'}}</span>
                    </div>
                </div>

                <!-- Period section -->
                <div v-if="eventGroup.event.registrationFrom || eventGroup.event.registrationTo" class="event-period">
                    <mc-icon name="calendar"></mc-icon>
                    <span class="period-label">Período:</span>
                    <span class="period-dates">
                        {{eventGroup.event.registrationFrom ? formatDate(eventGroup.event.registrationFrom) : ''}}
                        <span v-if="eventGroup.event.registrationFrom && eventGroup.event.registrationTo"> a </span>
                        {{eventGroup.event.registrationTo ? formatDate(eventGroup.event.registrationTo) : ''}}
                    </span>
                </div>

                <!-- Seals section -->
                <div v-if="eventGroup.event.seals && eventGroup.event.seals.length > 0" class="event-seals">
                    <span class="seals-label">Selos:</span>
                    <div class="seals-container">
                        <span v-for="(seal, index) in eventGroup.event.seals.slice(0, showAllSeals[eventGroup.event.id] ? eventGroup.event.seals.length : 4)" 
                              :key="seal.id" 
                              class="seal-chip" 
                              :style="{ backgroundColor: getSealColor(index) }">
                            {{seal.name}}
                        </span>
                        <button v-if="eventGroup.event.seals.length > 4" 
                                @click="toggleSeals(eventGroup.event.id)"
                                class="seal-toggle">
                            <span v-if="!showAllSeals[eventGroup.event.id]">+{{eventGroup.event.seals.length - 4}}</span>
                            <span v-else>Ver menos</span>
                        </button>
                    </div>
                </div>

                <!-- Description section -->
                <div v-if="eventGroup.event.shortDescription || eventGroup.event.longDescription" class="event-description">
                    <p>{{eventGroup.event.shortDescription || eventGroup.event.longDescription}}</p>
                </div>

                <!-- Classification and Languages -->
                <div class="event-classification-languages">
                    <div class="classification">
                        <span class="label">Classificação:</span>
                        <span class="value">{{eventGroup.event.classificacaoEtaria}}</span>
                    </div>
                    
                    <div v-if="eventGroup.event.terms && eventGroup.event.terms.linguagem && eventGroup.event.terms.linguagem.length > 0" 
                         class="languages">
                        <span class="label">Linguagens ({{eventGroup.event.terms.linguagem.length}}):</span>
                        <span class="value">{{eventGroup.event.terms.linguagem.join(', ')}}</span>
                    </div>
                </div>

                <!-- Events sections (EVENTO A, EVENTO B, etc.) -->
                <div v-for="(eventSection, sectionIndex) in groupEventsBySection(eventGroup.occurrences)" 
                     :key="sectionIndex" 
                     class="event-section">
                    <div class="event-section-header">
                        <h3 class="event-section-title">EVENTO {{String.fromCharCode(65 + sectionIndex)}}</h3>
                        <div class="event-section-navigation">
                            <button class="nav-button prev" @click="navigateSection(eventGroup.event.id, sectionIndex, -1)">
                                <mc-icon name="chevron-left"></mc-icon>
                            </button>
                            <button class="nav-button next" @click="navigateSection(eventGroup.event.id, sectionIndex, 1)">
                                <mc-icon name="chevron-right"></mc-icon>
                            </button>
                        </div>
                    </div>
                    
                    <div class="event-cards-container">
                        <div v-for="(occurrence, occIndex) in getVisibleOccurrences(eventSection, eventGroup.event.id, sectionIndex)" 
                             :key="occurrence._reccurrence_string" 
                             class="event-card">
                            <div class="event-card-date">
                                <mc-icon name="calendar"></mc-icon>
                                <span class="date-time">{{occurrence.starts.date('short')}} às {{occurrence.starts.time()}}</span>
                            </div>
                            <div class="event-card-space">
                                <mc-icon name="pin" class="space-icon"></mc-icon>
                                <div class="space-info">
                                    <span class="space-name">Nome do Espaço: {{occurrence.space.name}}</span>
                                    <span v-if="occurrence.space.endereco" class="space-address">{{occurrence.space.endereco}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tags section -->
                <div v-if="eventGroup.event.terms && eventGroup.event.terms.tag && eventGroup.event.terms.tag.length > 0" 
                     class="event-tags">
                    <span class="tags-label">Tags ({{eventGroup.event.terms.tag.length}}):</span>
                    <div class="tags-container">
                        <span v-for="tag in eventGroup.event.terms.tag" :key="tag" class="tag-item">{{tag}}</span>
                    </div>
                </div>

                <!-- Access button -->
                <div class="event-access">
                    <a :href="eventGroup.event.singleUrl" class="access-button">
                        Acessar
                        <mc-icon name="chevron-right"></mc-icon>
                    </a>
                </div>
            </div>

            <div v-if="occurrences.metadata && occurrences.metadata.page < occurrences.metadata.numPages" class="col-12 load-more">
                <mc-loading :condition="loading && page > 1"></mc-loading>
                <button v-if="!loading" class="button--large button button--primary-outline" @click="loadMore()"><?php i::_e('Carregar Mais') ?></button>
            </div>
        </div>
    </div>
</div>