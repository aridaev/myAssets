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

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $query = Asset::with(['category', 'area', 'location', 'employee', 'leader']);

        // Filter berdasarkan role - Leader hanya bisa lihat aset yang dia tangani
        if (Auth::user()->isLeader() && !Auth::user()->isSuperAdmin()) {
            $query->where('leader_id', Auth::id());
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('asset_tag', 'like', "%{$search}%")
                  ->orWhere('model_name', 'like', "%{$search}%")
                  ->orWhere('manufacturer', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('is_used')) {
            $query->where('is_used', $request->is_used === '1');
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        $assets = $query->latest()->paginate(15);
        $categories = Category::active()->get();
        $locations = Location::active()->get();

        return view('assets.index', compact('assets', 'categories', 'locations'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        $areas = Area::active()->get();
        $locations = Location::active()->get();
        $employees = Employee::active()->get();
        $leaders = User::leaders()->get();

        return view('assets.create', compact('categories', 'areas', 'locations', 'employees', 'leaders'));
    }

    public function store(Request $request)
    {
        // Check if batch mode
        if ($request->input('batch_mode') === '1' && $request->has('assets')) {
            return $this->storeBatch($request);
        }

        $validated = $request->validate([
            'model_number' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'model_name' => 'nullable|string|max:255',
            'model_description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'location_id' => 'nullable|exists:locations,id',
            'employee_id' => 'nullable|exists:employees,id',
            'leader_id' => 'nullable|exists:users,id',
            'serial_number' => 'nullable|string|max:255',
            'status' => 'nullable|in:available,in_use,maintenance,retired,lost',
            'notes' => 'nullable|string',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['status'] = $validated['status'] ?? 'in_use';

        // Jika user adalah Leader, otomatis set leader_id ke dirinya sendiri
        if (Auth::user()->isLeader() && !Auth::user()->isSuperAdmin()) {
            $validated['leader_id'] = Auth::id();
        }

        $asset = Asset::create($validated);

        // Log aktivitas
        ActivityLog::log('created', $asset, null, $validated, "Menambahkan aset baru: {$asset->asset_tag}");

        return redirect()->route('assets.index')->with('success', 'Asset berhasil ditambahkan.');
    }

    protected function storeBatch(Request $request)
    {
        $request->validate([
            'assets' => 'required|array|min:1',
            'assets.*.category_id' => 'nullable|exists:categories,id',
            'assets.*.area_id' => 'nullable|exists:areas,id',
            'assets.*.location_id' => 'nullable|exists:locations,id',
            'assets.*.employee_id' => 'nullable|exists:employees,id',
            'assets.*.leader_id' => 'nullable|exists:users,id',
            'assets.*.manufacturer' => 'nullable|string|max:255',
            'assets.*.model_name' => 'nullable|string|max:255',
            'assets.*.model_number' => 'nullable|string|max:255',
            'assets.*.serial_number' => 'nullable|string|max:255',
            'assets.*.notes' => 'nullable|string',
        ]);

        $assets = $request->input('assets');
        $createdCount = 0;

        foreach ($assets as $assetData) {
            // Skip empty rows
            if (empty($assetData['category_id']) && empty($assetData['manufacturer']) && empty($assetData['model_name'])) {
                continue;
            }

            $assetData['created_by'] = Auth::id();
            $assetData['status'] = 'in_use';

            // Jika user adalah Leader, otomatis set leader_id ke dirinya sendiri
            if (Auth::user()->isLeader() && !Auth::user()->isSuperAdmin()) {
                $assetData['leader_id'] = Auth::id();
            }

            $asset = Asset::create($assetData);

            // Log aktivitas
            ActivityLog::log('created', $asset, null, $assetData, "Menambahkan aset baru: {$asset->asset_tag}");
            $createdCount++;
        }

        return redirect()->route('assets.index')->with('success', "{$createdCount} aset berhasil ditambahkan.");
    }

    public function show(Asset $asset)
    {
        // Cek akses untuk Leader
        if (Auth::user()->isLeader() && !Auth::user()->isSuperAdmin() && $asset->leader_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke aset ini.');
        }

        $asset->load(['category', 'area', 'location', 'employee', 'creator', 'updater', 'leader']);
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        // Cek akses untuk Leader
        if (Auth::user()->isLeader() && !Auth::user()->isSuperAdmin() && $asset->leader_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke aset ini.');
        }

        $categories = Category::active()->get();
        $areas = Area::active()->get();
        $locations = Location::active()->get();
        $employees = Employee::active()->get();
        $leaders = User::leaders()->get();

        return view('assets.edit', compact('asset', 'categories', 'areas', 'locations', 'employees', 'leaders'));
    }

    public function update(Request $request, Asset $asset)
    {
        // Cek akses untuk Leader
        if (Auth::user()->isLeader() && !Auth::user()->isSuperAdmin() && $asset->leader_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke aset ini.');
        }

        $oldValues = $asset->toArray();
        $oldEmployeeId = $asset->employee_id;

        $validated = $request->validate([
            'model_number' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'model_name' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'location_id' => 'nullable|exists:locations,id',
            'employee_id' => 'nullable|exists:employees,id',
            'leader_id' => 'nullable|exists:users,id',
            'serial_number' => 'nullable|string|max:255',
            'status' => 'required|in:available,in_use,maintenance,retired,lost',
            'notes' => 'nullable|string',
        ]);

        $validated['updated_by'] = Auth::id();

        $asset->update($validated);

        // Log aktivitas - cek jika ada pindah tangan
        if ($oldEmployeeId != $validated['employee_id']) {
            ActivityLog::log('transferred', $asset, $oldValues, $validated, "Memindahkan aset {$asset->asset_tag} ke karyawan lain");
        } else {
            ActivityLog::log('updated', $asset, $oldValues, $validated, "Mengubah aset: {$asset->asset_tag}");
        }

        return redirect()->route('assets.index')->with('success', 'Asset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        // Cek akses untuk Leader
        if (Auth::user()->isLeader() && !Auth::user()->isSuperAdmin() && $asset->leader_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke aset ini.');
        }

        $oldValues = $asset->toArray();
        ActivityLog::log('deleted', $asset, $oldValues, null, "Menghapus aset: {$asset->asset_tag}");

        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset berhasil dihapus.');
    }

    public function publicView(string $slug)
    {
        $asset = Asset::where('permalink_slug', $slug)
            ->with(['category', 'area', 'location', 'employee'])
            ->firstOrFail();

        return view('assets.public', compact('asset'));
    }
}
