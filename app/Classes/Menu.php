<?php

namespace App\Classes;

use App\Enums\Abilities;
use App\Enums\ModuleName;

class Menu
{
    /**
     * the abilities of authed user.
     *
     * @var array
     */
    protected static $abilities = [['items' => []]];

    /**
     * getMenu
     *
     * @return array
     */
    public static function getMenu(): array
    {
        (new self)->setLinks();

        return self::$abilities;
    }

    /**
     * set the links of side panel menu.
     *
     * @return void
     */
    public function setLinks(): void
    {
        $this->addNavItemUnguarded(
            ModuleName::HOME->value,
            'pi pi-fw pi-home',
            route('user.home'),
            'home'
        );
        $this->addNavItem(
            Abilities::MODULE_ADMINS_INDEX,
            ModuleName::ADMINS->value,
            'pi pi-fw pi-users',
            route('user.admins.index'),
            'admins'
        );

         $this->addNavItem(
             Abilities::MODULE_ROLE_INDEX,
             ModuleName::ROLES->value,
             'pi pi-cog',
             route('user.role.index'),
             'roles'
         );

        $this->addNavItem(
            Abilities::MODULE_TRIP_INDEX,
            ModuleName::TRIPS->value,
            'pi pi-twitter',
            route('user.trips.index'),
            'trips'
        );


    }

    /**
     * add ability to response.
     *
     * @param Abilities $ability
     * @param string $module_name
     * @param string $icon
     * @param string $route
     * @param string $index
     * @return void
     */
    protected function addNavItem(Abilities $ability, string $module_name, string $icon, string $route, string $index): void
    {
        if (Helpmate::checkAbilities($ability)) {

            $this->addNavItemUnguarded($module_name, $icon, $route, $index);

        }
    }

    protected function addNavItemUnguarded(string $module_name, string $icon, string $route, string $index): void
    {
        self::$abilities[0]['items'][] = [
            'selected'  => strpos(request()->route()->uri(), $index) > -1,
            'label'     => __("enums.ModuleName.{$module_name}"),
            'icon'      => $icon,
            'to'        => $route,
        ];
    }

    /**
     * add toggle nav item
     *
     * @param  string $label
     * @param  string $icon
     * @param  array  $sub_nav
     * @return void
     */
    protected function addToggleNavItem(string $label, string $icon, array $sub_nav): void
    {
        $items = [];

        foreach($sub_nav as $navItem) {
            if (Helpmate::checkAbilities($navItem['ability'])) {
                $items[] = [
                    'label' => __("enums.ModuleName.{$navItem['label']}"),
                    'icon'  => $navItem['icon'],
                    'to'    => $navItem['href']
                ];
            }
        }

        if($items) {
            self::$abilities[0]['items'][] = [
                'label' => $label,
                'icon'  => $icon,
                'to'    => $label,
                'items' => $items
            ];
        }
    }
}
