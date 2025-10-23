<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    entity-card-circuitos
    mc-avatar
    mc-entities
');
?>
<div class="grid-12 search-list">
    <mc-entities :type="type" :select="select" :query="query" :order="order" :limit="limit" watch-query>
        <template #load-more="{entities, loadMore}">
            <div class="col-8 load-more">
                <mc-loading :condition="entities.loadingMore"></mc-loading>
                <button class="button--large button button--primary-outline" v-if="!entities.loadingMore" @click="loadMore()"><?php i::_e('Carregar Mais') ?></button>
            </div>
        </template>

        <template #header="{entities}">
            <div class="col-4 search-list__filter">
                <div class="search-list__filter--filter">
                    <slot name="filter" :count="entities.metadata?.count"></slot>
                </div>
            </div>
            <div v-if="entities.loading" class="col-8">
                <div class="grid-12"></div>
            </div>
        </template>

        <template #default="{entities}">
            <div class="col-9">
                <div class="grid-12">
                    <div class="col-12" v-for="entity in entities" :key="entity.__objectId">
                        <entity-card-circuitos :entity="entity">
                            <template #avatar>
                                <mc-avatar :entity="entity" size="medium"></mc-avatar>
                            </template>
                            <template #type>
                                <span>{{typeText}} 
                                    <span :class="['upper', entity.__objectType+'__color']">{{entity.type?.name}}</span>
                                </span>
                            </template>
                        </entity-card-circuitos>
                        <slot name="item-append" :entity="entity"></slot>
                    </div>
                </div>
            </div>
        </template>
    </mc-entities>
</div>
