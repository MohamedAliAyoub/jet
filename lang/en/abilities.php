<?php

use App\Enums\Abilities;

return [
    Abilities::MODULE_ADMINS_CREATE->value => 'user create',
    Abilities::MODULE_ADMINS_INDEX->value => 'user index',
    Abilities::MODULE_ADMINS_INDEX_RELATIVES->value => 'user Relatives',


    Abilities::MODULE_ADMINS_UPDATE->value => 'user update',
    Abilities::MODULE_ADMINS_DELETE->value => 'user create',
    Abilities::MODULE_ADMINS_ACTIVE->value => 'user activate',
    Abilities::MODULE_ADMINS_VIEW_PROFILE->value => 'user view profile',

    Abilities::MODULE_ROLE_INDEX->value => 'role index',
    Abilities::MODULE_ROLE_CREATE->value => 'role create',
    Abilities::MODULE_ROLE_UPDATE->value => 'role update',
    Abilities::MODULE_ROLE_DELETE->value => 'role delete',

    Abilities::MODULE_TRIP_INDEX->value =>  'trip index',
    Abilities::MODULE_TRIP_CREATE->value => 'trip index',
    Abilities::MODULE_TRIP_UPDATE->value => 'trip update',
    Abilities::MODULE_TRIP_DELETE->value => 'trip delete',
    Abilities::MODULE_TRIP_ACTIVE->value => 'trip is active',

];
