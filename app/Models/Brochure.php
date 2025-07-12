<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    use HasFactory;

    protected $with = ['brochure_translations'];

    protected $fillable = ['title', 'image', 'status', 'sort_order'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $brochure_translation = $this->brochure_translations->where('lang', $lang)->first();
        
        if ($brochure_translation == null && $lang != 'en') {
            $brochure_translation = $this->brochure_translations->where('lang', 'en')->first();
        }

        return $brochure_translation != null ? $brochure_translation->$field : $this->$field;
    }

    public function brochure_translations()
    {
        return $this->hasMany(BrochureTranslation::class);
    }
    
    public function files()
    {
        return $this->hasMany(BrochureFile::class)->where('status',1)->orderBy('sort_order','ASC');
    }
}
