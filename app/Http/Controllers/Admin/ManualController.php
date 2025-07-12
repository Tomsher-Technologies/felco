<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Manual;
use App\Models\ManualTranslation;
use App\Models\ManualFile;
use App\Models\ManualFileTranslation;
use App\Models\ManualSection;
use App\Models\ManualSectionTranslation;
use Illuminate\Http\Request;
use Storage;

class ManualController extends Controller
{
    public function allManuals()
    {
        $manuals = Manual::orderBy('sort_order','asc')->paginate(15);
        return view('backend.manuals.index', compact('manuals'));
    }

    public function createManual(){
        return view('backend.manuals.create');
    }

    public function storeManual(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required'
        ]);

        $manual = Manual::create([
            'title' => $request->title,
            'image' => $request->image,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);

        $manual->refresh();
        
        $manual_translation                       = ManualTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'manual_id' => $manual->id]);
        $manual_translation->title = $request->title;
        $manual_translation->save();

        flash(trans('messages.manual').' '.trans('messages.created_msg'))->success();
        return redirect()->route('manuals.all');
    }

    public function updateManualStatus(Request $request){
        $cert = Manual::findOrFail($request->id);
        $cert->status = $request->status;
        if ($cert->save()) {
            return 1;
        }
        return 0;
    }

    public function destroyManual($id){
        Manual::destroy($id);
       
        flash(trans('messages.manual').' '.trans('messages.deleted_msg'))->success();
        return redirect()->route('manuals.all');
    }

    public function editManual(Request $request, $id){
        $lang = $request->lang;
        $manual = Manual::findOrFail($id);

        return view('backend.manuals.edit', compact('manual','lang'));
    }

    public function updateManual(Request $request, $id){
        $request->validate([
            'title' => 'required'
        ]);
        $cert = Manual::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE",'en')) {
            $cert->title = $request->title;
            $cert->image = $request->image;
            $cert->sort_order = $request->sort_order;
            $cert->status = $request->status;
            $cert->save();
        }

        $cert_translation           = ManualTranslation::firstOrNew(['lang' => $request->lang, 'manual_id' => $cert->id]);
        $cert_translation->title    = $request->title;
        $cert_translation->save();

        flash(trans('messages.manual').' '.trans('messages.updated_msg'))->success();
        return redirect()->route('manuals.all');
    }

    public function allManualSections($id){
        $sections = ManualSection::where('manual_id', $id)->orderBy('sort_order','asc')->paginate(15);
        $manual = Manual::find($id);
        return view('backend.manuals.sections.index', compact('sections','manual'));
    }

    public function createSection($id){
        $manual = Manual::find($id);
        return view('backend.manuals.sections.create', compact('manual'));
    }

    public function storeSection(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'button_text' => 'required'
        ]);

        $section = ManualSection::create([
            'manual_id' => $request->manual_id,
            'title' => $request->title,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);

        $section->refresh();
        
        $section_translation                = ManualSectionTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'manual_section_id' => $section->id]);
        $section_translation->title         = $request->title;
        $section_translation->content       = $request->content;
        $section_translation->button_text   = $request->button_text;
        $section_translation->save();

        flash(trans('messages.section').' '.trans('messages.created_msg'))->success();
        return redirect()->route('manual-sections.all',['id'=>$request->manual_id]);
    }

    public function editSection(Request $request, $id){
        $lang = $request->lang;
        $section = ManualSection::findOrFail($id);

        return view('backend.manuals.sections.edit', compact('section','lang'));
    }

    public function updateSection(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'button_text' => 'required'
        ]);
      
        $section = ManualSection::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE",'en')) {
            $section->title         = $request->title;
            $section->sort_order    = $request->sort_order;
            $section->status        = $request->status;
            $section->save();
        }

        $section->refresh();

        $section_translation                = ManualSectionTranslation::firstOrNew(['lang' => $request->lang, 'manual_section_id' => $section->id]);
        $section_translation->title         = $request->title;
        $section_translation->content       = $request->content;
        $section_translation->button_text   = $request->button_text;
        $section_translation->save();

        flash(trans('messages.section').' '.trans('messages.updated_msg'))->success();
        return redirect()->route('manual-sections.all',['id'=>$section->manual_id]);
    }

    public function updateSectionStatus(Request $request){
        $section = ManualSection::findOrFail($request->id);
        $section->status = $request->status;
        if ($section->save()) {
            return 1;
        }
        return 0;
    }

    public function destroySection($id){
        $section = ManualSection::findOrFail($id);

        $manual_id = $section->manual_id;
        $section->delete();
       
        flash('Section '.trans('messages.deleted_msg'))->success();
        return redirect()->route('manual-sections.all',['id'=>$manual_id]);
    }


    public function allManualFiles($manual_id, $section_id){
        $files = ManualFile::where('manual_section_id',$section_id)->orderBy('sort_order','asc')->paginate(15);
        $manual = Manual::find($manual_id);
        $section = ManualSection::find($section_id);

        return view('backend.manuals.files.index', compact('section','manual','files'));
    }

    public function createManualFile($section_id){
        $section = ManualSection::find($section_id);
        return view('backend.manuals.files.create', compact('section'));
    }

    public function storeManualFile(Request $request){
        $request->validate([
            'pdf_file' => 'required',
            'title' => 'required',
        ]);

        $manual_file = new ManualFile();

        $filename  = 'manual_files/'.time().'_'.$request->file('pdf_file')->getClientOriginalName();
        $imageContents = file_get_contents($request->file('pdf_file'));
    
        $name       = Storage::disk('public')->put($filename, $imageContents);
        if ($name) {
            $manual_file->file = Storage::url($filename);
        } 
        $manual_file->title                    = $request->title;
        $manual_file->status                   = $request->status;
        $manual_file->sort_order               = $request->sort_order;
        $manual_file->manual_section_id   = $request->manual_section_id;
        $manual_file->save();

        $file_translation                = ManualFileTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'manual_file_id' => $manual_file->id]);
        $file_translation->title         = $request->title;
        $file_translation->save();

        $section = ManualSection::find($request->manual_section_id);

        flash('File '.trans('messages.added_msg'))->success();
        return redirect()->route('manual-files.all',['manual_id' => $section->manual_id, 'section_id' => $section->id]);

    }

    public function editManualFile(Request $request,$id){
        $lang = $request->lang;
        $file = ManualFile::findOrFail($id);
        $section = ManualSection::findOrFail($file->manual_section_id);

        return view('backend.manuals.files.edit', compact('section','lang','file'));
    }

    public function updateManualFile(Request $request, $id){
        $request->validate([
            'title' => 'required'
        ]);
      
        $file = ManualFile::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE",'en')) {
            $file->title         = $request->title;
            $file->sort_order    = $request->sort_order;
            $file->status        = $request->status;

            if ($request->hasfile('pdf_file')) {
                if (!empty($file->file)) { // Assuming $file->file contains the old file path
                    $oldFilePath = str_replace('/storage/', 'public/', $file->file); // Convert URL to storage path
                    if (Storage::exists($oldFilePath)) {
                        Storage::delete($oldFilePath);
                    }
                }
                
                $filename  = 'manual_files/'.time().'_'.$request->file('pdf_file')->getClientOriginalName();
                $imageContents = file_get_contents($request->file('pdf_file'));
                $name       = Storage::disk('public')->put($filename, $imageContents);
                if ($name) {
                    $file->file = Storage::url($filename);
                }
            }

            $file->save();
        }

        $file->refresh();

        $file_translation                = ManualFileTranslation::firstOrNew(['lang' => $request->lang, 'manual_file_id' => $file->id]);
        $file_translation->title         = $request->title;
        $file_translation->save();

        $section = ManualSection::find($file->manual_section_id);

        flash('File '.trans('messages.updated_msg'))->success();
        return redirect()->route('manual-files.all',['manual_id' => $section->manual_id, 'section_id' => $section->id]);
    }

    public function updateManualFileStatus(Request $request){
        $manual_file = ManualFile::find($request->id);
        $manual_file->status = $request->status;
        
        if ($manual_file->save()) {
            return 1;
        }
        return 0;
    }

    public function destroyManualFile(Request $request){
        $manual_file = ManualFile::find($request->id);

        if (!empty($manual_file->file)) { // Assuming $file->file contains the old file path
            $oldFilePath = str_replace('/storage/', 'public/', $manual_file->file); // Convert URL to storage path
            if (Storage::exists($oldFilePath)) {
                Storage::delete($oldFilePath);
            }
        }

        $section_id = $manual_file->manual_section_id;
        $manual_file->delete();
        $section = ManualSection::find($section_id);

        flash('File '.trans('messages.deleted_msg'))->success();
        return redirect()->route('manual-files.all',['manual_id' => $section->manual_id, 'section_id' => $section->id]);
    }
}
