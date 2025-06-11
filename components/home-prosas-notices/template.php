<?php

/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\Funarte\Theme $this
 */

use MapasCulturais\i;

$this->import('
    mc-tab
    mc-tabs
');

?>

<div class="home-prosas-notices">
    <div class="home-prosas-notices__header">
        <div class="home-prosas-notices__header title">
            <label><?= $this->text('title', i::__('Chamadas e Convocatórias Funarte')) ?></label>
        </div>
        <div class="home-prosas-notices__header description">
            <label><?= $this->text('description', i::__('Acesse as chamadas/convocatórias públicas com inscrições abertas e processos já finalizados.')) ?></label>
        </div>
    </div>
    <div class="home-prosas-notices__content">
        <mc-tabs>
            <mc-tab label="<?= $this->text('title', i::__('Inscrições abertas')) ?>" slug="openNotices">
                <prosas-listagem-editais per-page=5 not-show="pesquisa" :edital-ids="idList" :client-id="clientId"></prosas-listagem-editais>
            </mc-tab>
            <mc-tab label="<?= $this->text('title', i::__('Inscrições encerradas')) ?>" slug="closedNotices">
                <prosas-listagem-editais encerrados="required" per-page=5 not-show="pesquisa" :edital-ids="idList" :client-id="clientId"></prosas-listagem-editais>
            </mc-tab>
        </mc-tabs>
    </div>
</div>