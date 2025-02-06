<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    use HasFactory;

    protected $with = ['manual_translations'];

    protected $fillable = ['title', 'image', 'status', 'sort_order'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $manual_translation = $this->manual_translations->where('lang', $lang)->first();
        
        if ($manual_translation == null && $lang != 'en') {
            $manual_translation = $this->manual_translations->where('lang', 'en')->first();
        }

        return $manual_translation != null ? $manual_translation->$field : $this->$field;
    }

    public function manual_translations()
    {
        return $this->hasMany(ManualTranslation::class);
    }
    

    public function sections()
    {
        return $this->hasMany(ManualSection::class);
    }
    
    public function files()
    {
        return $this->hasMany(ManualFile::class);
    }
}

