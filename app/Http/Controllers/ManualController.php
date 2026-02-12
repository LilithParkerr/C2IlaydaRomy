<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class ManualController extends Controller
{
public function show($brand_id, $brand_slug, $type_id, $type_slug, $manual_id)
{
    $brand = Brand::findOrFail($brand_id);
    $manual = Manual::findOrFail($manual_id);

    // Teller +1
    $manual->increment('manualcounter');
    $manual->save();

    return view('pages.manual_view', [
        'manual' => $manual,
        'brand' => $brand,
    ]);
}


}
