<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'heading', 'file', 'lang'
    ];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->where('lang', $lang)->first();
        if ($product_translations == null && $lang != 'en') {
            $product_translations = $this->where('lang', 'en')->first();
        }
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
