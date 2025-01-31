<?php

namespace App\Http\Controllers;


use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        // Jika pengguna belum login, tampilkan pesan error di halaman
        if (!auth()->check()) {
            return view('studio', [
                'studios' => [], // Kosongkan data studio
                'error' => 'Silakan login untuk mengakses halaman ini.'
            ]);
        }
    
        // Jika login, ambil data studio beserta relasi bookings
        $studios = Studio::with('bookings')->get();
    
        return view('studio', compact('studios'));
    }
    

     
       public function tampiladmin()
       {
           $studios = Studio::all(); // Mengambil semua data studio
           return view('admin.studio', compact('studios')); // Mengirim data ke view
       }

       public function create()
       {
           return view('admin.tambahstudio'); // View untuk form tambah studio
       }


       public function store(Request $request)
       {
           $validated = $request->validate([
               'name' => 'required|string|max:255',
               'description' => 'required|string',
               'facilities' => 'required|string',
               'price_per_hour' => 'required|numeric|min:0',
               'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
           ]);
       
           // Simpan file gambar ke direktori public/uploads
           if ($request->hasFile('image')) {
               $image = $request->file('image');
               $imageName = time() . '_' . $image->getClientOriginalName(); // Buat nama file unik
               $image->move(public_path('uploads'), $imageName); // Simpan ke public/uploads
               $imagePath = 'uploads/' . $imageName; // Path gambar untuk disimpan di database
           } else {
               $imagePath = null; // Jika tidak ada file gambar
           }
       
           // Simpan data studio ke database
           Studio::create([
               'name' => $validated['name'],
               'description' => $validated['description'],
               'facilities' => $validated['facilities'],
               'price_per_hour' => $validated['price_per_hour'],
               'image_path' => $imagePath, // Simpan path gambar di database
           ]);
       
           return redirect('/studio')->with('success', 'Studio berhasil ditambahkan.');
       }
       


public function edit($id)
{
    $studio = Studio::findOrFail($id); // Ambil data studio berdasarkan ID
    return view('admin.editstudio', compact('studio')); // Tampilkan form edit
}

public function update(Request $request, $id)
{
    $studio = Studio::findOrFail($id);

    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'facilities' => 'required|string',
        'price_per_hour' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle update gambar
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($studio->image_path && file_exists(public_path($studio->image_path))) {
            unlink(public_path($studio->image_path));
        }

        // Simpan gambar baru ke folder public/uploads
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads'), $imageName);
        $imagePath = 'uploads/' . $imageName; // Path baru untuk gambar
    } else {
        $imagePath = $studio->image_path; // Tetap gunakan gambar lama
    }

    // Update data studio
    $studio->update([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'facilities' => $validated['facilities'],
        'price_per_hour' => $validated['price_per_hour'],
        'image_path' => $imagePath,
    ]);

    return redirect('/studio')->with('success', 'Studio berhasil diperbarui.');
}


public function destroy($id)
{
    $studio = Studio::findOrFail($id);

    // Hapus file gambar jika ada
    if ($studio->image_path && file_exists(public_path($studio->image_path))) {
        unlink(public_path($studio->image_path)); // Hapus file dari folder public/uploads
    }

    $studio->delete(); // Hapus data studio dari database

    return redirect('/studio')->with('success', 'Studio berhasil dihapus.');
}



    public function book(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'start_time' => 'required|date|after:now|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date|after:start_time|date_format:Y-m-d\TH:i',
        ]);
    
        // Pastikan pengguna sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors('Anda harus login untuk memesan studio.');
        }
    
        // Temukan studio atau gagal
        $studio = Studio::findOrFail($id);
    
        // Cek ketersediaan jadwal
        $conflict = $studio->bookings()->where(function ($query) use ($validated) {
            $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                  ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                  ->orWhere(function ($subQuery) use ($validated) {
                      $subQuery->where('start_time', '<=', $validated['start_time'])
                               ->where('end_time', '>=', $validated['end_time']);
                  });
        })->exists();
    
        if ($conflict) {
            return back()->withErrors('Jadwal bentrok dengan pemesanan lain.');
        }
    
        // Menambahkan user_id ke dalam data yang akan disimpan
        $validated['user_id'] = auth()->id();
    
        // Buat pemesanan
        try {
            $studio->bookings()->create($validated);
            return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors('Terjadi kesalahan saat membuat pemesanan. Silakan coba lagi.');
        }
    }
    
    
}
