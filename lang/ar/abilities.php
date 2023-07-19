<?php
use App\Enums\Abilities;
return [
    Abilities::MODULE_ADMINS_CREATE->value => 'اضافة مشرف',
    Abilities::MODULE_ADMINS_INDEX->value => 'عرض المشرفين',
    Abilities::MODULE_ADMINS_UPDATE->value => 'تعديل مشرف',
    Abilities::MODULE_ADMINS_DELETE->value => 'حذف مشرف',
    Abilities::MODULE_ADMINS_ACTIVE->value => 'تفعيل المشرف',
    Abilities::MODULE_ADMINS_VIEW_PROFILE->value => 'عرض الصفحة الشخصية',

    Abilities::MODULE_ROLE_INDEX->value => 'عرض الادوار',
    Abilities::MODULE_ROLE_CREATE->value => 'اضافة دور',
    Abilities::MODULE_ROLE_UPDATE->value => 'تعديل دور',
    Abilities::MODULE_ROLE_DELETE->value => 'حذف الدور',

];
