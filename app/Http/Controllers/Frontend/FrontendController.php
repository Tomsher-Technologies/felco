<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageTranslations;
use App\Models\PageSeos;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\HomeSlider;
use App\Models\Occasion;
use App\Models\Partners;
use App\Models\Brochure;
use App\Models\BrochureTranslation;
use App\Models\BrochureFile;
use App\Models\BrochureFileTranslation;
use App\Models\Certificate;
use App\Models\CertificateTranslation;
use App\Models\CertificateFile;
use App\Models\CertificateFileTranslation;
use App\Models\CertificateSection;
use App\Models\CertificateSectionTranslation;
use App\Models\Manual;
use App\Models\ManualTranslation;
use App\Models\ManualFile;
use App\Models\ManualFileTranslation;
use App\Models\ManualSection;
use App\Models\ManualSectionTranslation;
use App\Models\ServiceSale;
use App\Models\BusinessSetting;
use App\Models\Subscriber;
use App\Models\Contacts;
use App\Mail\ContactEnquiry;
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

class FrontendController extends Controller
{

    public function loadSEO($model)
    {
        SEOTools::setTitle($model['title']);
        OpenGraph::setTitle($model['title']);
        TwitterCard::setTitle($model['title']);

        SEOMeta::setTitle($model['meta_title'] ?? $model['title']);
        SEOMeta::setDescription($model['meta_description']);
        SEOMeta::addKeyword($model['keywords']);

        OpenGraph::setTitle($model['og_title']);
        OpenGraph::setDescription($model['og_description']);
        OpenGraph::setUrl(URL::full());
        OpenGraph::addProperty('locale', 'en_US');
        
        JsonLd::setTitle($model['meta_title']);
        JsonLd::setDescription($model['meta_description']);
        JsonLd::setType('Page');

        TwitterCard::setTitle($model['twitter_title']);
        TwitterCard::setSite("@aldourigroup");
        TwitterCard::setDescription($model['twitter_description']);

        SEOTools::jsonLd()->addImage(URL::to(asset('assets/img/favicon.svg')));
    }

    public function loadDynamicSEO($model)
    {
        SEOTools::setTitle($model->title);
        OpenGraph::setTitle($model->title);
        TwitterCard::setTitle($model->title);

        SEOMeta::setTitle($model->seo_title ?? $model->title);
        SEOMeta::setDescription($model->seo_description);
        SEOMeta::addKeyword($model->keywords);

        OpenGraph::setTitle($model->og_title);
        OpenGraph::setDescription($model->og_description);
        OpenGraph::setUrl(URL::full());
        OpenGraph::addProperty('locale', 'en_US');
           
        JsonLd::setTitle($model->seo_title);
        JsonLd::setDescription($model->seo_description);
        JsonLd::setType('Page');

        TwitterCard::setTitle($model->twitter_title);
        TwitterCard::setSite("@aldourigroup");
        TwitterCard::setDescription($model->twitter_description);

        SEOTools::jsonLd()->addImage(URL::to(asset('assets/img/favicon.svg')));
    }
    public function home()
    {
        $page = Page::where('type','home')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);

        $data['slider'] = Cache::rememberForever('homeSlider', function () {
            $sliders = HomeSlider::with('slider_translations')->where('status',1)->orderBy('sort_order')->get();
            return $sliders;
        });

        $data['product_categories'] = Cache::rememberForever('product_categories', function () {
            $categories = get_setting('product_categories');
            if ($categories) {
                $details = Category::whereIn('id', json_decode($categories))->where('is_active', 1)
                    ->get();
                return $details;
            }
        });

        $data['special_products'] = Cache::remember('special_products', 3600, function () {
            $product_ids = get_setting('special_products');
            if ($product_ids) {
                $products =  Product::where('published', 1)->whereIn('id', json_decode($product_ids))->with('category')->get();
                return $products;
            }
        });

        // echo '<pre>';
        // print_r($data);
        // die;


