<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
//        dd(\Auth::user());
//        dd(\Auth::check());
        Listing::make([
            'beds' => 3,
            'baths' => 2,
            'area' => 120,
            'city' => 'New York',
            'code' => '10001',
            'street' => 'Broadway',
            'street_nr' => '1',
            'price' => 1000000,
        ]);

        return inertia('Index/Index',
        [
            'message' => 'Hello, from here!'
        ]);
    }

    public function show()
    {
        return inertia('Index/Show');
    }
}
