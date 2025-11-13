<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VendorPayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
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

        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalVendorEarnings',
            'totalAdminProfit',
            'monthlyStats',
            'start',
            'end'
        ));
    }
}
