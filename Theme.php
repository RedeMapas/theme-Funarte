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

    function _init()
    {
        parent::_init();
        $app = App::i();

        $app->hook('template(<<*>>.head):end', function () {
            $this->part('google-analytics--script');
            $this->part('clarity--script');
        });
        $app->hook("ApiQuery(<<project|opportunity|event|space|agent|seal>>).params", function(&$api_params) use($app) {
            if($subsite = $app->subsite){
                $api_params['_subsiteId'] = API::EQ($subsite->id);
            }
        });

        $app->hook('template(<<*>>.<<*>>.body):after', function(){
            $this->part('glpi--script');
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
    }
}
