<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarController extends Controller
{
    public function index() {
        $data = Gambar::all();
        return view('admin.gambar.index', compact('data'));
    }
    public function tambah() {
        return view('admin.gambar.tambah');
    }
    public function create(Request $request) {
        // Validasi input
        //dd($request->all(), $request->file('file'));

        $validated = $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png',
            'caption' => 'nullable|string|max:255',
        ]);

        // Simpan file ke penyimpanan
        if ($request->hasFile('file')) {

            $gambar = $request->file('file');
            $hash = $gambar->hashName();
            $gambar->storeAs('gambar',$hash, 'public');

            // Simpan ke database
            Gambar::create([
                'path' => $hash,
                'caption' => $request->caption,
                'ditampilkan' => $request->has('ditampilkan') ? true : false,
            ]);

            return redirect()->route('gambar.index')->with('success', 'Gambar berhasil diunggah.');
        }

        return back()->withErrors(['file' => 'File gagal diunggah.']);
    }
    public function edit($id) {
        $gambar = Gambar::whereId($id)->first();
        return view('admin.gambar.edit', compact('gambar'));
    }
    public function update(Request $request, $id)
    {
        $gambar = Gambar::findOrFail($id);

        $request->validate([
            'caption' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete('gambar/' . $gambar->path);

            // Buat nama hash
            $hash = $request->file('file')->hashName();

            // Simpan file baru ke folder 'gambar' di disk public
            $request->file('file')->storeAs('gambar', $hash, 'public');

            // Simpan nama file di DB
            $gambar->path = $hash;
        }

        $gambar->caption = $request->caption;
        $gambar->ditampilkan = $request->has('ditampilkan') ? 1 : 0;
        $gambar->save();

        return redirect()->route('gambar.index')->with('success', 'Gambar berhasil diperbarui.');
    }
    public function hapus($id) {
        $gambar = Gambar::findOrFail($id);

        // Hapus file dari storage jika ada
        if ($gambar->path && Storage::exists('public/gambar/' . $gambar->path)) {
            Storage::delete('public/gambar/' . $gambar->path);
        }

        // Hapus dari database
        $gambar->delete();

        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
