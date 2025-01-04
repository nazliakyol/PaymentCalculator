<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function __construct()
    {
//        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted') ,
            ...$request->only(
                [ 'by', 'order']
            )

        ];

        return inertia('Realtor/Index', [
            'filters' => $filters,
            'listings' => Auth::user()
                ->listings()
                ->filter($filters)
                ->withCount('images')
                ->paginate(5)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Realtor/Create',
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
        return redirect()->route('realtor.listing.index')->with('success', 'Listing created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia('Realtor/Edit',
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
            ->route('realtor.listing.index')
            ->with('success', 'Listing edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();
        return redirect()
            ->back()
            ->with('success', 'Listing deleted successfully.');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()
            ->back()
            ->with('success', 'Listing restored successfully.');
    }
}
