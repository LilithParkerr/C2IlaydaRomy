<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manual;

class HomeController extends Controller
{
    public function home()
    {
        // Alle brands ophalen
        $brands = Brand::orderBy('name')->get();

        // Top 10 populaire handleidingen ophalen
        $topManuals = Manual::with('brand')
            ->orderBy('manualcounter', 'desc') // bijvoorbeeld op populariteit
            ->take(10)
            ->get();

        // View renderen en variabelen meegeven
        return view('pages.home', [
            'brands' => $brands,
            'topManuals' => $topManuals,
        ]);
    }
}
