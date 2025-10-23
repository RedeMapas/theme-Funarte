<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-avatar
    mc-icon
    mc-title
    mc-loading
    entity-seals
    agenda-section
');
?>
<div class="entity-card" :class="classes">
    <div class="entity-card__header" :class="{'with-labels': useLabels, 'without-labels': !useLabels}">
        <div class="entity-card__header user-details">
            <slot name="avatar">
                <mc-avatar :entity="entity" size="small"></mc-avatar>
            </slot>
            <div class="user-info" :class="{'with-labels': useLabels, 'without-labels': !useLabels}">
                <a :href="entity.singleUrl">
                    <slot name="title">
                        <mc-title tag="h2" :shortLength="55" :longLength="71" class="bold">{{entity.name}}</mc-title>
                    </slot>
                </a>
            </div>
        </div>
    </div>
    <div class="entity-card__content">
        <slot name="labels">
            <div class="entity-card__fields entity-card__slot field-card field--inline" :class="{'no-id' : !global.showIds[entity.__objectType]}">
                    <div class="field__label">Id:</div>
                    <div class="field__content">{{entity.id}}</div>
            </div>
        </slot>
        <div v-if="entity.type" class="user-info__attr entity-card__slot field-card field--inline">
            <div class="field__label"><?php i::_e("Tipo:"); ?></div>
            <div class="field__content" :class="entity.__objectType+'__color'">{{entity.type?.name}}</div>
        </div>
        <div v-if="entity.startsOn || entity.endsOn" class="field-card field--period">
            <div class="field__label">
                <?= i::_e("Período") ?>: <mc-icon name="calendar"></mc-icon>
            </div>
            <div class="field__content">
                <span v-if="entity.startsOn && entity.endsOn">
                    {{entity.startsOn.day()}} de {{entity.startsOn.month()}} a {{entity.endsOn.day()}} de {{entity.endsOn.month()}} de {{entity.endsOn.year()}}
                </span>
                <span v-else-if="entity.startsOn">
                    A partir de {{entity.startsOn.day()}} de {{entity.startsOn.month()}} de {{entity.startsOn.year()}}
                </span>
                <span v-else-if="entity.endsOn">
                    Até {{entity.endsOn.day()}} de {{entity.endsOn.month()}} de {{entity.endsOn.year()}}
                </span>
            </div>
        </div>

        <div v-if="seals" class="field-card field--seals">
            <div class="field__label">
                <?php i::_e("Selos"); ?>:
            </div>
            <div class="field__content">
                <entity-seals :entity="entity" :showName=true title=""></entity-seals>
            </div>
        </div>

        <div v-if="entity.shortDescription" class="field-card entity-card__content-shortDescription">
            <span v-if="sliceDescription">{{slice(entity.shortDescription, 300)}}</span>
            <span v-if="!sliceDescription">{{showShortDescription}}</span>
        </div>

        <div class="entity-card__terms">
            <div v-if="tags" class="field-card field--tags">
                <div class="field__label">
                    <?php i::_e("Tags:"); ?> ({{entity.terms.tag.length}}):
                </div>
                <div class="field__content" :class="entity.__objectType+'__color'">{{tags}}</div>
            </div>
        </div>
    </div>

    <!-- Seção da Agenda -->
    <div class="entity-card__agenda" ref="agendaContainer">
        <agenda-section :entity="entity" :agenda-limit="agendaLimit" :agenda-per-event-limit="agendaPerEventLimit"></agenda-section>
    </div>
    <div class="entity-card__footer">
        <div class="entity-card__footer--info">

        </div>

        <div class="entity-card__footer--action">
            <a :href="entity.singleUrl" class="button button--primary button--large button--icon">
                <?php i::_e("Acessar"); ?>
                <mc-icon name="access"></mc-icon>
            </a>
        </div>
    </div>
</div>
