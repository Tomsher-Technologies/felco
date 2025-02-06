<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_id', 'title', 'lang'
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class,'certificate_id');
    }
}
