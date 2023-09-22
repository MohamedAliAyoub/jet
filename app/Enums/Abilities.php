<?php

namespace App\Enums;

use App\Enums\ModuleName;

enum Abilities: string
{


    // module admin abilities
    case MODULE_ADMINS_INDEX = 'module admins index';
    case MODULE_ADMINS_INDEX_RELATIVES = 'module admins index Relatives';
    case MODULE_ADMINS_CREATE = 'module admins create';
    case MODULE_ADMINS_UPDATE = 'module admins update';
    case MODULE_ADMINS_DELETE = 'module admins delete';
    case MODULE_ADMINS_ACTIVE = 'module admins Active';
    case MODULE_ADMINS_VIEW_PROFILE = 'module admins view profile';

    case MODULE_ROLE_INDEX = 'module roles index';
    case MODULE_ROLE_CREATE = 'module roles create';
    case MODULE_ROLE_UPDATE = 'module roles update';
    case MODULE_ROLE_DELETE = 'module roles delete';

    case MODULE_TRIP_INDEX = 'module trip index';
    case MODULE_NEXT_TRIP_INDEX = 'module next trip index';
    case MODULE_TRIP_CREATE = 'module trip create';
    case MODULE_TRIP_UPDATE = 'module trip update';
    case MODULE_TRIP_DELETE = 'module trip delete';
    case MODULE_TRIP_ACTIVE = 'module trip Active';





    public const PERMISSIONS = [
        // module admins  abilities
        ['key' => self::MODULE_ADMINS_INDEX, 'module' => ModuleName::ADMINS],
        ['key' => self::MODULE_ADMINS_INDEX_RELATIVES, 'module' => ModuleName::ADMINS],
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

        // module Trips  abilities
        ['key' => self::MODULE_TRIP_INDEX, 'module' => ModuleName::TRIPS],
        ['key' => self::MODULE_NEXT_TRIP_INDEX, 'module' => ModuleName::TRIPS],
        ['key' => self::MODULE_TRIP_CREATE, 'module' => ModuleName::TRIPS],
        ['key' => self::MODULE_TRIP_UPDATE, 'module' => ModuleName::TRIPS],
        ['key' => self::MODULE_TRIP_DELETE, 'module' => ModuleName::TRIPS],
        ['key' => self::MODULE_TRIP_ACTIVE, 'module' => ModuleName::TRIPS],








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
