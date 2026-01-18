<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Area;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Base query - filter untuk Leader
        $assetQuery = Asset::query();
        if ($user->isLeader() && !$user->isSuperAdmin()) {
            $assetQuery->where('leader_id', $user->id);
        }

        // Statistik Utama
        $stats = [
            'total_assets' => (clone $assetQuery)->count(),
            'available_assets' => (clone $assetQuery)->where('status', 'available')->count(),
            'in_use_assets' => (clone $assetQuery)->where('status', 'in_use')->count(),
            'maintenance_assets' => (clone $assetQuery)->where('status', 'maintenance')->count(),
            'retired_assets' => (clone $assetQuery)->where('status', 'retired')->count(),
            'lost_assets' => (clone $assetQuery)->where('status', 'lost')->count(),
            'used_assets' => (clone $assetQuery)->where('status', 'in_use')->count(),
            'unused_assets' => (clone $assetQuery)->where('status', '!=', 'in_use')->count(),
            'total_categories' => Category::count(),
            'total_locations' => Location::count(),
            'total_areas' => Area::count(),
            'total_employees' => Employee::count(),
        ];

        // Total nilai aset
        $stats['total_value'] = (clone $assetQuery)->sum('purchase_cost') ?? 0;

        // Aset per kategori
        $assetsByCategory = Category::withCount(['assets' => function ($query) use ($user) {
            if ($user->isLeader() && !$user->isSuperAdmin()) {
                $query->where('leader_id', $user->id);
            }
        }])->having('assets_count', '>', 0)->orderByDesc('assets_count')->limit(5)->get();

        // Aset per lokasi
        $assetsByLocation = Location::withCount(['assets' => function ($query) use ($user) {
            if ($user->isLeader() && !$user->isSuperAdmin()) {
                $query->where('leader_id', $user->id);
            }
        }])->having('assets_count', '>', 0)->orderByDesc('assets_count')->limit(5)->get();

        // Aset per status
        $assetsByStatus = (clone $assetQuery)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->mapWithKeys(fn($item) => [$item->status => $item->count]);

        // Aset terbaru
        $recentAssets = (clone $assetQuery)
            ->with(['category', 'location', 'employee'])
            ->latest()
            ->limit(5)
            ->get();

        // Aktivitas terbaru (untuk SuperAdmin)
        $recentActivities = [];
        if ($user->isSuperAdmin()) {
            $recentActivities = ActivityLog::with('user')
                ->latest()
                ->limit(10)
                ->get();
        }

        // Aset yang akan expired warranty (dalam 30 hari)
        $expiringWarranty = (clone $assetQuery)
            ->whereNotNull('warranty_expiry')
            ->whereBetween('warranty_expiry', [now(), now()->addDays(30)])
            ->with(['category', 'location'])
            ->orderBy('warranty_expiry')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'stats',
            'assetsByCategory',
            'assetsByLocation',
            'assetsByStatus',
            'recentAssets',
            'recentActivities',
            'expiringWarranty'
        ));
    }
}
