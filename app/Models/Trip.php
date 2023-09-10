<?php

namespace App\Models;

use App\Builders\TripBuilder;
use App\Enums\TripStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Type\Integer;


/**
 * @property int id
 * @property string departure_country
 * @property string departure_city
 * @property bool departure_airport_name
 * @property Integer arrival_country
 * @property int arrival_city
 * @property string arrival_airport_name
 * @property string date
 * @property string take_off_time
 * @property bool landing_time
 * @property String flight_status
 * @property Integer hours
 * @property int is_active
 */
class Trip extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['flight_status_text'];
    protected $casts = [
        'date' => 'datetime',
        'take_off_time' => 'timestamp',
        'landing_time' => 'timestamp',
        'flight_status' => TripStatusEnum::class

    ];
    protected $dateFormat = 'Y-m-d';

    // Mutator method to set 'take_off_time' attribute
    public function setTakeOffTimeAttribute($value)
    {
        $this->attributes['take_off_time'] =Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    // Mutator method to set 'landing_time' attribute
    public function setLandingTimeAttribute($value)
    {
        // Parse the ISO 8601 datetime and format it as 'YYYY-MM-DD HH:MM:SS'
        $this->attributes['landing_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getDateAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getFlightStatusTextAttribute(): ?string
    {
        return TripStatusEnum::getTrans($this->flight_status);
    }


    public function getTakeOffTimeAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d H:i A') : null;
    }

    public function getLandingTimeAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format('Y-m-d H:i A') : null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function query(): TripBuilder
    {
        return parent::query();
    }

    public function newEloquentBuilder($query): TripBuilder
    {
        return new TripBuilder($query);
    }
}
