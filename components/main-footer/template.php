<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\Funarte\Theme $this
 */
use MapasCulturais\i;

$this->import('
    theme-logo
');
$config = $app->config['social-media'];
?>
<?php $this->applyTemplateHook("main-footer", "before")?>
<div v-if="globalState.visibleFooter" class="main-footer">
    <?php $this->applyTemplateHook("main-footer", "begin")?>
    <div class="main-footer__content">
        <?php $this->applyTemplateHook("main-footer-logo", "before")?>
        <div class="main-footer__support">
            <?php $this->part('footer-support-message') ?>
        </div>
        <div class="main-footer__content--logo">
            <div class="main-footer__content--logo-img">
                <theme-logo class="onlyImg" href="<?= $app->createUrl('site', 'index') ?>"></theme-logo>
            </div>

            <div class="main-footer__content--logo-share">
                <?php foreach ($config as $conf) : ?>
                    <a target="_blank" href="<?= $conf['link'] ?>">
                        <mc-icon name='<?= $conf['title'] ?>'></mc-icon>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php $this->applyTemplateHook("main-footer-logo", "after")?>

        <?php $this->applyTemplateHook("main-footer-links", "before")?>
        <div class="main-footer__content--links">
            <?php $this->applyTemplateHook("main-footer-links", "begin")?>

            <ul class="main-footer__content--links-group">
                <li>
                    <a><?php i::_e("Descubra"); ?></a>
                </li>
                <li v-if="global.enabledEntities.opportunities">
                    <a href="<?= $app->createUrl('search', 'opportunities') ?>">
                        <mc-icon name="opportunity"></mc-icon> <?php i::_e('Editais e oportunidades'); ?>
                    </a>
                </li>
                <li v-if="global.enabledEntities.events">
                    <a href="<?= $app->createUrl('search', 'events') ?>">
                        <mc-icon name="event"></mc-icon> <?php i::_e('Eventos'); ?>
                    </a>
                </li>
                <li v-if="global.enabledEntities.agents">
                    <a href="<?= $app->createUrl('search', 'agents') ?>">
                        <mc-icon name="agent"></mc-icon> <?php i::_e('Artistas'); ?>
                    </a>
                </li>
                <li v-if="global.enabledEntities.spaces">
                    <a href="<?= $app->createUrl('search', 'spaces') ?>">
                        <mc-icon name="space"></mc-icon> <?php i::_e('Espaços'); ?>
                    </a>
                </li>
                <li v-if="global.enabledEntities.projects">
                    <a href="<?= $app->createUrl('search', 'projects') ?>">
                        <mc-icon name="project"></mc-icon> <?php i::_e('Iniciativas'); ?>
                    </a>
                </li>
            </ul>

            <ul class="main-footer__content--links-group">
                <li>
                    <a href="<?= $app->createUrl('panel', 'index') ?>"><?php i::_e('Painel de controle'); ?></a>
                </li>
                <li v-if="global.enabledEntities.opportunities">
                    <a href="<?= $app->createUrl('panel', 'opportunities') ?>"><?php i::_e('Minhas oportunidades'); ?></a>
                </li>
                <li v-if="global.enabledEntities.events">
                    <a href="<?= $app->createUrl('panel', 'events') ?>"><?php i::_e('Meus eventos'); ?></a>
                </li>
                <li v-if="global.enabledEntities.agents">
                    <a href="<?= $app->createUrl('panel', 'agents') ?>"><?php i::_e('Meus artistas'); ?></a>
                </li>
                <li v-if="global.enabledEntities.spaces">
                    <a href="<?= $app->createUrl('panel', 'spaces') ?>"><?php i::_e('Meus espaços'); ?></a>
                </li>
                <li v-if="global.enabledEntities.projects">
                    <a href="<?= $app->createUrl('panel', 'projects') ?>"><?php i::_e('Minhas iniciativas'); ?></a>
                </li>
                <?php if (!($app->user->is('guest'))) : ?>
                    <li>
                        <a href="<?= $app->createUrl('auth', 'logout') ?>"><?php i::_e('Sair')?></a>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="main-footer__content--links-group">
                <li>
                    <a><?php i::_e('Ajuda e privacidade'); ?></a>
                </li>

                <li>
                    <a href="<?= $app->createUrl('faq') ?>"><?php i::_e('Ajuda e perguntas frequentes (FAQ)'); ?></a>
                </li>

                <li>
                    <a href="<?= $app->createUrl('lgpd', 'view', ['termsOfUsage']) ?>"><?php i::_e('Termos de uso e Política de privacidade'); ?></a>
                </li>

                <li>
                    <a href="<?= $app->createUrl('lgpd', 'view', ['termsUse']) ?>"><?php i::_e('Autorização de uso de imagem'); ?></a>
                </li>

            <?php /* if (count($app->config['module.LGPD']) > 0): ?>
                <?php foreach ($app->config['module.LGPD'] as $slug => $cfg) : ?>
                    <li>
                        <a href="<?= $app->createUrl('lgpd', 'view', [$slug]) ?>"><?= $cfg['title'] ?></a>
                    </li>
                <?php endforeach ?>
            <?php endif; */ ?>
            </ul>
            <?php $this->applyTemplateHook("main-footer-links", "end")?>
        </div>
        <?php $this->applyTemplateHook("main-footer-links", "after")?>
    </div>
    <?php $this->applyTemplateHook("main-footer-reg", "before")?>
    <div class="main-footer__reg">
        <?php $this->applyTemplateHook("main-footer-reg", "begin")?>
        <div class="main-footer__reg-content">

            <a class="link" href="https://github.com/redemapas/theme-Funarte">
                <?php i::_e("Conheça o repositório") ?>
                <mc-icon name="github"></mc-icon>
            </a>

            <a class="link" href="https://redemapas.github.io/manual/docs/agentes/">
                <?php i::_e("Acesse os manuais") ?>
                <mc-icon name="attachment"></mc-icon>
            </a>
        </div>
        <?php $this->applyTemplateHook("main-footer-reg", "end")?>
    </div>
    <?php $this->applyTemplateHook("main-footer-reg", "after")?>
    <?php $this->applyTemplateHook("main-footer", "end")?>
</div>
<?php $this->applyTemplateHook("main-footer", "after")?>
