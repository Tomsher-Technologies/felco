<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateSectionTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_section_id', 'title', 'content', 'lang','button_text'
    ];

    public function certificate_section()
    {
        return $this->belongsTo(CertificateSection::class);
    }
}
