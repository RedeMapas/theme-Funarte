<?php
use MapasCulturais\i;

$this->import('
    create-project
    search
    search-filter-project
    search-list-circuitos
    search-map
    mc-tabs
    mc-tab
    project-table

');

// search-filter-event
// search-map-event
$this->breadcrumb = [
    ['label' => i::__('Inicio'), 'url' => $app->createUrl('site', 'index')],
    ['label' => i::__('Circuitos'), 'url' => $app->createUrl('circuitos')],
];
?>

<search entity-type="project" page-title="<?= htmlspecialchars($this->text('title', i::__('Circuitos'))) ?>" :initial-pseudo-query='<?= json_encode(($initial_pseudo_query ?? []) + ["type" => []]) ?>'>
    <template #default="{pseudoQuery, changeTab}">
        <mc-tabs @changed="changeTab($event)" class="search__tabs" sync-hash>
            <template #before-tablist>
                <label class="search__tabs--before">
                    <?= i::_e('Visualizar como:') ?>
                </label>
            </template>
            <mc-tab icon="list" label="<?php i::esc_attr_e('Lista') ?>" slug="list">
                <div class="tabs-component__panels">
                    <div class="search__tabs--list">
                        <search-list-circuitos :pseudo-query="pseudoQuery" type="project" select="id,name,type,shortDescription,files.avatar,seals,terms,startsOn,endsOn" >
                            <template #filter>
                                <search-filter-project :pseudo-query="pseudoQuery"></search-filter-project>
                            </template>
                        </search-list-circuitos>
                    </div>
                </div>
            </mc-tab>

    </template>
</search>
