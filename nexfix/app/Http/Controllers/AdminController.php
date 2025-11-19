<?php

namespace App\Http\Controllers;

use App\Models\VendorPayout;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
 public function index(Request $request)
    {
        // Optional date filters
        $start = $request->start_date;
        $end = $request->end_date;

        $query = VendorPayout::query();

        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }

        // Summary totals
        $totalRevenue = $query->sum('total_amount');
        $totalVendorEarnings = $query->sum('vendor_earning');
        $totalAdminProfit = $query->sum('commission_amount');

        // Monthly report for charts
        $monthlyStats = VendorPayout::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as total_revenue'),
                DB::raw('SUM(vendor_earning) as vendor_earning'),
                DB::raw('SUM(commission_amount) as profit')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return view('dashboard.admin', compact(
            'totalRevenue',
            'totalVendorEarnings',
            'totalAdminProfit',
            'monthlyStats',
            'start',
            'end'
        ));
    }

}
