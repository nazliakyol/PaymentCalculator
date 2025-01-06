<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Li;



class ListingController extends Controller
{

    public function __construct()
    {
//            an alternative to specifying the routes that is the auth middleware has not applied -if you don't want to apply them in the web.php-
//        $this->middleware('auth')->except(['index', 'show']);

//        $this->authorizeResource(Listing::class, 'listing');

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(
            [ 'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']
        );


        //this didnt work
//        $query = Listing::mostRecent()
//            ->filter($filters)
//            ->paginate(10)
//            ->withQueryString();

        $query = Listing::orderByDesc('created_at')
            ->when(
            $filters['priceFrom'] ?? false,
            fn($query, $value) => $query->where('price', '>=', $value)
        )
        ->when(
            $filters['priceTo'] ?? false,
            fn($query, $value) => $query->where('price', '<=', $value)
        )
        ->when(
            $filters['areaFrom'] ?? false,
            fn($query, $value) => $query->where('area', '>=', $value)
        )
        ->when(
            $filters['areaTo'] ?? false,
            fn($query, $value) => $query->where('area', '<=', $value)
        )
        ->when(
            $filters['beds'] ?? false,
            fn($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', (int)$value)
        )
        ->when(
            $filters['baths'] ?? false,
            fn($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', (int)$value)
        )
            ->paginate(10)
            ->withQueryString();

        return inertia('Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->filter($filters)
                    ->withoutSold()
                    ->paginate(10)
                    ->withQueryString(),
            ]);
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

        $listing->load(['images']);

        // created a scope for this but it is not working: $listing->offers()->byMe()->first()
        $offer = !Auth::user() ? null : $listing->offers()->where('by_user_id', Auth::user()->id)->first();

        return inertia('Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer,
            ]);
    }
}
