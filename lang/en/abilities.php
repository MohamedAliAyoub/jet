<?php

use App\Enums\Abilities;

return [
    Abilities::MODULE_ADMINS_CREATE->value => 'admin create',
    Abilities::MODULE_ADMINS_INDEX->value => 'admin index',
    Abilities::MODULE_ADMINS_UPDATE->value => 'admin update',
    Abilities::MODULE_ADMINS_DELETE->value => 'admin create',
    Abilities::MODULE_ADMINS_ACTIVE->value => 'admin activate',
    Abilities::MODULE_ADMINS_VIEW_PROFILE->value => 'admin view profile',

    Abilities::MODULE_ROLE_INDEX->value => 'role index',
    Abilities::MODULE_ROLE_CREATE->value => 'role create',
    Abilities::MODULE_ROLE_UPDATE->value => 'role update',
    Abilities::MODULE_ROLE_DELETE->value => 'role delete',

];
