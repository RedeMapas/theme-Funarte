<?php
/**
 * @var MapasCulturais\App $app
 * @var MapasCulturais\Themes\BaseV2\Theme $this
 */

use MapasCulturais\i;

$user = $app->user;

if (\Funarte\DashboardsAccess::userCanAccess($user)) {
    echo \Funarte\DashboardsAccess::userMenuLinkMarkup(i::__('Painéis de Dados'));
}
