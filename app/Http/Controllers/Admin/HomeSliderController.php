<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Models\HomeSliderTranslation;
use Cache;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = HomeSlider::paginate(15);
        return view('backend.home_sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.home_sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'banner' => 'required',
            'mobile_banner' => 'required',
            'status' => 'required'
        ]);

        $slider = HomeSlider::create([
            'name' => $request->name,
            'image' => $request->banner,
            'mobile_image' => $request->mobile_banner,
            'link' => $request->link,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);

        $slider_translation                       = HomeSliderTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'slider_id' => $slider->id]);
        $slider_translation->title = $request->title;
        $slider_translation->sub_title = $request->sub_title;
        $slider_translation->btn_text = $request->btn_text;
        $slider_translation->save();

        Cache::forget('homeSlider');

        flash(trans('messages.slider').' '.trans('messages.created_msg'))->success();
        return redirect()->route('home-slider.index');
    }

  
    public function edit(Request $request, $id)
    {
        $lang = $request->lang;
        $homeSlider = HomeSlider::findOrFail($id);

        return view('backend.home_sliders.edit', compact('homeSlider','lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Frontend\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'banner' => 'required',
            'mobile_banner' => 'required',
            'status' => 'required'
        ]);

        $homeSlider = HomeSlider::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE",'en')) {
            $homeSlider->name = $request->name;
            $homeSlider->mobile_image = $request->mobile_banner;
            $homeSlider->image = $request->banner;
            $homeSlider->link = $request->link;
            $homeSlider->sort_order = $request->sort_order;
            $homeSlider->status = $request->status;
            $homeSlider->save();
        }

        $slider_translation                       = HomeSliderTranslation::firstOrNew(['lang' => $request->lang, 'slider_id' => $homeSlider->id]);
        $slider_translation->title = $request->title;
        $slider_translation->sub_title = $request->sub_title;
        $slider_translation->btn_text = $request->btn_text;
        $slider_translation->lang = $request->lang;
        $slider_translation->save();

        Cache::forget('homeSlider');

        flash(trans('messages.slider').' '.trans('messages.updated_msg'))->success();
        return redirect()->route('home-slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frontend\HomeSlider  $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HomeSlider::destroy($id);
        Cache::forget('homeSlider');
        flash(trans('messages.slider').' '.trans('messages.deleted_msg'))->success();
        return redirect()->route('home-slider.index');
    }

    public function updateStatus(Request $request)
    {
        $slider = HomeSlider::findOrFail($request->id);
        Cache::forget('homeSlider');
        $slider->status = $request->status;
        if ($slider->save()) {
            return 1;
        }
        return 0;
    }
}
