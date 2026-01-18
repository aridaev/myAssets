<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Location;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('location')->withCount('assets')->latest()->paginate(15);
        return view('master.areas.index', compact('areas'));
    }

    public function create()
    {
        $locations = Location::active()->get();
        return view('master.areas.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255|unique:areas',
            'location_id' => 'nullable|exists:locations,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Area::create($validated);

        return redirect()->route('areas.index')->with('success', 'Area berhasil ditambahkan.');
    }

    public function edit(Area $area)
    {
        $locations = Location::active()->get();
        return view('master.areas.edit', compact('area', 'locations'));
    }

    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:255|unique:areas,code,' . $area->id,
            'location_id' => 'nullable|exists:locations,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $area->update($validated);

        return redirect()->route('areas.index')->with('success', 'Area berhasil diperbarui.');
    }

    public function destroy(Area $area)
    {
        if ($area->assets()->count() > 0) {
            return redirect()->route('areas.index')->with('error', 'Area tidak dapat dihapus karena masih memiliki aset.');
        }

        $area->delete();
        return redirect()->route('areas.index')->with('success', 'Area berhasil dihapus.');
    }

    public function getByLocation(Location $location)
    {
        $areas = $location->areas()->active()->get(['id', 'name', 'code']);
        return response()->json($areas);
    }
}
