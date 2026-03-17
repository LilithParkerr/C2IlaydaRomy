<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Models\Brand;
use App\Models\Manual;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\LocaleController;

// Homepage
Route::get('/', function () {
    $brands = Brand::all()->sortBy('name');

    $topManuals = Manual::with('brand')
        ->orderBy('manualcounter', 'desc')
        ->take(10)
        ->get();

    return view('pages.homepage', compact('brands', 'topManuals'));
})->name('home');

Route::get('/manual/{language}/{brand_slug}/', [RedirectController::class, 'brand']);
Route::get('/manual/{language}/{brand_slug}/brand.html', [RedirectController::class, 'brand']);
Route::get('/datafeeds/{brand_slug}.xml', [RedirectController::class, 'datafeed']);
Route::get('/language/{language_slug}/', [LocaleController::class, 'changeLocale']);

Route::get(
    '/manual/{manual_id}',
    [ManualController::class, 'show']
)->name('manual.show');
Route::get(
    '/{brand_id}/{brand_slug}/',
    [BrandController::class, 'show']
)->name('brand.show');

Route::get(
    '/{brand_id}/{brand_slug}/{manual_id}',
    [ManualController::class, 'showTop']
)->name('manual.top');





Route::get('/generateSitemap/', [SitemapController::class, 'generate']);

// Contact
Route::get('/contact', [FormController::class, 'showForm'])
    ->name('contact');
Route::post('/contact', [FormController::class, 'submitForm'])
    ->name('contact.submit');
