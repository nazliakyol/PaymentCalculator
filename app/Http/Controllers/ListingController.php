<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Li;

class ListingController extends Controller
{

//    public function __construct()
//    {
        //    an alternative to specifying the routes that is the auth middleware has not applied -if you don't want to apply them in the web.php-
//        $this->middleware('auth')->except(['index', 'show']);

//        $this->authorizeResource(Listing::class, 'listing');    }
//    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('Listing/Index',
            [
                'listings' => Listing::orderByDesc('created_at')->paginate(10)->withQueryString(),
                'filters' => $request->only(
                    [ 'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']
                ),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Listing/Create',
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:0|max:1000',
                'city' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'street-nr' => 'required|string|max:255',
                'price' => 'required|integer|min:0|max:10000000',
            ])
        );
        return redirect()->route('listing.index')->with('success', 'Listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
//        if (Auth::user()->cannot("view", $listing)) {
//            abort(403);
//        }

//        $this->authorize('view', $listing);
        return inertia('Listing/Show',
            [
                'listing' => $listing,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia('Listing/Edit',
            [
                'listing' => $listing,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:0|max:1000',
                'city' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'street' => 'required|string|max:255',
                'street-nr' => 'required|string|max:255',
                'price' => 'required|integer|min:0|max:10000000',
            ])
        );
        return redirect()
            ->route('listing.index')
            ->with('success', 'Listing edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()
            ->back()
            ->with('success', 'Listing deleted successfully.');
    }
}
