<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display the site settings form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'Avukat Sitesi'),
            'site_logo' => Setting::get('site_logo'),
        ];
        
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the site settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Update site name
        Setting::set('site_name', $validated['site_name'], 'site', 'text', 'Site adı');
        
        // Handle logo upload if present
        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            
            // Store new logo
            $path = $request->file('site_logo')->store('logos', 'public');
            Setting::set('site_logo', $path, 'site', 'image', 'Site logosu');
        }
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Site ayarları başarıyla güncellendi.');
    }

    /**
     * Remove the site logo.
     *
     * @return \Illuminate\Http\Response
     */
    public function removeLogo()
    {
        $logo = Setting::get('site_logo');
        
        if ($logo && Storage::disk('public')->exists($logo)) {
            Storage::disk('public')->delete($logo);
        }
        
        Setting::set('site_logo', null, 'site', 'image', 'Site logosu');
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Logo başarıyla kaldırıldı.');
    }
}