        return view('frontend.home',compact('page','data','lang'));
    }

    public function about()
    {
        $page = Page::where('type','about_us')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.about',compact('page','lang'));
    }

    public function marine()
    {
        $page = Page::where('type','marine')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.marine',compact('page','lang'));
    }

    public function oilGas()
    {
        $page = Page::where('type','oil_gas')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.oil_gas',compact('page','lang'));
    }

    public function hvac()
    {
        $page = Page::where('type','hvac')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.hvac',compact('page','lang'));
    }

    public function terms()
    {
        $page = Page::where('type','terms')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.terms',compact('page','lang'));
    }

    public function industries()
    {
        $page = Page::where('type','industries')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.industries',compact('page','lang'));
    }

    public function products()
    {
        $page = Page::where('type','products')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        // ->orderBy('name','asc')
        $categories = Category::where('parent_id',0)->where('is_active',1)->get();
        return view('frontend.products',compact('page','lang','categories'));
    }

    public function privacy()
    {
        $page = Page::where('type','privacy_policy')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.privacy_policy',compact('page','lang'));
    }

    public function faq()
    {
        $page = Page::where('type','faq')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.faq',compact('page','lang'));
    }

    public function service_support()
    {
        $page = Page::where('type','service_support')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.service_support',compact('page','lang'));
    }

    public function contact()
    {
        $page = Page::where('type','contact_us')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.contact_us', compact('page','lang'));
    }

    public function submitContactForm(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string|max:5000',
            'g-recaptcha-response' => 'required'
        ]);

        $con                = new Contacts;
        $con->name          = $request->firstName.' '.$request->lastName;
        $con->email         = $request->email;
        $con->phone         = $request->phone;
        $con->subject       = $request->subject;
        $con->message       = $request->message;
        $con->save();
        
        // Send an email (optional)
        Mail::to(env('MAIL_ADMIN'))->queue(new ContactEnquiry($con));

        session()->flash('message', trans('messages.contact_success_msg'));
        session()->flash('alert-type', 'success');

        return redirect()->back();
    }

    public function changeLanguage(Request $request)
    {
       
        Session::put('locale', $request->locale);
        App::setLocale($request->locale);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ],[
            'email.required' => trans('messages.enter_email'),
            'email.email' => trans('messages.enter_valid_email'),
            'email.unique' => trans('messages.email_already_subscribed'),
        ]);

        Subscriber::create(['email' => $request->email]);

        return response()->json(['success' => trans('messages.newsletter_success')]);
    }

    public function filterByCategory(Request $request, $category_slug){
        $request->session()->put('last_url', url()->full());

        $lang = getActiveLanguage();
        $category = Category::where('slug', $category_slug)->first();
        $products = [];
        $frameSizes = $poles = $powers = $mountings = $voltages = [];
        $keyword = null;

        if($category){
            $query = Product::where('category_id', $category->id)
                                ->where('published', 1);

            if($request->has('keyword')){
                $keyword = $request->keyword;
                $query->where('unique_id', 'like', '%' . $keyword . '%');
            }
            if ($request->has('frame_size') && !empty($request->frame_size)) {
                $query->where('frame_size', $request->frame_size);
            }
        
            if ($request->has('poles') && !empty($request->poles)) {
                $query->where('poles', $request->poles);
            }
        
            if ($request->has('power') && !empty($request->power)) {
                $query->where('power', $request->power);
            }
        
            if ($request->has('mounting') && !empty($request->mounting)) {
                $query->where('mounting', $request->mounting);
            }
        
            if ($request->has('voltage') && !empty($request->voltage)) {
                $query->where('voltage', $request->voltage);
            }
        
            // Retrieve filtered products
            $products = $query->paginate(15);

            $frameSizes = Product::where('category_id', $category->id)->distinct()->pluck('frame_size');
            $poles = Product::where('category_id', $category->id)->distinct()->pluck('poles');
            $powers = Product::where('category_id', $category->id)->distinct()->pluck('power');
            $mountings = Product::where('category_id', $category->id)->distinct()->pluck('mounting');
            $voltages = Product::where('category_id', $category->id)->distinct()->pluck('voltage');
        }
        
        return view('frontend.category_details',compact('category','lang','products','frameSizes','poles','powers','mountings','voltages','keyword'));
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
        // print_r($product);
        // die;

        return view('frontend.product_details', compact('lang','product'));
    }

    public function brochures()
    {
        $page = Page::where('type','brochures')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        $brochures = Brochure::where('status', 1)->orderBy('sort_order', 'ASC')->get();
        
        return view('frontend.brochures',compact('page','lang','brochures'));
    }

    public function certificates()
    {
        $page = Page::where('type','certificates')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        $certificates = Certificate::where('status', 1)->orderBy('sort_order', 'ASC')->get();
        
        return view('frontend.certificates',compact('page','lang','certificates'));
    }

    public function manuals()
    {
        $page = Page::where('type','manuals')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        $manuals = Manual::where('status', 1)->orderBy('sort_order', 'ASC')->get();
       
        return view('frontend.manuals',compact('page','lang','manuals'));
    }

    public function service_sales(){
        $page = Page::where('type','service_sales')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
            ];

        $this->loadSEO($seo);
        $service_sales = ServiceSale::where('status', 1)->where('lang', $lang)->orderBy('sort_order',
        'ASC')->get();

        return view('frontend.service_sales',compact('page','lang','service_sales'));
    }

}
