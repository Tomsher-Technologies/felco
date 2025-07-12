<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'manual_id', 'title', 'lang'
    ];

    public function manual()
    {
        return $this->belongsTo(Manual::class,'manual_id');
    }
}
