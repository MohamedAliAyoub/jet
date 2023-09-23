<?php
use App\Enums\Abilities;
return [
    Abilities::MODULE_ADMINS_CREATE->value => 'اضافة قريب',
    Abilities::MODULE_ADMINS_INDEX->value => 'عرض الاقارب',
    Abilities::MODULE_ADMINS_INDEX_RELATIVES->value => 'عرض الاقارب',
    Abilities::MODULE_ADMINS_UPDATE->value => 'تعديل الاقارب',
    Abilities::MODULE_ADMINS_DELETE->value => 'حذف الاقارب',
    Abilities::MODULE_ADMINS_ACTIVE->value => 'تفعيل الاقارب',
    Abilities::MODULE_ADMINS_VIEW_PROFILE->value => 'عرض الصفحة الشخصية',

    Abilities::MODULE_ROLE_INDEX->value => 'عرض الادوار',
    Abilities::MODULE_ROLE_CREATE->value => 'اضافة دور',
    Abilities::MODULE_ROLE_UPDATE->value => 'تعديل دور',
    Abilities::MODULE_ROLE_DELETE->value => 'حذف الدور',

    Abilities::MODULE_TRIP_INDEX->value => 'عرض الرحلات',
    Abilities::MODULE_NEXT_TRIP_INDEX->value =>  'عرض الرحلات القادمة',
    Abilities::MODULE_TRIP_CREATE->value => 'اضافة الرحلة',
    Abilities::MODULE_TRIP_UPDATE->value => 'تعديل الرحلة',
    Abilities::MODULE_TRIP_DELETE->value => 'حذف الرحلة',
    Abilities::MODULE_TRIP_ACTIVE->value => 'تفعيل الرحلة',
    Abilities::MODULE_TRIP_EXPORT->value =>  'تصدير بيانات الرحلات',

];
