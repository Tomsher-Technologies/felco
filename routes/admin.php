<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AizUploadController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\Bannercontroller;
use App\Http\Controllers\Admin\OccasionController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BusinessSettingsController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\BrochureController;

Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);
    
});

Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('/cache-cache', [AdminController::class, 'clearCache'])->name('cache.clear');

    Route::resource('roles', RoleController::class);
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::get('/roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::resource('staffs', StaffController::class);
    Route::get('/staffs/destroy/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');

    Route::post('/banners/get_form', [Bannercontroller::class, 'get_form'])->name('banners.get_form');
    Route::get('/banners/destroy/{banner}', [Bannercontroller::class, 'destroy'])->name('banners.destroy');
    Route::resource('banners', Bannercontroller::class)->except(['show', 'destroy']);
    Route::get('/banners/edit/{id}', [Bannercontroller::class, 'edit'])->name('banners.edit');

    Route::get('/enquiries-contact', [PageController::class, 'enquiries'])->name('enquiries.contact');
    Route::get('/subscribers', [PageController::class, 'subscribers'])->name('subscribers.index');
    Route::get('/subscribers/destroy/{id}', [PageController::class, 'subscribersDestroy'])->name('subscriber.destroy');
    // website setting
    Route::group(['prefix' => 'website'], function () {
        Route::get('/footer', [WebsiteController::class, 'footer'])->name('website.footer');

        Route::get('/header', [WebsiteController::class, 'header'])->name('website.header');
        Route::get('/appearance', [WebsiteController::class, 'appearance'])->name('website.appearance');
        
        Route::post('/home-slider/update-status', [HomeSliderController::class, 'updateStatus'])->name('home-slider.update-status');
        Route::get('/home-slider/delete/{id}', [HomeSliderController::class, 'destroy'])->name('home-slider.delete');
        Route::resource('home-slider', HomeSliderController::class);
        Route::get('/home-slider/{id}/edit', [HomeSliderController::class, 'edit'])->name('home-slider.edit');
        Route::post('/home-slider/update/{id}', [HomeSliderController::class, 'update'])->name('home-slider.update');

        Route::resource('custom-pages', PageController::class);
        Route::get('/pages', [PageController::class, 'index'])->name('website.pages');
        Route::get('/custom-pages/edit/{id}', [PageController::class, 'edit'])->name('custom-pages.edit');
        Route::get('/custom-pages/destroy/{id}', [PageController::class, 'destroy'])->name('custom-pages.destroy');
        Route::post('/page/delete_image', [PageController::class, 'delete_image'])->name('page.delete_image');

    });


    // uploaded files
    Route::any('/uploaded-files/file-info', [AizUploadController::class, 'file_info'])->name('uploaded-files.info');
    Route::resource('/uploaded-files', AizUploadController::class);
    Route::get('/uploaded-files/destroy/{id}', [AizUploadController::class, 'destroy'])->name('uploaded-files.destroy');
    Route::post('/aiz-uploader', [AizUploadController::class, 'show_uploader']);
    Route::post('/aiz-uploader/upload', [AizUploadController::class, 'upload']);
    Route::get('/aiz-uploader/get_uploaded_files', [AizUploadController::class, 'get_uploaded_files']);
    Route::post('/aiz-uploader/get_file_by_ids', [AizUploadController::class, 'get_preview_files']);
    Route::get('/aiz-uploader/download/{id}', [AizUploadController::class, 'attachment_download'])->name('download_attachment');

    // Categories
    Route::get('/generate-slug', [CategoryController::class, 'generateSlug'])->name('generate-slug');
    Route::resource('categories', CategoryController::class)->except(['destroy']);
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/status', [CategoryController::class, 'updateStatus'])->name('categories.status');


    // Manage Products
    Route::get('/products/all', [ProductController::class, 'all_products'])->name('products.all');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store/', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/add-attributes', [ProductController::class, 'get_attribute_values'])->name('products.add-attributes');
    Route::get('/products/admin/{id}/edit', [ProductController::class, 'admin_product_edit'])->name('products.edit');

    Route::post('/products/published', [ProductController::class, 'updatePublished'])->name('products.published');
    Route::post('/products/delete-thumbnail', [ProductController::class, 'delete_thumbnail'])->name('products.delete_thumbnail');
    Route::post('/products/delete_gallery', [ProductController::class, 'delete_gallery'])->name('products.delete_gallery');

    Route::post('/business-settings/update', [BusinessSettingsController::class, 'update'])->name('business_settings.update');

    // Manage Brochures
    Route::get('/brochures/all', [BrochureController::class, 'allBrochures'])->name('brochures.all');
    Route::get('/brochure/create', [BrochureController::class, 'createBrochure'])->name('brochure.create');
    Route::post('/brochure/store/', [BrochureController::class, 'storeBrochure'])->name('brochure.store');
    Route::get('/brochure/{id}/edit', [BrochureController::class, 'editBrochure'])->name('brochure.edit');
    Route::post('/brochure/update/{id}', [BrochureController::class, 'updateBrochure'])->name('brochure.update');
    Route::post('/brochure/update-status', [BrochureController::class, 'updateBrochureStatus'])->name('brochure.update-status');
    Route::get('/brochure/delete/{id}', [BrochureController::class, 'destroyBrochure'])->name('brochure.delete');

    Route::get('/brochure/files/{brochure_id}', [BrochureController::class, 'allBrochureFiles'])->name('brochure-files.all');
    Route::get('/brochure/files/create/{brochure_id}', [BrochureController::class, 'createBrochureFile'])->name('brochure-files.create');
    Route::post('/brochure/files/update-status', [BrochureController::class, 'updateBrochureFileStatus'])->name('brochure-files.update-status');
    Route::post('/brochure/files/store/', [BrochureController::class, 'storeBrochureFile'])->name('brochure-files.store');
    Route::get('/brochure/files/{id}/edit', [BrochureController::class, 'editBrochureFile'])->name('brochure-files.edit');
    Route::get('/brochure/files/delete/{id}', [BrochureController::class, 'destroyBrochureFile'])->name('brochure-files.delete');
    Route::post('/brochure/files/update/{id}', [BrochureController::class, 'updateBrochureFile'])->name('brochure-files.update');

    // Manage Certificates
    Route::get('/certificates/all', [CertificateController::class, 'allCertificates'])->name('certificates.all');
    Route::get('/certificates/create', [CertificateController::class, 'createCertificate'])->name('certificate.create');
    Route::post('/certificates/store/', [CertificateController::class, 'storeCertificate'])->name('certificate.store');
    Route::get('/certificates/{id}/edit', [CertificateController::class, 'editCertificate'])->name('certificate.edit');
    Route::post('/certificates/update/{id}', [CertificateController::class, 'updateCertificate'])->name('certificate.update');
    Route::post('/certificates/update-status', [CertificateController::class, 'updateCertificateStatus'])->name('certificate.update-status');
    Route::get('/certificates/delete/{id}', [CertificateController::class, 'destroyCertificate'])->name('certificate.delete');

    Route::get('/certificate/sections/all/{id}', [CertificateController::class, 'allCertificateSections'])->name('sections.all');
    Route::get('/certificates/sections/create/{id}', [CertificateController::class, 'createSection'])->name('sections.create');
    Route::post('/certificates/sections/store/', [CertificateController::class, 'storeSection'])->name('sections.store');
    Route::get('/certificates/sections/{id}/edit', [CertificateController::class, 'editSection'])->name('sections.edit');
    Route::post('/certificates/sections/update/{id}', [CertificateController::class, 'updateSection'])->name('sections.update');
    Route::post('/certificates/sections/update-status', [CertificateController::class, 'updateSectionStatus'])->name('sections.update-status');
    Route::get('/certificates/sections/delete/{id}', [CertificateController::class, 'destroySection'])->name('sections.delete');
    
    Route::get('/certificate/files/all/{certificate_id}/{section_id}', [CertificateController::class, 'allCertificateFiles'])->name('certificate-files.all');
    Route::get('/certificate/files/create/{section_id}', [CertificateController::class, 'createCertificateFile'])->name('certificate-files.create');
    Route::post('/certificate/files/store/', [CertificateController::class, 'storeCertificateFile'])->name('certificate-files.store');
    Route::get('/certificate/files/{id}/edit', [CertificateController::class, 'editCertificateFile'])->name('certificate-files.edit');
    Route::post('/certificate/files/update/{id}', [CertificateController::class, 'updateCertificateFile'])->name('certificate-files.update');
    Route::post('/certificate/files/update-status', [CertificateController::class, 'updateCertificateFileStatus'])->name('certificate-files.update-status');
    Route::get('/certificate/files/delete/{id}', [CertificateController::class, 'destroyCertificateFile'])->name('certificate-files.delete');



});