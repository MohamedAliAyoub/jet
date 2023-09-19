<?php

namespace App\Models;

use App\Builders\RoleBuilder;
use App\Traits\TimeStampsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchTrait;
use Silber\Bouncer\Database\Ability;


/**
 * @property int id
 * @property string name
 * @property string title

 */
class Role extends \Silber\Bouncer\Database\Role
{
    use HasFactory ,
        TimeStampsTrait;

    public static function query(): RoleBuilder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): RoleBuilder
    {
        return new RoleBuilder($query);
    }

}
