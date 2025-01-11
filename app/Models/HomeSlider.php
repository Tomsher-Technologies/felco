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

class HomeSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'mobile_image',
        'link_type',
        'link_ref',
        'link_ref_id',
        'link',
        'sort_order',
        'status',
    ];

    public function mainImage()
    {
        return $this->hasOne(Upload::class, 'id', 'image');
    }
    public function mobileImage()
    {
        return $this->hasOne(Upload::class, 'id', 'mobile_image');
    }

    public function slider_translations()
    {
        return $this->hasMany(HomeSliderTranslation::class,'slider_id');
    }

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $slider_translations = $this->slider_translations->where('lang', $lang)->first();
        if ($slider_translations == null && $lang != 'en') {
            $slider_translations = $this->slider_translations->where('lang', 'en')->first();
        }
        return $slider_translations != null ? $slider_translations->$field : $this->$field;
    }

    public static function boot()
    {
        static::creating(function ($model) {
            Cache::forget('homeSlider');
        });

        static::updating(function ($model) {
            Cache::forget('homeSlider');
        });

        static::deleting(function ($model) {
            Cache::forget('homeSlider');
        });

        parent::boot();
    }
}
