<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = Pengumuman::orderByDesc('ditampilkan')->get();
        return view('admin.pengumuman.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pengumuman.tambah');
    }

    public function insert(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['ditampilkan'] = $request->has('ditampilkan');
        
        if ($request->has('ditampilkan')) {
            Pengumuman::where('ditampilkan', 1)->update(['ditampilkan' => 0]);
        }

        Pengumuman::create($validated);

        return redirect()->route('pengumuman.index')->with('success', 'Data Berhasil Dibuat');
    }

    public function edit(Pengumuman $data)
    {
        return view('admin.pengumuman.edit', compact('data'));
    }

    public function update(Request $request, Pengumuman $data)
    {
        $validated = $this->validateData($request);
        $validated['ditampilkan'] = $request->has('ditampilkan');

        if ($request->has('ditampilkan')) {
            Pengumuman::where('ditampilkan', 1)->update(['ditampilkan' => 0]);
        }

        $data->update($validated);

        return redirect()->route('pengumuman.index')->with('success', 'Data Berhasil Diganti');
    }

    public function delete(Pengumuman $data)
    {
        $data->ditampilkan == 1 ? Pengumuman::first()->update(['ditampilkan' => 1]) : '';
        $data->delete();
        return redirect()->route('pengumuman.index')->with('success', 'Data Berhasil Dihapus');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'isi_pengumuman' => 'required|string|max:500',
            'ditampilkan' => 'sometimes|accepted',
        ]);
    }
}
