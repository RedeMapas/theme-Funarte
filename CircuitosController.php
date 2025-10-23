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
        $values = explode(',', $app->config['funarte.circuito_seals']);

        // trim whitespace and convert to number if numeric
        $numbers = array_map(function($v) {
            $v = trim($v);
            // convert to integer or float if numeric
            return is_numeric($v) ? $v + 0 : $v;
        }, $values);

        // Filtrar projetos que possuem qualquer um destes selos (operador OR)
        $initial_pseudo_query = [
            '@seals' => $numbers,
        ];

        $app->applyHookBoundTo($this, 'search-projects-initial-pseudo-query', [&$initial_pseudo_query]);

        $this->render('index', ['initial_pseudo_query' => $initial_pseudo_query]);
    }
}
