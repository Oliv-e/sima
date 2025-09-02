<?php

namespace App\Http\Controllers;

use App\Models\JadwalSholat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Imports\JadwalSholatImport;
use Maatwebsite\Excel\Facades\Excel;

class JadwalSholatController extends Controller
{
    public function index(Request $request)
    {
        $bt = $request->input('filter'); // format: "YYYY-MM"

        try {
            if ($bt) {
                // Jika ada filter, gunakan bulan dan tahun dari input
                $parsedDate = Carbon::createFromFormat('Y-m', $bt);
            } else {
                // Jika tidak ada filter, gunakan bulan dan tahun saat ini
                $parsedDate = Carbon::now();
            }

            $data = JadwalSholat::whereYear('tanggal', $parsedDate->year)
                ->whereMonth('tanggal', $parsedDate->month)
                ->get();

        } catch (\Exception $e) {
            return back()->withErrors(['filter' => 'Format tanggal tidak valid.']);
        }

        return view('admin.jadwal_sholat.index', compact('data', 'bt'));
    }

    public function tambah() {
        return view('admin.jadwal_sholat.tambah');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new JadwalSholatImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimport.');
    }
    public function edit($id)
    {
        $data = JadwalSholat::whereId($id)->first();
        if ($data == null) {
            return redirect()->back()->with('error', 'data tidak ditemukan');
        }
        return view('admin.jadwal_sholat.edit', compact('data'));
    }
    public function update(Request $request)
    {
        JadwalSholat::whereId($request->id)->update([
            'imsak' => $request->imsak,
            'subuh' => $request->subuh,
            'terbit' => $request->terbit,
            'dhuha' => $request->dhuha,
            'dzuhur' => $request->dzuhur,
            'ashar' => $request->ashar,
            'maghrib' => $request->maghrib,
            'isya' => $request->isya,
        ]);
        return redirect()->back()->with('success', 'Data Berhasil Diperbarui');
    }
}
