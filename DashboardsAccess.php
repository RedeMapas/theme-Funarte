<?php

namespace Funarte;

class DashboardsAccess
{
    public static function userCanAccess(?object $user): bool
    {
        if (!$user || $user->is('guest')) {
            return false;
        }

        return $user->is('admin') || $user->hasRole('dados');
    }

    public static function userMenuLinkMarkup(string $label = 'Painéis de Dados'): string
    {
        return sprintf(
            '<li><mc-link route="dashboards/index" icon="dashboard">%s</mc-link></li>',
            $label
        );
    }

    public static function appendPanelNavItem(array &$navItems, ?object $user, string $label = 'Painéis de Dados'): void
    {
        if (!self::userCanAccess($user)) {
            return;
        }

        if (!isset($navItems['admin']['items']) || !is_array($navItems['admin']['items'])) {
            $navItems['admin']['items'] = [];
        }

        foreach ($navItems['admin']['items'] as $item) {
            if (($item['route'] ?? null) === 'dashboards') {
                return;
            }
        }

        array_unshift($navItems['admin']['items'], [
            'route' => 'dashboards/index',
            'icon' => 'dashboard',
            'label' => $label,
        ]);
    }
}
