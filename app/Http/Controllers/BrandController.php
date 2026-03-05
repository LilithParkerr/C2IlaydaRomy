<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class BrandController extends Controller
{
   public function show($brand_id, $brand_slug)
{
    $brand = Brand::findOrFail($brand_id);

    // Top 5 populairste manuals van dit merk
    $topManuals = Manual::where('brand_id', $brand->id)
        ->orderBy('manualcounter', 'desc')
        ->take(5)
        ->get();

    // Alle manuals van dit merk
    $manuals = Manual::where('brand_id', $brand->id)
        ->orderBy('name')
        ->get();

          foreach ($manuals as $manual) {
            $manual->increment('manualcounter');
        }
    return view('pages.manual_list', compact('brand', 'manuals', 'topManuals'));
}
}
