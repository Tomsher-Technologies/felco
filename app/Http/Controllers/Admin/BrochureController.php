<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brochure;
use App\Models\BrochureTranslation;
use App\Models\BrochureFile;
use App\Models\BrochureFileTranslation;
use Illuminate\Http\Request;
use Storage;

class BrochureController extends Controller
{
    public function allBrochures()
    {
        $brochures = Brochure::orderBy('sort_order','asc')->paginate(15);
        return view('backend.brochures.index', compact('brochures'));
    }

    public function createBrochure(){
        return view('backend.brochures.create');
    }

    public function storeBrochure(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required'
        ]);

        $brochure = Brochure::create([
            'title' => $request->title,
            'image' => $request->image,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);

        $brochure->refresh();
        
        $brochure_translation                       = BrochureTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'brochure_id' => $brochure->id]);
        $brochure_translation->title = $request->title;
        $brochure_translation->save();

        flash(trans('messages.brochure').' '.trans('messages.created_msg'))->success();
        return redirect()->route('brochures.all');
    }

    public function updateBrochureStatus(Request $request){
        $broch = Brochure::findOrFail($request->id);
        $broch->status = $request->status;
        if ($broch->save()) {
            return 1;
        }
        return 0;
    }

    public function destroyBrochure($id){
        Brochure::destroy($id);
       
        flash(trans('messages.brochure').' '.trans('messages.deleted_msg'))->success();
        return redirect()->route('brochures.all');
    }

    public function editBrochure(Request $request, $id){
        $lang = $request->lang;
        $brochure = Brochure::findOrFail($id);

        return view('backend.brochures.edit', compact('brochure','lang'));
    }

    public function updateBrochure(Request $request, $id){
        $request->validate([
            'title' => 'required'
        ]);
        $broch = Brochure::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE",'en')) {
            $broch->title = $request->title;
            $broch->image = $request->image;
            $broch->sort_order = $request->sort_order;
            $broch->status = $request->status;
            $broch->save();
        }

        $broch_translation           = BrochureTranslation::firstOrNew(['lang' => $request->lang, 'brochure_id' => $broch->id]);
        $broch_translation->title    = $request->title;
        $broch_translation->save();

        flash(trans('messages.brochure').' '.trans('messages.updated_msg'))->success();
        return redirect()->route('brochures.all');
    }

    public function allBrochureFiles($brochure_id){
        $files = BrochureFile::where('brochure_id',$brochure_id)->orderBy('sort_order','asc')->paginate(15);
        $brochure = Brochure::find($brochure_id);
       
        return view('backend.brochures.files.index', compact('brochure','files'));
    }

    public function createBrochureFile($brochure_id){
        $brochure = Brochure::find($brochure_id);
        return view('backend.brochures.files.create', compact('brochure'));
    }

    public function updateBrochureFileStatus(Request $request){
        $brochure_file = BrochureFile::find($request->id);
        $brochure_file->status = $request->status;
        
        if ($brochure_file->save()) {
            return 1;
        }
        return 0;
    }

    public function storeBrochureFile(Request $request){
        $request->validate([
            'pdf_file' => 'required',
            'title' => 'required',
            'content' => 'required',
            'button_text' => 'required'
        ]);

        $brochure_file = new BrochureFile();

        $filename  = 'brochure_files/'.time().'_'.$request->file('pdf_file')->getClientOriginalName();
        $imageContents = file_get_contents($request->file('pdf_file'));
    
        $name       = Storage::disk('public')->put($filename, $imageContents);
        if ($name) {
            $brochure_file->file = Storage::url($filename);
        } 
        $brochure_file->title           = $request->title;
        $brochure_file->status          = $request->status;
        $brochure_file->sort_order      = $request->sort_order;
        $brochure_file->brochure_id     = $request->brochure_id;
        $brochure_file->save();

        $file_translation               = BrochureFileTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'brochure_file_id' => $brochure_file->id]);
        $file_translation->title        = $request->title;
        $file_translation->content      = $request->content;
        $file_translation->button_text  = $request->button_text;
        $file_translation->save();

        flash('File '.trans('messages.added_msg'))->success();
        return redirect()->route('brochure-files.all',['brochure_id' => $request->brochure_id]);

    }

    public function editBrochureFile(Request $request,$id){
        $lang = $request->lang;
        $file = BrochureFile::findOrFail($id);
        $brochure = Brochure::findOrFail($file->brochure_id);

        return view('backend.brochures.files.edit', compact('brochure','lang','file'));
    }

    public function updateBrochureFile(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'button_text' => 'required'
        ]);
      
        $file = BrochureFile::findOrFail($id);
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
            
                $filename  = 'brochure_files/'.time().'_'.$request->file('pdf_file')->getClientOriginalName();
                $imageContents = file_get_contents($request->file('pdf_file'));
                $name       = Storage::disk('public')->put($filename, $imageContents);
                if ($name) {
                    $file->file = Storage::url($filename);
                }
            }

            $file->save();
        }

        $file->refresh();

        $file_translation                = BrochureFileTranslation::firstOrNew(['lang' => $request->lang, 'brochure_file_id' => $file->id]);
        $file_translation->title         = $request->title;
        $file_translation->content       = $request->content;
        $file_translation->button_text   = $request->button_text;
        $file_translation->save();

        flash('File '.trans('messages.updated_msg'))->success();
        return redirect()->route('brochure-files.all',['brochure_id' => $file->brochure_id]);
    }

    public function destroyBrochureFile(Request $request){
        $brochure_file = BrochureFile::find($request->id);

        if (!empty($brochure_file->file)) { // Assuming $file->file contains the old file path
            $oldFilePath = str_replace('/storage/', 'public/', $brochure_file->file); // Convert URL to storage path
            if (Storage::exists($oldFilePath)) {
                Storage::delete($oldFilePath);
            }
        }

        $brochure_id = $brochure_file->brochure_id;
        $brochure_file->delete();
        
        flash('File '.trans('messages.deleted_msg'))->success();
        return redirect()->route('brochure-files.all',['brochure_id' => $brochure_id]);
    }

}
