<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryTranslation;
use App\Utility\CategoryUtility;
use Illuminate\Support\Str;
use Cache;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:manage_categories', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'updateFeatured']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catgeory = null;
        $sort_search = null;
        $categories = Category::orderBy('id', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%' . $sort_search . '%');
        }
        if ($request->has('catgeory') && $request->catgeory !== '0') {
            $catgeory = $request->catgeory;
            $categories = $categories->whereHas('parentCategory', function ($q) use ($catgeory) {
                $q->where('id', $catgeory);
            });
        }
        $categories = $categories->paginate(30);
        return view('backend.categories.index', compact('categories', 'sort_search', 'catgeory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->get();

        return view('backend.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'brochure' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:20480',
        ]);

        $category                   = new Category;
        $category->name             = $request->name ?? NULL;
        $category->parent_id        = $request->parent_id;
        if ($request->parent_id != "0") {
            $parent                 = Category::find($request->parent_id);
            $category->level        = $parent->level + 1;
        }

        if ($request->hasFile('brochure')) {
            $filename = 'brochure_files/' . time() . '_' . $request->file('brochure')->getClientOriginalName();
            $fileContents = file_get_contents($request->file('brochure')->getPathname());
            $stored = Storage::disk('public')->put($filename, $fileContents);

            if ($stored) {
                $category->brochure = Storage::url($filename);
            }
        }

        $category->image            = $request->image ?? NULL;
        $category->image_2            = $request->image_2 ?? NULL;
        $category->icon             = $request->icon ?? NULL;
        $category->frame_size       = $request->frame_size ?? NULL;
        $category->output           = $request->output ?? NULL;
        $category->ip_class         = $request->ip_class ?? NULL;
        $category->insulation_class = $request->insulation_class ?? NULL;
        $category->brake            = $request->brake ?? NULL;
        $category->encoder          = $request->encoder ?? NULL;
        $category->voltages         = $request->voltages ?? NULL;
        $category->efficiency       = $request->efficiency ?? NULL;
        $category->approvals        = $request->approvals ?? NULL;
        $category->is_active        = ($request->status == 2) ? 0 : 1;

        $slug               = $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->name, '-');
        $slug               = Str::lower($slug);
        $same_slug_count    = Category::where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix        = $same_slug_count ? '-' . $same_slug_count + 1 : '';
        $slug              .= $slug_suffix;

        $category->slug             = $slug;
        $category->save();

        $category_translation                       = CategoryTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'category_id' => $category->id]);
        $category_translation->name                 = $request->name;
        $category_translation->features             = $request->features ? json_encode($request->features) : NULL;

        $category_translation->description          = $request->description ?? NULL;
        $category_translation->title1               = $request->title1 ?? NULL;
        $category_translation->content1             = $request->content1 ?? NULL;
        $category_translation->title2               = $request->title2 ?? NULL;
        $category_translation->content2             = $request->content2 ?? NULL;
        $category_translation->home_content         = $request->home_content ?? NULL;
        $category_translation->meta_title           = $request->meta_title;
        $category_translation->meta_description     = $request->meta_description;
        $category_translation->meta_keyword         = $request->meta_keywords;
        $category_translation->og_title             = $request->og_title;
        $category_translation->og_description       = $request->og_description;
        $category_translation->twitter_title        = $request->twitter_title;
        $category_translation->twitter_description  = $request->twitter_description;
        $category_translation->save();

        flash(trans('messages.category') . ' ' . trans('messages.created_msg'))->success();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang = $request->lang;
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->whereNotIn('id', CategoryUtility::children_ids($category->id, true))->where('id', '!=', $category->id)
            ->orderBy('name', 'asc')
            ->get();

        return view('backend.categories.edit', compact('category', 'categories', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'brochure' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:20480',
        ]);

        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $category->name         = $request->name;
            $previous_level = $category->level;
            if ($request->parent_id != "0") {
                $category->parent_id = $request->parent_id;

                $parent = Category::find($request->parent_id);
                $category->level = $parent->level + 1;
            } else {
                $category->parent_id = 0;
                $category->level = 0;
            }


            if ($category->level > $previous_level) {
                CategoryUtility::move_level_down($category->id);
            } elseif ($category->level < $previous_level) {
                CategoryUtility::move_level_up($category->id);
            }

            if ($request->hasFile('brochure')) {
                $filename = 'brochure_files/' . time() . '_' . $request->file('brochure')->getClientOriginalName();

                $fileContents = file_get_contents($request->file('brochure')->getPathname());

                $stored = Storage::disk('public')->put($filename, $fileContents);

                if ($stored) {
                    $category->brochure = Storage::url($filename);
                }
            }

            $category->is_active        = ($request->status == 2) ? 0 : 1;
            $category->image            = $request->image ?? NULL;
            $category->image_2          = $request->image_2 ?? NULL;
            $category->icon             = $request->icon ?? NULL;
            $category->frame_size       = $request->frame_size ?? NULL;
            $category->output           = $request->output ?? NULL;
            $category->ip_class         = $request->ip_class ?? NULL;
            $category->insulation_class = $request->insulation_class ?? NULL;
            $category->brake            = $request->brake ?? NULL;
            $category->encoder          = $request->encoder ?? NULL;
            $category->voltages         = $request->voltages ?? NULL;
            $category->efficiency       = $request->efficiency ?? NULL;
            $category->approvals        = $request->approvals ?? NULL;
            $category->is_active        = ($request->status == 2) ? 0 : 1;

            $category->allChildCategories()->update(['is_active' => $request->status]);
            $slug = '';
            if ($request->slug != null) {
                $slug = strtolower(Str::slug($request->slug, '-'));
                $same_slug_count = Category::where('slug', 'LIKE', $slug . '%')->where('id', '!=', $category->id)->count();
                $slug_suffix = $same_slug_count > 0 ? '-' . $same_slug_count + 1 : '';
                $slug .= $slug_suffix;
            }
            $category->slug             = $slug ?? NULL;
            $category->save();
        }



        $category_translation                       = CategoryTranslation::firstOrNew(['lang' => $request->lang, 'category_id' => $category->id]);
        $category_translation->name                 = $request->name;
        $category_translation->description          = $request->description ?? NULL;
        $category_translation->features             = $request->features ? json_encode($request->features) : NULL;
        $category_translation->title1               = $request->title1 ?? NULL;
        $category_translation->content1             = $request->content1 ?? NULL;
        $category_translation->title2               = $request->title2 ?? NULL;
        $category_translation->content2             = $request->content2 ?? NULL;
        $category_translation->home_content         = $request->home_content ?? NULL;
        $category_translation->meta_title           = $request->meta_title;
        $category_translation->meta_description     = $request->meta_description;
        $category_translation->meta_keyword         = $request->meta_keywords;
        $category_translation->og_title             = $request->og_title;
        $category_translation->og_description       = $request->og_description;
        $category_translation->twitter_title        = $request->twitter_title;
        $category_translation->twitter_description  = $request->twitter_description;
        $category_translation->save();

        flash(trans('messages.category') . ' ' . trans('messages.updated_msg'))->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->attributes()->detach();

        // Category Translations Delete
        foreach ($category->category_translations as $key => $category_translation) {
            $category_translation->delete();
        }

        foreach (Product::where('category_id', $category->id)->get() as $product) {
            $product->category_id = null;
            $product->save();
        }

        CategoryUtility::delete_category($id);
        Cache::forget('featured_categories');

        flash(translate('Category has been deleted successfully'))->success();
        return redirect()->route('categories.index');
    }

    public function updateFeatured(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->featured = $request->status;
        $category->save();
        Cache::forget('featured_categories');
        return 1;
    }

    public function updateStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);

        $category->is_active = $request->status;
        $category->save();
        // $category->allChildCategories()->update(['is_active' => $request->status]);
        $category->updateChildStatuses($request->status);
        // Cache::forget('featured_categories');
        return 1;
    }

    public function generateSlug(Request $request)
    {
        $slug = Str::slug($request->title);
        echo  $slug;
    }
}
