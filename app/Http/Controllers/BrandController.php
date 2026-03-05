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

<<<<<<< HEAD

    $topManuals = Manual::where('brand_id', $brand->id)
        ->orderBy('manualcounter', 'desc')
        ->take(5)
        ->get();


    $manuals = Manual::where('brand_id', $brand->id)
        ->orderBy('name')
        ->get();
=======
        // Alle manuals van deze brand ophalen
        $manuals = Manual::where('brand_id', $brand->id)
            ->orderBy('name')
            ->get();

        // Voor top 10 of speciale links kun je hier ook top_url toevoegen
        $manuals->map(function($manual) use ($brand) {
            $manual->top_url = route('manual.top', [
                'brand_id' => $brand->id,
                'brand_slug' => $brand->getNameUrlEncodedAttribute(),
                'manual_id' => $manual->id,
            ]);
            return $manual;
        });
>>>>>>> parent of 6a31ee1 (Laravel error oplgelost)

        return view('pages.manual_list', compact('brand', 'manuals'));
    }
}
