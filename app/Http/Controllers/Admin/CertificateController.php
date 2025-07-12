<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\CertificateTranslation;
use App\Models\CertificateFile;
use App\Models\CertificateFileTranslation;
use App\Models\CertificateSection;
use App\Models\CertificateSectionTranslation;
use Illuminate\Http\Request;
use Storage;

class CertificateController extends Controller
{
    public function allCertificates()
    {
        $certificates = Certificate::orderBy('sort_order','asc')->paginate(15);
        return view('backend.certificates.index', compact('certificates'));
    }

    public function createCertificate(){
        return view('backend.certificates.create');
    }

    public function storeCertificate(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'required'
        ]);

        $certificate = Certificate::create([
            'title' => $request->title,
            'image' => $request->image,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);

        $certificate->refresh();
        
        $certificate_translation                       = CertificateTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'certificate_id' => $certificate->id]);
        $certificate_translation->title = $request->title;
        $certificate_translation->save();

        flash(trans('messages.certificate').' '.trans('messages.created_msg'))->success();
        return redirect()->route('certificates.all');
    }

    public function updateCertificateStatus(Request $request){
        $cert = Certificate::findOrFail($request->id);
        $cert->status = $request->status;
        if ($cert->save()) {
            return 1;
        }
        return 0;
    }

    public function destroyCertificate($id){
        Certificate::destroy($id);
       
        flash(trans('messages.certificate').' '.trans('messages.deleted_msg'))->success();
        return redirect()->route('certificates.all');
    }

    public function editCertificate(Request $request, $id){
        $lang = $request->lang;
        $certificate = Certificate::findOrFail($id);

        return view('backend.certificates.edit', compact('certificate','lang'));
    }

    public function updateCertificate(Request $request, $id){
        $request->validate([
            'title' => 'required'
        ]);
        $cert = Certificate::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE",'en')) {
            $cert->title = $request->title;
            $cert->image = $request->image;
            $cert->sort_order = $request->sort_order;
            $cert->status = $request->status;
            $cert->save();
        }

        $cert_translation           = CertificateTranslation::firstOrNew(['lang' => $request->lang, 'certificate_id' => $cert->id]);
        $cert_translation->title    = $request->title;
        $cert_translation->save();

        flash(trans('messages.certificate').' '.trans('messages.updated_msg'))->success();
        return redirect()->route('certificates.all');
    }

    public function allCertificateSections($id){
        $sections = CertificateSection::where('certificate_id', $id)->orderBy('sort_order','asc')->paginate(15);
        $certificate = Certificate::find($id);
        return view('backend.certificates.sections.index', compact('sections','certificate'));
    }

    public function createSection($id){
        $certificate = Certificate::find($id);
        return view('backend.certificates.sections.create', compact('certificate'));
    }

    public function storeSection(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'button_text' => 'required'
        ]);

        $section = CertificateSection::create([
            'certificate_id' => $request->certificate_id,
            'title' => $request->title,
            'sort_order' => $request->sort_order,
            'status' => $request->status,
        ]);

        $section->refresh();
        
        $section_translation                = CertificateSectionTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'certificate_section_id' => $section->id]);
        $section_translation->title         = $request->title;
        $section_translation->content       = $request->content;
        $section_translation->button_text   = $request->button_text;
        $section_translation->save();

        flash(trans('messages.section').' '.trans('messages.created_msg'))->success();
        return redirect()->route('sections.all',['id'=>$request->certificate_id]);
    }

    public function editSection(Request $request, $id){
        $lang = $request->lang;
        $section = CertificateSection::findOrFail($id);

        return view('backend.certificates.sections.edit', compact('section','lang'));
    }

    public function updateSection(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'button_text' => 'required'
        ]);
      
        $section = CertificateSection::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE",'en')) {
            $section->title         = $request->title;
            $section->sort_order    = $request->sort_order;
            $section->status        = $request->status;
            $section->save();
        }

        $section->refresh();

        $section_translation                = CertificateSectionTranslation::firstOrNew(['lang' => $request->lang, 'certificate_section_id' => $section->id]);
        $section_translation->title         = $request->title;
        $section_translation->content       = $request->content;
        $section_translation->button_text   = $request->button_text;
        $section_translation->save();

        flash(trans('messages.section').' '.trans('messages.updated_msg'))->success();
        return redirect()->route('sections.all',['id'=>$section->certificate_id]);
    }

    public function updateSectionStatus(Request $request){
        $section = CertificateSection::findOrFail($request->id);
        $section->status = $request->status;
        if ($section->save()) {
            return 1;
        }
        return 0;
    }

    public function destroySection($id){
        $section = CertificateSection::findOrFail($id);

        $certificate_id = $section->certificate_id;
        $section->delete();
       
        flash('Section '.trans('messages.deleted_msg'))->success();
        return redirect()->route('sections.all',['id'=>$certificate_id]);
    }


    public function allCertificateFiles($certificate_id, $section_id){
        $files = CertificateFile::where('certificate_section_id',$section_id)->orderBy('sort_order','asc')->paginate(15);
        $certificate = Certificate::find($certificate_id);
        $section = CertificateSection::find($section_id);

        return view('backend.certificates.files.index', compact('section','certificate','files'));
    }

    public function createCertificateFile($section_id){
        $section = CertificateSection::find($section_id);
        return view('backend.certificates.files.create', compact('section'));
    }

    public function storeCertificateFile(Request $request){
        $request->validate([
            'pdf_file' => 'required',
            'title' => 'required',
        ]);

        $certificate_file = new CertificateFile();

        $filename  = 'certificate_files/'.time().'_'.$request->file('pdf_file')->getClientOriginalName();
        $imageContents = file_get_contents($request->file('pdf_file'));
    
        $name       = Storage::disk('public')->put($filename, $imageContents);
        if ($name) {
            $certificate_file->file = Storage::url($filename);
        } 
        $certificate_file->title                    = $request->title;
        $certificate_file->status                   = $request->status;
        $certificate_file->sort_order               = $request->sort_order;
        $certificate_file->certificate_section_id   = $request->certificate_section_id;
        $certificate_file->save();

        $file_translation                = CertificateFileTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE', 'en'), 'certificate_file_id' => $certificate_file->id]);
        $file_translation->title         = $request->title;
        $file_translation->save();

        $section = CertificateSection::find($request->certificate_section_id);

        flash('File '.trans('messages.added_msg'))->success();
        return redirect()->route('certificate-files.all',['certificate_id' => $section->certificate_id, 'section_id' => $section->id]);

    }

    public function editCertificateFile(Request $request,$id){
        $lang = $request->lang;
        $file = CertificateFile::findOrFail($id);
        $section = CertificateSection::findOrFail($file->certificate_section_id);

        return view('backend.certificates.files.edit', compact('section','lang','file'));
    }

    public function updateCertificateFile(Request $request, $id){
        $request->validate([
            'title' => 'required'
        ]);
      
        $file = CertificateFile::findOrFail($id);
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
                
                $filename  = 'certificate_files/'.time().'_'.$request->file('pdf_file')->getClientOriginalName();
                $imageContents = file_get_contents($request->file('pdf_file'));
                $name       = Storage::disk('public')->put($filename, $imageContents);
                if ($name) {
                    $file->file = Storage::url($filename);
                }
            }

            $file->save();
        }

        $file->refresh();

        $file_translation                = CertificateFileTranslation::firstOrNew(['lang' => $request->lang, 'certificate_file_id' => $file->id]);
        $file_translation->title         = $request->title;
        $file_translation->save();

        $section = CertificateSection::find($file->certificate_section_id);

        flash('File '.trans('messages.updated_msg'))->success();
        return redirect()->route('certificate-files.all',['certificate_id' => $section->certificate_id, 'section_id' => $section->id]);
    }

    public function updateCertificateFileStatus(Request $request){
        $certificate_file = CertificateFile::find($request->id);
        $certificate_file->status = $request->status;
        
        if ($certificate_file->save()) {
            return 1;
        }
        return 0;
    }

    public function destroyCertificateFile(Request $request){
        $certificate_file = CertificateFile::find($request->id);

        if (!empty($certificate_file->file)) { // Assuming $file->file contains the old file path
            $oldFilePath = str_replace('/storage/', 'public/', $certificate_file->file); // Convert URL to storage path
            if (Storage::exists($oldFilePath)) {
                Storage::delete($oldFilePath);
            }
        }

        $section_id = $certificate_file->certificate_section_id;
        $certificate_file->delete();
        $section = CertificateSection::find($section_id);

        flash('File '.trans('messages.deleted_msg'))->success();
        return redirect()->route('certificate-files.all',['certificate_id' => $section->certificate_id, 'section_id' => $section->id]);
    }
}
