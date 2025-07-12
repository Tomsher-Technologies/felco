<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrochureFileTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'brochure_file_id', 'title', 'content', 'button_text', 'lang'
    ];

    public function brochure_file()
    {
        return $this->belongsTo(BrochureFile::class);
    }
}
