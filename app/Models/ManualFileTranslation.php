<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualFileTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'manual_file_id', 'title', 'content', 'lang'
    ];

    public function manual_file()
    {
        return $this->belongsTo(ManualFile::class);
    }
}
