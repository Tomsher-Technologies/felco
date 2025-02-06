<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualSectionTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'manual_section_id', 'title', 'content', 'lang','button_text'
    ];

    public function manual_section()
    {
        return $this->belongsTo(ManualSection::class);
    }
}
