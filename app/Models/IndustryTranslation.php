<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'industry_id',
        'lang',
        'name',
        'description',
        'title1',
        'content1',
        'title2',
        'content2',
        'applications',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'twitter_title',
        'twitter_description',
        'meta_keyword'
    ];

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
