<?php

namespace App\Http\Controllers\PemberiKerja;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService) {}

    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $data = $this->dashboardService->untukPemberiKerja($user);

        return view('pemberi-kerja.dashboard.index', $data);
    }
}
