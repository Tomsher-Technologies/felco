<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Category;
use App\Models\ProductFile;
use App\Models\ProductSeo;
use App\Models\User;
use Image;
use Auth;
use Carbon\Carbon;
use Combinations;
use Artisan;
use Cache;
use Exception;
use Storage;
use Str;
use File;
use Hash;
use DB;

class ProductController extends Controller
{


    public function all_products(Request $request)
    {
        $col_name = null;
        $query = null;
        $seller_id = null;
        $sort_search = null;
        $status_search = null;
        $products = Product::orderBy('created_at', 'desc');
        $category = ($request->has('category')) ? $request->category : '';
        
        if ($request->type != null) {
            $var = explode(",", $request->type);
            $col_name = $var[0];
            $query = $var[1];
            if ($col_name == 'status') {
                $products = $products->where('published', $query);
            } else {
                $products = $products->orderBy($col_name, $query);
            }

            $sort_type = $request->type;
        }
        if ($request->has('category') && $request->category !== '0') {
            $childIds = [];
            $categoryfilter = $request->category;
            $childIds[] = array($request->category);
            
            if($categoryfilter != ''){
                $childIds[] = getChildCategoryIds($categoryfilter);
            }

            if(!empty($childIds)){
                $childIds = array_merge(...$childIds);
                $childIds = array_unique($childIds);
            }
            
            $products = $products->whereHas('category', function ($q) use ($childIds) {
                $q->whereIn('id', $childIds);
            });
        }

        if ($request->search != null) {
            $sort_search = $request->search;
            $products = $products
                ->where('name', 'like', '%' . $sort_search . '%');
        }

        if ($request->status != null) {
            $status_search = ($request->status == 0) ? 2 : 1;
            $products = $products
                ->where('published', $request->status);
        }

       

        $products = $products->paginate(15);
        $type = 'All';

        return view('backend.products.index', compact('category','products', 'type','status_search', 'col_name', 'query', 'seller_id', 'sort_search'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->get();

        return view('backend.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // echo '<pre>';
        // // echo env('DEFAULT_LANGUAGE', 'en');
        // print_r($request->all());
        // die;
        
        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->unique_id = $request->product_id;
        $product->user_id = Auth::user()->id;
        $product->frame_size = $request->frame_size;
        $product->poles = $request->poles;
        $product->power = $request->power;
        $product->mounting = $request->mounting;
        $product->voltage = $request->voltage;
        $product->speed = $request->speed;
        $product->efficiency = $request->efficiency;
        $product->hz = $request->hz;
       
        $slug = $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->name, '-');
        $same_slug_count = Product::where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix = $same_slug_count ? '-' . $same_slug_count + 1 : '';
        $slug .= $slug_suffix;

        $product->slug = $slug;
        $product->published = 1;
        $product->save();

        if ($request->hasFile('image')) {
            if ($product->image) {
                if (Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }
            }
            $file_name = strtolower(Str::random(2)).time().'.'. $request->file('image')->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs('products/'.$product->id, $request->file('image'), $file_name );
            if ($name) {
                $product->image = Storage::url($name);
                $product->save();
            } 
        }
        

        $product_translation                       = ProductTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'product_id' => $product->id]);
        $product_translation->name = $request->name;
        $product_translation->market = $request->market;
        $product_translation->save();

        // SEO
        $seo = ProductSeo::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'product_id' => $product->id]);

        $seo->meta_title        = $request->meta_title;
        $seo->meta_description  = $request->meta_description;

        $keywords = array();
        if ($request->meta_keywords[0] != null) {
            foreach (json_decode($request->meta_keywords[0]) as $key => $keyword) {
                array_push($keywords, $keyword->value);
            }
        }
        $seo->meta_keywords = implode(',', $keywords);

        $seo->og_title        = $request->og_title;
        $seo->og_description  = $request->og_description;

        $seo->twitter_title        = $request->twitter_title;
        $seo->twitter_description  = $request->twitter_description;

        if ($request->meta_title == null) {
            $seo->meta_title = $product->name;
        }
        if ($request->og_title == null) {
            $seo->og_title = $product->name;
        }
        if ($request->twitter_title == null) {
            $seo->twitter_title = $product->name;
        }

        $seo->save();

        // Tabs
        if ($request->has('downloads')) {
            foreach ($request->downloads as $downloads) {

                if($downloads['heading'] != NULL && $downloads['pdf_file']){
                    $file_name = strtolower(Str::random(2)).time().'.'. $downloads['pdf_file']->getClientOriginalName();
                    $name = Storage::disk('public')->putFileAs('products/'.$product->id.'/files', $downloads['pdf_file'], $file_name );
                    $p_down = $product->files()->create([
                        'lang'    => env('DEFAULT_LANGUAGE', 'en'),
                        'heading' => $downloads['heading'],
                        'file' => Storage::url($name),
                    ]);
                }
            }
        }

        flash(trans('messages.product').' '.trans('messages.created_msg'))->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return redirect()->route('products.all');
    }

    public function admin_product_edit(Request $request, $id)
    {
        $lang = $request->lang;
       
        $product = Product::with(['files' => function ($query) use ($lang) {
            $query->where('lang', $lang);
        }, 'seo'])->findOrFail($id);
       
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->get();
        return view('backend.products.edit', compact('product', 'categories', 'tags', 'lang'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE",'en')) {
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->unique_id = $request->product_id;
            $product->user_id = Auth::user()->id;
            $product->frame_size = $request->frame_size;
            $product->poles = $request->poles;
            $product->power = $request->power;
            $product->mounting = $request->mounting;
            $product->voltage = $request->voltage;
            $product->speed = $request->speed;
            $product->efficiency = $request->efficiency;
            $product->hz = $request->hz;

            $slug               = $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->name, '-');
            $same_slug_count    = Product::where('slug', 'LIKE', $slug . '%')->where('id','!=',$id)->count();
            $slug_suffix        = $same_slug_count ? '-' . $same_slug_count + 1 : '';
            $slug .= $slug_suffix;

            $product->slug = $slug;
        }
        
        $product->published                 = ($request->has('published')) ? 1 : 0;

        // $product->save();

        if ($request->hasFile('image')) {
            if ($product->image) {
                if (Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }
            }
            $file_name = strtolower(Str::random(2)).time().'.'. $request->file('image')->getClientOriginalName();
            $name = Storage::disk('public')->putFileAs('products/'.$product->id, $request->file('image'), $file_name );
            if ($name) {
                $product->image = Storage::url($name);
            } 
        }
        $product->save();


        $product_translation                       = ProductTranslation::firstOrNew(['lang' => $request->lang, 'product_id' => $product->id]);
        $product_translation->name = $request->name;
        $product_translation->market = $request->market;
        $product_translation->save();


        $seo = ProductSeo::firstOrNew(['lang' => $request->lang, 'product_id' => $product->id]);

        $seo->meta_title        = $request->meta_title;
        $seo->meta_description  = $request->meta_description;

        $keywords = array();
        if ($request->meta_keywords[0] != null) {
            foreach (json_decode($request->meta_keywords[0]) as $key => $keyword) {
                array_push($keywords, $keyword->value);
            }
        }
        $seo->meta_keywords = implode(',', $keywords);

        $seo->og_title        = $request->og_title;
        $seo->og_description  = $request->og_description;

        $seo->twitter_title        = $request->twitter_title;
        $seo->twitter_description  = $request->twitter_description;

        if ($request->meta_title == null) {
            $seo->meta_title = $product->name;
        }
        if ($request->og_title == null) {
            $seo->og_title = $product->name;
        }
        if ($request->twitter_title == null) {
            $seo->twitter_title = $product->name;
        }

        $seo->save();

        if ($request->has('downloads')) {
            $downloads = $request->input('downloads', []);
            $uploadedFiles = $request->file('downloads', []);
            $fileIds = [];
            foreach ($downloads as $key => $download) {
                
                if (!empty($download['downloads_id'])) {
                    $productDownload = ProductFile::findOrFail($download['downloads_id']);
        
                    if (isset($uploadedFiles[$key]['pdf_file'])) {
                        if ($productDownload->file && Storage::exists($productDownload->file)) {
                            Storage::delete($productDownload->file);
                        }
                        $file_name = strtolower(Str::random(2)).time().'.'. $uploadedFiles[$key]['pdf_file']->getClientOriginalName();
                        $newFilePath = Storage::disk('public')->putFileAs('products/'.$product->id.'/files', $uploadedFiles[$key]['pdf_file'], $file_name );
                        $productDownload->file = Storage::url($newFilePath);
                    }
        
                    $productDownload->heading = $download['heading'];
                    $productDownload->save();
                    $fileIds[] = $productDownload->id;
                } else {
                    if($download['heading'] != NULL && isset($uploadedFiles[$key]) && $uploadedFiles[$key]['pdf_file']){
                        $file_name = strtolower(Str::random(2)).time().'.'. $uploadedFiles[$key]['pdf_file']->getClientOriginalName();
                        $name = Storage::disk('public')->putFileAs('products/'.$product->id.'/files', $uploadedFiles[$key]['pdf_file'], $file_name );
                        
                        $fileIns = ProductFile::create([
                            'product_id' => $product->id,
                            'heading' => $download['heading'],
                            'lang' => $request->lang,
                            'file' => Storage::url($name)
                        ]);

                        $fileIds[] = $fileIns->id;
                    }
                }
            }
            if(!empty($fileIds)){
                ProductFile::where('lang', $request->lang)->whereNotIn('id', $fileIds)->delete();
            }
        }
       
       
        flash(trans('messages.product').' '.trans('messages.updated_msg'))->success();
        
        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return redirect()->route('products.all');
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if (Product::destroy($id)) {
            flash(translate('Product has been deleted successfully'))->success();

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            return back();
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

 
    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;

        if ($product->added_by == 'seller' && addon_is_activated('seller_subscription')) {
            $seller = $product->user->seller;
            if ($seller->invalid_at != null && $seller->invalid_at != '0000-00-00' && Carbon::now()->diffInDays(Carbon::parse($seller->invalid_at), false) <= 0) {
                return 0;
            }
        }

        $product->save();
        return 1;
    }

}
