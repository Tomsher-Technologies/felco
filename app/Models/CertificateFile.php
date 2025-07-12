<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_section_id', 'title', 'file', 'status', 'sort_order'
    ];

    public function certificate_section()
    {
        return $this->belongsTo(CertificateSection::class);
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
        return $this->hasMany(CertificateFileTranslation::class);
    }
}
