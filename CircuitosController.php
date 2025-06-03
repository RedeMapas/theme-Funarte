<?php

namespace Funarte;

use MapasCulturais\App;
use MapasCulturais\i;

class CircuitosController extends \MapasCulturais\Controller
{
    /**
     * Custom route handler for the Funarte theme
     */
    public function ALL_index()
    {
        $app = App::i();
        $initial_pseudo_query = [
            '@from' => date('Y-m-d', strtotime('2025-01-01')),
            '@to' => date('Y-m-d', strtotime($app->config['search.events.to']))
        ];
        $this->render('index', ['initial_pseudo_query' => $initial_pseudo_query]);
    }
}