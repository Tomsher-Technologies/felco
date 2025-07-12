<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'question', 'answer', 'lang', 'sort_order', 'status'
    ];

}



