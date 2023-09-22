<?php

namespace App\Models;

use App\Builders\UserBuilder;
use App\Services\StorageService;
use App\Traits\SearchTrait;
use App\Traits\TimeStampsTrait;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Type\Integer;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string avatar
 * @property bool is_active
 * @property integer hours
 * @property integer hours_balance
 * @property Integer parent_id
 */
class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRolesAndAbilities,
        CanResetPasswordTrait,
        TimeStampsTrait;

    const SUPERADMIN_EMAIL = 'info@privatejet.com';
    protected $appends = ['avatar_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'is_active',
        'mobile',
        'parent_id',
        'hours',
        'hours_balance',

    ];
    protected array $searchColumns = ['name', 'email'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean'
    ];


    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::Class, 'parent_id');
    }

    public function trips(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Trip::class);
    }


    public function setPasswordAttribute($new_password)
    {
        $this->attributes['password'] = Hash::make($new_password);
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar ? url('storage/' . $this->avatar) : url('/image/user-avatar.png');
    }

    public static function query(): UserBuilder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }


}
