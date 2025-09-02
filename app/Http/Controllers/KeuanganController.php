<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $bt = $request->input('filter'); // format: "YYYY-MM"

        try {
            if ($bt) {
                $parsedDate = Carbon::createFromFormat('Y-m', $bt);
            } else {
                $parsedDate = Carbon::now();
            }

            // Hitung saldo awal sebelum bulan ini
            $saldoAwal = Keuangan::whereDate('tanggal', '<', $parsedDate->copy()->startOfMonth())
                ->get()
                ->reduce(function ($carry, $item) {
                    return $carry + ($item->tipe === 'pemasukan' ? $item->saldo : -$item->saldo);
                }, 0);

            // Ambil data untuk bulan yang dipilih
            $data = Keuangan::whereYear('tanggal', $parsedDate->year)
                ->whereMonth('tanggal', $parsedDate->month)
                ->get();

            $totalSaldo = $saldoAwal;

            $data->transform(function ($item) use (&$totalSaldo) {
                if ($item->tipe === 'pemasukan') {
                    $totalSaldo += $item->saldo;
                } elseif ($item->tipe === 'pengeluaran') {
                    $totalSaldo -= $item->saldo;
                }

                $item->total_saldo = $totalSaldo;
                return $item;
            });

        } catch (\Exception $e) {
            return back()->withErrors(['filter' => 'Format tanggal tidak valid.']);
        }

        return view('admin.keuangan.index', compact(['data', 'saldoAwal']));
    }


    public function tambah() {
        return view('admin.keuangan.tambah');
    }

    public function create(Request $request) {

        Keuangan::create([
            'tanggal' => $request->tanggal,
            'tipe' => $request->tipe,
            'keterangan' => $request->keterangan,
            'saldo' => $request->saldo,
        ]);

        return redirect()->route('keuangan.index')->with('success','Data Berhasil Ditambah');
    }

    public function edit($id) {
        $data = Keuangan::whereId($id)->first();
        return view('admin.keuangan.edit', compact(['data']));
    }

    public function update($id, Request $request) {

        Keuangan::whereId($id)->update([
            'tanggal' => $request->tanggal,
            'tipe' => $request->tipe,
            'keterangan' => $request->keterangan,
            'saldo' => $request->saldo,
        ]);

        return redirect()->route('keuangan.index')->with('success','Data Berhasil Diupdate');
    }
    public function hapus($id) {
        Keuangan::whereId($id)->delete();
        return redirect()->route('keuangan.index')->with('success','Data Berhasil Dihapus');
    }
}
