@extends('layouts.admin_Home_page')


@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Profit & Revenue Report</h2>
        <form class="d-flex gap-2" method="GET" action="{{ route('admin.reports.index') }}">
            <input type="date" name="start_date" class="form-control" value="{{ $start }}">
            <input type="date" name="end_date" class="form-control" value="{{ $end }}">
            <button type="submit" class="btn btn-primary">Filter</button>
            @if($start || $end)
                <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 bg-light">
                <div class="card-body text-center py-4">
                    <h6 class="text-muted mb-2">Total Revenue</h6>
                    <h3 class="fw-bold text-primary">${{ number_format($totalRevenue, 2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 bg-light">
                <div class="card-body text-center py-4">
                    <h6 class="text-muted mb-2">Total Vendor Earnings</h6>
                    <h3 class="fw-bold text-success">${{ number_format($totalVendorEarnings, 2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 bg-light">
                <div class="card-body text-center py-4">
                    <h6 class="text-muted mb-2">Admin Profit</h6>
                    <h3 class="fw-bold text-danger">${{ number_format($totalAdminProfit, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="card shadow-sm rounded-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">Monthly Overview</h5>
            <canvas id="profitChart" height="120"></canvas>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="card shadow-sm rounded-4 mt-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-3">Monthly Breakdown</h5>
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Month</th>
                        <th>Total Revenue</th>
                        <th>Vendor Earnings</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlyStats as $stat)
                        <tr>
                            <td>{{ \Carbon\Carbon::create()->month($stat->month)->format('F') }}</td>
                            <td>${{ number_format($stat->total_revenue, 2) }}</td>
                            <td>${{ number_format($stat->vendor_earning, 2) }}</td>
                            <td class="fw-semibold text-danger">${{ number_format($stat->profit, 2) }}</td>
                        </tr>
                    @endforeach
                    @if($monthlyStats->isEmpty())
                        <tr><td colspan="4" class="text-center text-muted">No data available.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('profitChart');
    const months = @json($monthlyStats->pluck('month')->map(fn($m) => \Carbon\Carbon::create()->month($m)->format('M')));
    const revenue = @json($monthlyStats->pluck('total_revenue'));
    const vendor = @json($monthlyStats->pluck('vendor_earning'));
    const profit = @json($monthlyStats->pluck('profit'));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Revenue',
                    data: revenue,
                    borderColor: '#0d6efd',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Vendor Earnings',
                    data: vendor,
                    borderColor: '#198754',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Admin Profit',
                    data: profit,
                    borderColor: '#dc3545',
                    fill: false,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>
@endsection
