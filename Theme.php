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

        /*
         * correção para filtragem por estado/município na visualização de mapa
         * substitui o método API_findByEvents para tratar corretamente os filtros En_Estado e En_Municipio
         */
        $app->hook('API(space.findByEvents)', function() use ($app) {
            $space_controller = $app->controller('space');
            $query_data = $space_controller->getData;

            $date_from  = key_exists('@from',   $query_data) ? $query_data['@from'] : date("Y-m-d");
            $date_to    = key_exists('@to',     $query_data) ? $query_data['@to']   : $date_from;

            unset(
                $query_data['@from'],
                $query_data['@to']
            );

            $event_data = ['@select' => 'id'] + $query_data;
            unset($event_data['location']);
            unset($event_data['_geoLocation']);
            unset($event_data['@count']);
            // remove En_Estado e En_Municipio do event_data pois devem ser aplicados aos espaços, não aos eventos
            unset($event_data['En_Estado']);
            unset($event_data['En_Municipio']);
            
            $events_repo = $app->repo('Event');

            $_event_ids = $events_repo->findByDateInterval($date_from, $date_to, null, null, true);
            if (count($_event_ids) > 0) {
                $event_data['id'] = 'IN(' . implode(',', $_event_ids) . ')';

                $events = $app->controller('event')->apiQuery($event_data);
                $event_ids = array_map(function ($e){ return $e['id']; }, $events);

                $spaces = $space_controller->repository->findByEventsAndDateInterval($event_ids, $date_from, $date_to);
                $space_ids = array_map(function($e){ return $e->id; }, $spaces);

                if($space_ids){
                    $space_data = ['id' => 'IN(' . implode(',', $space_ids) .')'];
                    foreach($query_data as $key => $val)
                        if($key[0] === '@' || $key == '_geoLocation' || $key == 'location' || $key == 'En_Estado' || $key == 'En_Municipio')
                            $space_data[$key] = $val;

                    unset($space_data['@keyword']);
                    $response = $space_controller->apiQuery($space_data);
                }else{
                    $response = key_exists('@count', $query_data) ? 0 : [];
                }
            } else {
                $response = key_exists('@count', $query_data) ? 0 : [];
            }

            $this->json($response);
            return false; 
        });
    }
}
