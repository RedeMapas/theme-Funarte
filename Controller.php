<?php

namespace Funarte;

use MapasCulturais\App;
use MapasCulturais\i;

class Controller extends \MapasCulturais\Controller
{
    /**
     * Custom route handler for the Funarte theme
     */
    public function ALL_customRoute()
    {
        $this->render('custom-route');
    }

    /**
     * Custom 404 handler to prevent memory exhaustion
     */
    public function ALL_notFound()
    {
        $app = App::i();
        $app->response = $app->response->withStatus(404);
        $this->render('not-found');
    }
}
