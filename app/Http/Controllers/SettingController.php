<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'app_name' => Setting::get('app_name', 'Assets Management'),
            'app_description' => Setting::get('app_description', 'Sistem Manajemen Aset'),
            'base_url' => Setting::get('base_url', config('app.url')),
            'company_name' => Setting::get('company_name', ''),
            'company_address' => Setting::get('company_address', ''),
            'company_phone' => Setting::get('company_phone', ''),
            'company_email' => Setting::get('company_email', ''),
            'logo' => Setting::get('logo', ''),
            'icon' => Setting::get('icon', ''),
            'primary_color' => Setting::get('primary_color', '#3B82F6'),
        ];

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string|max:500',
            'base_url' => 'nullable|url',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:500',
            'company_phone' => 'nullable|string|max:50',
            'company_email' => 'nullable|email|max:255',
            'primary_color' => 'nullable|string|max:20',
            'logo' => 'nullable|image|max:2048',
            'icon' => 'nullable|image|max:1024',
        ]);

        foreach (['app_name', 'app_description', 'base_url', 'company_name', 'company_address', 'company_phone', 'company_email', 'primary_color'] as $key) {
            if (isset($validated[$key])) {
                Setting::set($key, $validated[$key], 'text', 'general');
            }
        }

        if ($request->hasFile('logo')) {
            $oldLogo = Setting::get('logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::set('logo', $logoPath, 'file', 'general');
        }

        if ($request->hasFile('icon')) {
            $oldIcon = Setting::get('icon');
            if ($oldIcon && Storage::disk('public')->exists($oldIcon)) {
                Storage::disk('public')->delete($oldIcon);
            }
            $iconPath = $request->file('icon')->store('settings', 'public');
            Setting::set('icon', $iconPath, 'file', 'general');
        }

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}
