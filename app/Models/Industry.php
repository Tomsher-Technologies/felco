<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Industry extends Model
{
    use HasFactory;

    protected $with = ['industry_translations'];

    protected $fillable = ['name', 'slug', 'image', 'content_image', 'selected_categories','is_active'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $industry_translation = $this->industry_translations->where('lang', $lang)->first();

        if ($industry_translation == null && $lang != 'en') {
            $industry_translation = $this->industry_translations->where('lang', 'en')->first();
        }

        return $industry_translation != null ? $industry_translation->$field : $this->$field;
    }

    public function industry_translations()
    {
        return $this->hasMany(IndustryTranslation::class);
    }
}
