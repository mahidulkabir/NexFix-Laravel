<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VendorPayout;
use Illuminate\Http\Request;

class AdminPayoutController extends Controller
{
    /**
     * Show all payouts (pending + paid)
     */
    public function index()
    {
        $payouts = VendorPayout::with(['vendor', 'booking'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.payouts.index', compact('payouts'));
    }

    /**
     * Mark payout as paid
     */
    public function markAsPaid($id)
    {
        $payout = VendorPayout::findOrFail($id);
        $payout->update(['status' => 'paid']);

        return redirect()->back()->with('success', 'Payout marked as paid successfully.');
    }
}
