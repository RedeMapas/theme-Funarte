<?php

namespace Funarte;

use MapasCulturais\App;
use MapasCulturais\API;

// class Theme extends \Subsite\Theme {
class Theme extends \MapasCulturais\Themes\BaseV2\Theme
{
    static function getThemeFolder()
    {
        return __DIR__;
    }

    function __construct($config = [])
    {
        $app = App::i();
        $app->config['Metabase']['enabled'] = env('METABASE_FUNARTE_ENABLED', true);

        parent::__construct($config);
        $app->registerController('funarte_search', 'Funarte\SearchController');
        $app->registerController('circuitos', 'Funarte\CircuitosController');
    }

    function _init()
    {
        parent::_init();
        $app = App::i();

        $app->hook('template(<<*>>.head):end', function () {
            $this->part('google-analytics--script');
            $this->part('clarity--script');
        });

        $app->hook('template(<<*>>.<<*>>.body):begin', function(){
            /** @var \MapasCulturais\Theme $this */
            $this->part('glpi-form');
        });

        $app->hook('POST(auth.login)', function () use ($app) {
            if ($app->user && $app->user->isAuthenticated()) {
                $agent = $app->user->getAgent();
                if ($agent && $agent->getMetadata('isFunarte') !== true) {
                    $agent->setMetadata('isFunarte', true);
                    $agent->save();
                }
            }
        });

        /**
         * Validação do Captcha
         */
        $app->hook('POST(site.valida-captcha)', function() use($app) {
            $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

            if (empty($recaptcha_response)) {
                $this->json(['success' => false, 'error' => 'Captcha não fornecido. Tente novamente.']);
                return;
            }

            // Usar a verificação nativa do App.php
            if (!$app->verifyCaptcha($recaptcha_response)) {
                $this->json(['success' => false, 'error' => 'Captcha inválido. Tente novamente.']);
                return;
            }

            $this->json(['success' => true, 'message' => 'Captcha válido']);
        });

        /*
         * Add custom navigation items to panel
         */
        $app->hook("panel.nav", function (&$nav_items) use ($app) {
            if (isset($nav_items["more"])) {
                $i = $nav_items["more"]["items"];
                // Use PHP array spread operator to prepend new item, then all previous items
                $nav_items["more"]["items"] = [
                    [
                        "route" => "search/projects",
                        "icon" => "project",
                        "label" => "Listar Iniciativas",
                    ],
                    ...$i
                ];
            }
        });

        $app->hook('template(<<*>>.<<*>>.mc-header-menu-events):after', function() {
            $this->part('mc-header-menu-circuitos');
        });

        $app->hook("component(mc-icon).iconset", function(&$icon){
            $icon['circuitos'] = "ph:pinwheel-fill";
        });

    }
}
