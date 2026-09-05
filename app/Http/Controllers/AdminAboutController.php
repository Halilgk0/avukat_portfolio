<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display the about section form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // İlk kaydı alıyoruz, yoksa yeni bir kayıt oluşturuyoruz
        $about = AboutSection::firstOrNew(['is_active' => true]);
        
        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the about section.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'lawyer_name' => 'required|string|max:255',
            'lawyer_title' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'certificates' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Mevcut kaydı al veya yeni oluştur
        $about = AboutSection::firstOrNew(['is_active' => true]);
        
        // Form verilerini ekle
        $about->title = $request->title;
        $about->content = $request->content;
        $about->lawyer_name = $request->lawyer_name;
        $about->lawyer_title = $request->lawyer_title;
        $about->experience = $request->experience;
        $about->education = $request->education;
        $about->certificates = $request->certificates;
        $about->is_active = true;

        // Görsel yükleme
        if ($request->hasFile('image')) {
            // Eski görseli sil (varsa)
            if ($about->image) {
                Storage::delete('public/' . $about->image);
            }
            
            // Yeni görseli yükle
            $imagePath = $request->file('image')->store('images/about', 'public');
            $about->image = $imagePath;
        }

        $about->save();
        
        return redirect()->route('admin.about.index')->with('success', 'Hakkımda bölümü başarıyla güncellendi.');
    }
}
