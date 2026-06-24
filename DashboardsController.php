<?php

namespace Funarte;

use MapasCulturais\App;

class DashboardsController extends \MapasCulturais\Controller
{
    /**
     * Página principal de Painéis de Dados
     * Acesso restrito a usuários com role 'dados' ou 'admin'
     */
    public function ALL_index()
    {
        $app = App::i();

        if ($app->user->is('guest')) {
            $this->redirect($app->createUrl('auth'));
            return;
        }

        if (!DashboardsAccess::userCanAccess($app->user)) {
            $this->redirect($app->createUrl('site', 'index'));
            return;
        }

        $this->render('index');
    }
}
