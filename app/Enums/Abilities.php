<?php

namespace App\Enums;

use App\Enums\ModuleName;


enum Abilities: string
{
    /*
     * $user = User::find(1);
     * $isAdmin = true ? Bouncer::allow($user)->to(ADMIN_DEPARTMENT, $department);
     * $user->can(ADMIN_DEPARTMENT, $department)
     */

    // module admin abilities
    case MODULE_ADMINS_INDEX = 'module admins index';
    case MODULE_ADMINS_CREATE = 'module admins create';
    case MODULE_ADMINS_UPDATE = 'module admins update';
    case MODULE_ADMINS_DELETE = 'module admins delete';
    case MODULE_ADMINS_ACTIVE = 'module admins Active';
    case MODULE_ADMINS_VIEW_PROFILE = 'module admins view profile';

    case MODULE_ROLE_INDEX = 'module roles index';
    case MODULE_ROLE_CREATE = 'module roles create';
    case MODULE_ROLE_UPDATE = 'module roles update';
    case MODULE_ROLE_DELETE = 'module roles delete';




    public const PERMISSIONS = [
        // module admins  abilities
        ['key' => self::MODULE_ADMINS_INDEX, 'module' => ModuleName::ADMINS],
        ['key' => self::MODULE_ADMINS_CREATE, 'module' => ModuleName::ADMINS],
        ['key' => self::MODULE_ADMINS_UPDATE, 'module' => ModuleName::ADMINS],
        ['key' => self::MODULE_ADMINS_DELETE, 'module' => ModuleName::ADMINS],
        ['key' => self::MODULE_ADMINS_ACTIVE, 'module' => ModuleName::ADMINS],
        ['key' => self::MODULE_ADMINS_VIEW_PROFILE, 'module' => ModuleName::ADMINS],

        // module Roles  abilities
        ['key' => self::MODULE_ROLE_INDEX, 'module' => ModuleName::ROLES],
        ['key' => self::MODULE_ROLE_CREATE, 'module' => ModuleName::ROLES],
        ['key' => self::MODULE_ROLE_UPDATE, 'module' => ModuleName::ROLES],
        ['key' => self::MODULE_ROLE_DELETE, 'module' => ModuleName::ROLES],

    ];

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getAllAbilitiesGroupByModule(): \Illuminate\Support\Collection
    {
        return collect(self::PERMISSIONS)->map(
            fn($item) => [
                'module' => $item['module'] = $item['alias'] ?? $item['module']->value,
                'key' => $item['key']->value
            ]
        )->groupBy('module');
    }
}
