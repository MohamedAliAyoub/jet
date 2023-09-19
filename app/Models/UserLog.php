<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string body
 * @property string user_id
 */
class UserLog extends Model
{
    use HasFactory;
    protected $guarded = [];
}



