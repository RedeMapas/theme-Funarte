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
    
    public function register()
    {
        parent::register();
        $app = \MapasCulturais\App::i();
        $app->registerController('funarte_search', 'Funarte\SearchController');
    }

    function __construct($config = [])
    {
        $app = App::i();
        $app->config['Metabase']['enabled'] = env('METABASE_FUNARTE_ENABLED', true);

        parent::__construct($config);
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
    }
}
