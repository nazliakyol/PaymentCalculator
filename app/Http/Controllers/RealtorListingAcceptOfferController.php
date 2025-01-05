<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        // Accept selected offer
        $offer->update([
            'accepted_at' => now(),
        ]);

        // Reject all the other offers
        // cannot call the scopeExcept (look at Offer model!)
        $offer->listing->offers()
            ->where('id', '!=', $offer->id)
            ->update([
                'rejected_at' => now(),
            ]);

        return redirect()->back()->with('success', "Offer #{$offer->id} accepted, other offers rejected.");
    }
}
