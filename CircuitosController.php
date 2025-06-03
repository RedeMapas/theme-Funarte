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
        $this->render('index');
    }
}