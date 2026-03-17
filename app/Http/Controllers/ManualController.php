<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
    public function topManuals()
    {
        $brands = Brand::orderBy('name')->get();


        $topManuals = Manual::with('brand')
            ->orderBy('manualcounter', 'desc')
            ->take(10)
            ->get();

        $topManuals->map(function($manual) {
            $manual->top_url = route('manual.top', [
                'brand_id' => $manual->brand->id,
                'brand_slug' => $manual->brand->getNameUrlEncodedAttribute(),
                'manual_id' => $manual->id,
            ]);
            return $manual;
        });

        return view('pages.manual_list', compact('brands', 'topManuals'));
    }



    public function showTop($brand_id, $brand_slug, $manual_id)
{
    $brand  = Brand::findOrFail($brand_id);
    $manual = Manual::findOrFail($manual_id);

    $manual->increment('manualcounter');
    return view('pages.manual_view', compact('manual', 'brand'));
}

public function show($manual_id)
{
    $manual = Manual::findOrFail($manual_id);
    $brand = $manual->brand;

    $manual->increment('manualcounter');
    return view('pages.manual_view', compact('manual', 'brand'));
}
}
