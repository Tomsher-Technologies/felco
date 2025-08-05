<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about_us');
Route::get('/marine', [FrontendController::class, 'marine'])->name('marine');
Route::get('/hvac', [FrontendController::class, 'hvac'])->name('hvac');
Route::get('/oil_gas', [FrontendController::class, 'oilGas'])->name('oil_gas');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');
Route::get('/industries', [FrontendController::class, 'industries'])->name('industries');
Route::get('/industrydetails/{type}', [FrontendController::class, 'industryDetails'])->name('industry.details');
Route::get('/products', [FrontendController::class, 'products'])->name('products');
Route::get('/privacy', [FrontendController::class, 'privacy'])->name('privacy');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact-us', [FrontendController::class, 'submitContactForm'])->name('contact.submit');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/service-support', [FrontendController::class, 'service_support'])->name('service_support');

Route::post('/language_change', [FrontendController::class, 'changeLanguage'])->name('language.change');

Route::get('/category/{category_slug}', [FrontendController::class, 'filterByCategory'])->name('products.category');


Route::get('/product-detail', [FrontendController::class, 'productDetails'])->name('product-detail');
Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/brochures', [FrontendController::class, 'brochures'])->name('brochures');
Route::get('/certificates', [FrontendController::class, 'certificates'])->name('certificates');
Route::get('/manuals', [FrontendController::class, 'manuals'])->name('manuals');
Route::get('/service-after-sales', [FrontendController::class, 'service_sales'])->name('service_sales');






