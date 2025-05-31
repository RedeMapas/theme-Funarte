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
            <label><?= $this->text('title', i::__('Oportunidades Culturais')) ?></label>
        </div>
        <div class="home-prosas-notices__header description">
            <label><?= $this->text('description', i::__('Acompanhe as oportunidades artísticas disponíveis no momento. Aqui você encontra editais com inscrições abertas para projetos, ações artísticas e iniciativas de internacionalização.')) ?></label>
        </div>
    </div>
    <div class="home-prosas-notices__content">
        <mc-tabs>
            <mc-tab label="<?= $this->text('title', i::__('Editais com inscrições abertas')) ?>" slug="openNotices">
                <prosas-listagem-editais per-page=5 :edital-ids="idList" :client-id="clientId"></prosas-listagem-editais>
            </mc-tab>
            <mc-tab label="<?= $this->text('title', i::__('Editais com inscrições encerradas')) ?>" slug="closedNotices">
                <prosas-listagem-editais encerrados="required" per-page=5 :edital-ids="idList" :client-id="clientId"></prosas-listagem-editais>
            </mc-tab>
        </mc-tabs>
    </div>
</div>