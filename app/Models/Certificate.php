<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $with = ['certificate_translations'];

    protected $fillable = ['title', 'image', 'status', 'sort_order'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $certificate_translation = $this->certificate_translations->where('lang', $lang)->first();
        
        if ($certificate_translation == null && $lang != 'en') {
            $certificate_translation = $this->certificate_translations->where('lang', 'en')->first();
        }

        return $certificate_translation != null ? $certificate_translation->$field : $this->$field;
    }

    public function certificate_translations()
    {
        return $this->hasMany(CertificateTranslation::class);
    }
    

    public function sections()
    {
        return $this->hasMany(CertificateSection::class)->where('status',1)->orderBy('sort_order','ASC');
    }
    
    // public function files()
    // {
    //     return $this->hasMany(CertificateFile::class)->where('status',1)->orderBy('sort_order','ASC');
    // }
}

