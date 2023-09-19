<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

/**
 * @property int id
 * @property string name
 * @property string value
 */

class ConfigValues extends Model
{
    use HasFactory ,
        HasTranslations;

    protected $guarded = [];

    protected array $translatable = [  'value'];
    protected $appends = [ 'value_text'];



    public function getValueTextAttribute()
    {
        $locale = App::getLocale();
        return $this->getTranslation('value', $locale);
    }


}
