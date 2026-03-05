<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
    /**
     * Homepage / Top 10 manuals
     */
    public function topManuals()
    {
        // Alle brands ophalen
        $brands = Brand::orderBy('name')->get();

        // Top 10 populaire handleidingen ophalen (zonder type)
        $topManuals = Manual::with('brand')
            ->orderBy('manualcounter', 'desc')
            ->take(10)
            ->get();

        // Voor elke top manual de URL genereren via route 'manual.top'
        $topManuals->map(function($manual) {
            $manual->top_url = route('manual.top', [
                'brand_id' => $manual->brand->id,
                'brand_slug' => $manual->brand->getNameUrlEncodedAttribute(),
                'manual_id' => $manual->id,
            ]);
            return $manual;
        });

        // Blade view voor homepage/top 10
        return view('pages.manual_list', compact('brands', 'topManuals'));
    }

    /**
     * Top 10 manual detail page (zonder type)
     */
    public function showTopManual($brand_id, $brand_slug, $manual_id)
    {
        $manual = Manual::with('brand')->findOrFail($manual_id);
        $brand = $manual->brand;

        // Blade view voor detailpagina
        return view('pages.manual_view', compact('manual', 'brand'));
    }

    /**
     * Bestaande manual detail pagina (met type_id/type_slug in URL)
     */
    public function show($brand_id, $brand_slug, $type_id, $type_slug, $manual_id)
    {
        $manual = Manual::with('brand')->findOrFail($manual_id);
        $brand = $manual->brand;

        return view('pages.manual_view', compact('manual', 'brand'));
    }
}
