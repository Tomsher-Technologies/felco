<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Product;
use App\Models\Offers;
use App\Models\Brand;
use App\Models\Upload;
use Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSliderTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'btn_text',
        'slider_id'
    ];

    public function slider()
    {
        return $this->belongsTo(HomeSlider::class);
    }
    
}
