<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\IndustryTranslation;
use App\Utility\CategoryUtility;
use Illuminate\Http\Request;
use Str;


class IndustryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:manage_industries', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'updateFeatured']]);
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
        $industries = Industry::orderBy('id', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $categories = $industries->where('name', 'like', '%' . $sort_search . '%');
        }
        $industries = $industries->paginate(30);
        return view('backend.industries.index', compact('industries', 'sort_search', 'catgeory'));
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

        return view('backend.industries.create', compact('categories'));
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
        ]);

        $industry                   = new Industry;
        $industry->name             = $request->name ?? NULL;
        $industry->image            = $request->image ?? NULL;
        $industry->content_image    = $request->content_image ?? NULL;
        $industry->selected_categories   = $request->selected_categories ? json_encode($request->selected_categories) : NULL;
        $industry->is_active        = ($request->status == 2) ? 0 : 1;

        $slug               = $request->slug ? Str::slug($request->slug, '-') : Str::slug($request->name, '-');
        $slug               = Str::lower($slug);
        $same_slug_count    = Industry::where('slug', 'LIKE', $slug . '%')->count();
        $slug_suffix        = $same_slug_count ? '-' . $same_slug_count + 1 : '';
        $slug              .= $slug_suffix;

        $industry->slug             = $slug;
        $industry->save();

        $industry_translation                       = IndustryTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'industry_id' => $industry->id]);
        $industry_translation->name                 = $request->name;
        $industry_translation->description          = $request->description ?? NULL;
        $industry_translation->title1               = $request->title1 ?? NULL;
        $industry_translation->content1             = $request->content1 ?? NULL;
        $industry_translation->title2               = $request->title2 ?? NULL;
        $industry_translation->content2             = $request->content2 ?? NULL;
        $industry_translation->applications = $request->applications ? json_encode($request->applications) : NULL;
        $industry_translation->meta_title           = $request->meta_title;
        $industry_translation->meta_description     = $request->meta_description;
        $industry_translation->meta_keyword         = $request->meta_keywords;
        $industry_translation->og_title             = $request->og_title;
        $industry_translation->og_description       = $request->og_description;
        $industry_translation->twitter_title        = $request->twitter_title;
        $industry_translation->twitter_description  = $request->twitter_description;
        $industry_translation->save();

        flash(trans('messages.industry') . ' ' . trans('messages.created_msg'))->success();
        return redirect()->route('industries.index');
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
        $industry = Industry::findOrFail($id);
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->orderBy('name', 'asc')
            ->get();

        return view('backend.industries.edit', compact('industry', 'categories', 'lang'));
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
        $industry = Industry::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $industry->name               = $request->name ?? NULL;
            $industry->image              = $request->image ?? NULL;
            $industry->content_image      = $request->content_image ?? NULL;
            $industry->selected_categories = $request->selected_categories
                ? json_encode($request->selected_categories)
                : NULL;
            $industry->is_active          = ($request->status == 2) ? 0 : 1;

            $slug = '';
            if ($request->slug != null) {
                $slug = strtolower(Str::slug($request->slug, '-'));
                $same_slug_count = Industry::where('slug', 'LIKE', $slug . '%')
                    ->where('id', '!=', $industry->id)
                    ->count();
                $slug_suffix = $same_slug_count > 0 ? '-' . ($same_slug_count + 1) : '';
                $slug .= $slug_suffix;
            }
            $industry->slug = $slug ?? NULL;

            $industry->save();
        }

        $industry_translation = IndustryTranslation::firstOrNew([
            'lang'        => $request->lang,
            'industry_id' => $industry->id
        ]);

        $industry_translation->name                = $request->name;
        $industry_translation->description         = $request->description ?? NULL;
        $industry_translation->title1              = $request->title1 ?? NULL;
        $industry_translation->content1            = $request->content1 ?? NULL;
        $industry_translation->title2              = $request->title2 ?? NULL;
        $industry_translation->content2            = $request->content2 ?? NULL;
        $industry_translation->applications        = $request->applications ? json_encode($request->applications) : $industry_translation->applications;
        $industry_translation->meta_title          = $request->meta_title;
        $industry_translation->meta_description    = $request->meta_description;
        $industry_translation->meta_keyword        = $request->meta_keywords;
        $industry_translation->og_title            = $request->og_title;
        $industry_translation->og_description      = $request->og_description;
        $industry_translation->twitter_title       = $request->twitter_title;
        $industry_translation->twitter_description = $request->twitter_description;

        $industry_translation->save();

        flash(trans('messages.industry') . ' ' . trans('messages.updated_msg'))->success();
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
        $industry = Industry::findOrFail($id);

        foreach ($industry->industry_translations as $translation) {
            $translation->delete();
        }

        $industry->delete();

        flash(trans('messages.industry') . ' ' . trans('messages.deleted_msg'))->success();
        return redirect()->route('industries.index');
    }



    public function updateStatus(Request $request)
    {
        $industry = Industry::findOrFail($request->id);

        $industry->is_active = $request->status;
        $industry->save();

        return 1;
    }

    public function generateSlug(Request $request)
    {
        $slug = Str::slug($request->title);
        echo  $slug;
    }
}
