<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageTranslations;
use App\Models\PageSeos;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\HomeSlider;
use App\Models\Occasion;
use App\Models\Partners;
use App\Models\BusinessSetting;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttributes;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\WebHomeProductsCollection;
use Storage;
use Validator;
use Mail;
use DB;
use Hash;
use Cache;
use Carbon\Carbon;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $price = $request->price;
        $min_price = $max_price = 0;
        if($price != null){
            preg_match_all('/\d+/', $price, $matches);
            if(isset($matches[0][0])){
                $min_price = $matches[0][0];
            }
            if(isset($matches[0][1])){
                $max_price = $matches[0][1];
            }
           
        }
       
        $lang = getActiveLanguage();
        $limit = $request->has('limit') ? $request->limit : 10;
        $offset = $request->has('offset') ? $request->offset : 0;
        $category = $request->has('category') ? $request->category  : false;
        $brand = $request->has('brand') ? $request->brand  : false;
        $occasion = $request->has('occasion') ? $request->occasion  : false;
        $sort_by = $request->has('sort_by') ? $request->sort_by : null;

        $product_query  = Product::wherePublished(1);
        $categoryData = null;
        if ($category) {
            $categoryData = Category::whereHas('category_translations', function ($query) use ($category) {
                                        $query->where('slug', $category);
                                    })->where('is_active',1)->first();

            $childIds = [];
            $category_ids = Category::whereHas('category_translations', function ($query) use ($category) {
                                        $query->where('slug', $category);
                                    })->where('is_active',1)->pluck('id')->toArray();

            $childIds[] = $category_ids;
            if(!empty($category_ids)){
                foreach($category_ids as $cId){
                    $childIds[] = getChildCategoryIds($cId);
                }
            }

            if(!empty($childIds)){
                $childIds = array_merge(...$childIds);
                $childIds = array_unique($childIds);
            }
            // print_r($childIds);
            // die;
            $product_query->whereIn('category_id', $childIds);
          
        }
        
        if ($brand) {
            $brand_ids = Brand::whereHas('brand_translations', function ($query) use ($brand) {
                                    $query->whereIn('slug', $brand);
                                })->where('is_active', 1)->pluck('id')->toArray();

            $product_query->whereIn('brand_id', $brand_ids);
        }

        if ($occasion) {
            $occasion_ids = Occasion::whereHas('occasion_translations', function ($query) use ($occasion) {
                                    $query->whereIn('slug', $occasion);
                                })->where('is_active', 1)->pluck('id')->toArray();

            $product_query->whereIn('occasion_id', $occasion_ids);
        }

        if ($sort_by) {
            switch ($sort_by) {
                case 'latest':
                    $product_query->latest();
                    break;
                case 'oldest':
                    $product_query->oldest();
                    break;
                case 'name_asc':
                    $product_query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $product_query->orderBy('name', 'desc');
                    break;
                case 'price_high':
                    $product_query->select('*', DB::raw("(SELECT MAX(price) from product_stocks WHERE product_id = products.id) as sort_price"));
                    $product_query->orderBy('sort_price', 'desc');
                    break;
                case 'price_low':
                    $product_query->select('*', DB::raw("(SELECT MIN(price) from product_stocks WHERE product_id = products.id) as sort_price"));
                    $product_query->orderBy('sort_price', 'asc');
                    break;
                default:
                    # code...
                    break;
            }
        }

        if ($request->search) {
            $sort_search = $request->search;
            $products = $product_query->where(function ($query) use($sort_search) {
                $query->orWhereHas('stocks', function ($q) use ($sort_search) {
                    $q->where('sku', 'like', '%' . $sort_search . '%');
                })->orWhereHas('product_translations', function ($q) use ($sort_search) {
                    $q->where('tags', 'like', '%' . $sort_search . '%')->orWhere('name', 'like', '%' . $sort_search . '%');
                });

            });
            // SearchUtility::store($sort_search, $request);
        }

        if($max_price != 0 && $min_price != 0){
            $product_query->whereHas('stocks', function ($query) use ($min_price, $max_price) {
                $query->whereBetween('price', [$min_price, $max_price]);
            });
        }

        if($request->has('offers')){
            $today = Carbon::now()->timestamp;
            $product_query->where('discount_start_date', '<=', $today) // Offer starts on or before today
            ->where('discount_end_date', '>=', $today);
        }
        $products = $product_query->paginate(20)->appends($request->query());


        $categories = Cache::rememberForever('categories', function () {
            $details = Category::where('parent_id',0)->where('is_active', 1)->orderBy('name','asc')->get();
            return $details;
        });

        $brands = Cache::rememberForever('brands', function () {
            $details = Brand::where('is_active', 1)->orderBy('name','asc')->get();
            return $details;
        });

        $occasions = Cache::rememberForever('occasions', function () {
            $details = Occasion::where('is_active', 1)->orderBy('name','asc')->get();
            return $details;
        });

        return view('frontend.products',compact('limit','products','offset','min_price','max_price','category','brand','occasion','sort_by','lang','categories','brands','occasions','categoryData','price'));
    }

    public function productDetails(Request $request){
        $slug = $request->has('slug') ? $request->slug :  ''; 
        $lang = getActiveLanguage();

        $product  = [];
        if($slug !=  ''){
            $product = Product::with(['files' => function ($query) use ($lang) {
                                    $query->where('lang', $lang);
                                }, 'seo'])
                                ->where('published',1)
                                ->where('products.slug', $slug)
                                ->first();
        } 
        // echo '<pre>';
        // print_r($response);
        // die;

        return view('frontend.product_details', compact('lang','product'));
    }


    public function relatedProducts($limit, $offset, $product_slug, $category_slug){
       
        // $product_query = ProductStock::leftJoin('products','products.id','=','product_stocks.product_id')
        //                             ->where('products.published',1)
        //                             ->where('product_stocks.status',1)
        //                             ->select('product_stocks.*','products.id');

        $product_query = Product::leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
                                    ->where('products.published', 1)
                                    ->where('product_stocks.status', 1)
                                    ->select('products.*') // Ensure only product fields are selected
                                    ->groupBy('products.id'); // Prevent duplication

        if ($category_slug) {
            $category_ids = Category::whereHas('category_translations', function ($query) use ($category_slug) {
                                    $query->where('slug', $category_slug);
                                })->pluck('id')->toArray();;
            
            $childIds[] = $category_ids;
            if(!empty($category_ids)){
                foreach($category_ids as $cId){
                    $childIds[] = getChildCategoryIds($cId);
                }
            }

            if(!empty($childIds)){
                $childIds = array_merge(...$childIds);
                $childIds = array_unique($childIds);
            }

            $product_query->whereIn('products.category_id', $category_ids);
        }
        $product_query->where('products.slug','!=', $product_slug)->groupBy('products.id')->latest();

        $products = $product_query->skip($offset)->take($limit)->get();

        return $products;
    }

}
