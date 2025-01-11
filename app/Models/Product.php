<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use URL;

class Product extends Model
{

    protected $fillable = [
        'name', 'slug', 'unique_id', 'frame_size', 'poles', 'power', 'mounting', 'voltage', 'speed', 'efficiency', 'hz', 'added_by', 'user_id', 'category_id', 'image', 'published'
    ];

    protected $with = ['product_translations','seo'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->product_translations->where('lang', $lang)->first();
        if ($product_translations == null && $lang != 'en') {
            $product_translations = $this->product_translations->where('lang', 'en')->first();
        }
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

    public function getSeoTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $seo_translations = $this->seo->where('lang', $lang)->first();
        return $seo_translations != null ? $seo_translations->$field : $this->$field;
    }

    public function product_translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function seo()
    {
        return $this->hasMany(ProductSeo::class);
    }

    public function imageLink($path)
    {
        return URL::to($path);
    }

    public function files()
    {
        return $this->hasMany(ProductFile::class);
    }

    public function filesLang($lang= null)
    {
        // Use the default app locale if no language is provided
        $lang = $lang ?? app()->getLocale();

        return $this->hasMany(ProductFiles::class)->where('lang', $lang);
    }

   
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
