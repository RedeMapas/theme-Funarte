<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-breadcrumb
    mc-tab
    mc-tabs
    search
    search-list-event
');
// search-filter-event
// search-map-event
$this->breadcrumb = [
    ['label' => i::__('Inicio'), 'url' => $app->createUrl('site', 'index')],
    ['label' => i::__('Circuitos'), 'url' => $app->createUrl('circuitos')],
];
?>

<search page-title="<?= htmlspecialchars($this->text('title', i::__('Circuitos'))) ?>" entity-type="event" :initial-pseudo-query="[]">
    <template #default="{pseudoQuery, changeTab}">
        <mc-tabs  @changed="changeTab($event)" class="search__tabs" sync-hash>
            <template #before-tablist>
                <label class="search__tabs--before">
                    <?= i::_e('Visualizar como:') ?>
                </label>
            </template>
            <mc-tab icon="list" label="<?php i::esc_attr_e('Lista') ?>" slug="list">
                <div class="search__tabs--list">
                    <search-list-event :pseudo-query="pseudoQuery"></search-list-event>
                </div>
            </mc-tab>
        </mc-tabs>
    </template>
</search>