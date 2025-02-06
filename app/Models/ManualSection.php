<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'manual_id', 'title','status', 'sort_order'
    ];

    public function manual()
    {
        return $this->belongsTo(Manual::class);
    }

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $section_translation = $this->section_translations->where('lang', $lang)->first();
        
        if ($section_translation == null && $lang != 'en') {
            $section_translation = $this->section_translations->where('lang', 'en')->first();
        }

        return $section_translation != null ? $section_translation->$field : $this->$field;
    }

    public function section_translations()
    {
        return $this->hasMany(ManualSectionTranslation::class);
    }
}
