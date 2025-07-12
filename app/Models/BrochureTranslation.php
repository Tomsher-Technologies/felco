<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrochureTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'brochure_id', 'title', 'lang'
    ];

    public function brochure()
    {
        return $this->belongsTo(Brochure::class,'brochure_id');
    }
}
