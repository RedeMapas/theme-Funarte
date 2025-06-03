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
        $app->registerController('circuitos', 'Funarte\CircuitosController');
    }

    function _init()
    {
        parent::_init();
        $app = App::i();

        $app->hook('template(<<*>>.head):end', function () {
            $this->part('google-analytics--script');
        });
        $app->hook("ApiQuery(<<project|opportunity|event|space>>).params", function(&$api_params) use($app) {
            if($subsite = $app->subsite){
                $api_params['_subsiteId'] = API::EQ($subsite->id);
            }
        });

        $app->hook('template(<<*>>.<<*>>.body):after', function(){
            $this->part('glpi--script');
        });

        $app->hook('template(<<*>>.<<*>>.mc-header-menu-events):after', function() {
            $this->part('mc-header-menu-circuitos');
        });

        $app->hook("component(mc-icon).iconset", function(&$icon){
            $icon['circuitos'] = "ph:pinwheel-fill";
        });

    }
}
