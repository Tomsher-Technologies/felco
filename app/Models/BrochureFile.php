<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrochureFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'brochure_id', 'title', 'file', 'sort_order', 'status'
    ];

    public function brochure()
    {
        return $this->belongsTo(Brochure::class);
    }

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $file_translation = $this->file_translations->where('lang', $lang)->first();
        
        if ($file_translation == null && $lang != 'en') {
            $file_translation = $this->file_translations->where('lang', 'en')->first();
        }

        return $file_translation != null ? $file_translation->$field : $this->$field;
    }

    public function file_translations()
    {
        return $this->hasMany(BrochureFileTranslation::class);
    }
}
