<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateFileTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_file_id', 'title', 'content', 'lang'
    ];

    public function certificate_file()
    {
        return $this->belongsTo(CertificateFile::class);
    }
}
