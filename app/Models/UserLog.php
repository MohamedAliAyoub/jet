<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

/**
 * @property int id
 * @property string title
 * @property string body
 * @property string user_id
 */
class UserLog extends Model
{
    use HasFactory,
        HasTranslations;
    protected $guarded = [];

    protected array $translatable = [ 'title' , 'body'];
    protected $appends = [ 'title_text' , 'body_text'];



    public function getTitleTextAttribute()
    {
        $locale = App::getLocale();
        return $this->getTranslation('title', $locale);
    }

    public function getBodyTextAttribute()
    {
        $locale = App::getLocale();
        return $this->getTranslation('body', $locale);
    }
}



