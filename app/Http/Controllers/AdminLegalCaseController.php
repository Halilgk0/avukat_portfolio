<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminLegalCaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cases = LegalCase::latest()->paginate(10);
        return view('admin.legal-cases.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.legal-cases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:ongoing,won,lost,settled',
            'case_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,jpg|max:2048',
        ]);

        $slug = Str::slug($request->title);
        
        // Slug'ı benzersiz yap
        $count = 1;
        $originalSlug = $slug;
        while (LegalCase::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Dosya adını benzersiz bir isimle kaydedelim
            $imageName = $slug . '-' . time() . '.' . $request->image->extension();
            // İmajı public/images/cases dizinine yükleyelim
            $request->image->move(public_path('images/cases'), $imageName);
            $imagePath = 'images/cases/' . $imageName;
        }

        LegalCase::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'content' => $request->content,
            'category' => $request->category,
            'status' => $request->status,
            'case_date' => $request->case_date,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.legal-cases.index')->with('success', 'Dava dosyası başarıyla oluşturuldu.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LegalCase $legalCase)
    {
        return view('admin.legal-cases.show', compact('legalCase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LegalCase $legalCase)
    {
        return view('admin.legal-cases.edit', compact('legalCase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LegalCase $legalCase)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:ongoing,won,lost,settled',
            'case_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,jpg|max:2048',
        ]);

        // Başlık değiştiyse slug'ı da güncelle
        if ($request->title != $legalCase->title) {
            $slug = Str::slug($request->title);
            
            // Slug'ı benzersiz yap
            $count = 1;
            $originalSlug = $slug;
            while (LegalCase::where('slug', $slug)->where('id', '!=', $legalCase->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            
            $legalCase->slug = $slug;
        }

        $legalCase->title = $request->title;
        $legalCase->description = $request->description;
        $legalCase->content = $request->content;
        $legalCase->category = $request->category;
        $legalCase->status = $request->status;
        $legalCase->case_date = $request->case_date;
        
        // Dosya yükleme işlemi
        if ($request->hasFile('image')) {
            // Eski resmi siliyoruz, eğer varsa
            if ($legalCase->image && file_exists(public_path($legalCase->image))) {
                unlink(public_path($legalCase->image));
            }
            
            // Yeni resmi yüklüyoruz
            $imageName = $legalCase->slug . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/cases'), $imageName);
            $legalCase->image = 'images/cases/' . $imageName;
        }
        
        $legalCase->save();

        return redirect()->route('admin.legal-cases.index')->with('success', 'Dava dosyası başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LegalCase $legalCase)
    {
        $legalCase->delete();
        return redirect()->route('admin.legal-cases.index')->with('success', 'Dava dosyası başarıyla silindi.');
    }
}
