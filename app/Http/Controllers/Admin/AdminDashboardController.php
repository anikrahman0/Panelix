<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;

class AdminDashboardController extends Controller
{
    protected $dashboardService;
    public function __construct(DashboardService $dashboardService) {
        $this->dashboardService = $dashboardService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->dashboardService->getDashboardData();
        return view('layouts.admin.dashboard.index', $data);
    }
}
