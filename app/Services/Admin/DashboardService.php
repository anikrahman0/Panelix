<?php
namespace App\Services\Admin;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getDashboardData()
    {
        $data['latest_orders'] = Order::latest()->with('user')->take(5)->get();
        $data['total_orders'] = Order::count();
        $data['pending_orders'] = Order::where('order_status', 1)->count();
        $data['total_revenue'] = Order::where('payment_status', 2)->sum('total');
        $data['total_books'] = Book::count();
        // Monthly sales data
        $monthlySales = Order::select(
            DB::raw("MONTH(created_at) as month"),
            DB::raw("SUM(total) as total")
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->pluck('total', 'month')
            ->toArray();

        // Initialize all 12 months with 0
        $salesByMonth = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesByMonth[] = isset($monthlySales[$i]) ? (float)$monthlySales[$i] : 0;
        }

        $data['monthly_sales'] = $salesByMonth;
        return $data;
    }
}