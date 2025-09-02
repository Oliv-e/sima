<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Gambar;
use App\Models\JadwalSholat;
use App\Models\Keuangan;
use App\Models\Konfig;
use App\Models\Pengumuman;
use App\Models\PetugasIdulAdha;
use App\Models\PetugasIdulFitri;
use App\Models\PetugasJumat;
use App\Models\PetugasTarawih;
use App\Models\Quotes;
use biladina\hijridatetime\HijriDateTime;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index() {
        // HIJRI
        try {
            $hijri = new HijriDateTime();
            $hijriDate = $hijri->date("l, d F Y", now()->timestamp);
        } catch (\Throwable $th) {
            $hijriDate = "Tanggal Hari ini Gagal Dimuat";
        }
        // GET PRAY SCHEDULE
        $today = JadwalSholat::where('tanggal', Carbon::now()->translatedFormat('Y-m-d'))->first();
        $tomorrow = JadwalSholat::where('tanggal', Carbon::now()->addDay()->translatedFormat('Y-m-d'))->first();
        // GET QUOTES
        $quote = Quotes::where('ditampilkan', 1)->first();
        // GET PENGUMUMAN
        $pengumuman = Pengumuman::where('ditampilkan', 1)->first();
        // GET PETUGAS
        $cf = Configuration::first();
        $tipe_petugas = $cf->petugas;
        // GET WAKTU iQAMAH & DURASI REFRESH
        $t_iq = Konfig::where('name', 'iqamah')->first();
        $t_iq = $t_iq->val;
        $t_rf = Konfig::where('name', 'refresh')->first();
        $t_rf = $t_rf->val;
        
        switch ($cf->petugas) {
            case 'jumat':
                $data_petugas = PetugasJumat::first();
                break;
            case 'tarawih':
                $data_petugas = PetugasTarawih::first();
                break;
            case 'fitri':
                $data_petugas = PetugasIdulFitri::first();
                break;
            case 'adha':
                $data_petugas = PetugasIdulAdha::first();
                break;
            default:
                null;
                break;
        }
        // KEUANGAN
        $keuangan = Keuangan::orderBy('tanggal','asc')->take(3)->get();

        $total_masuk = Keuangan::where('tipe', 'pemasukan')->sum('saldo');
        $total_keluar = Keuangan::where('tipe', 'pengeluaran')->sum('saldo');
        $total_akhir = $total_masuk - $total_keluar;

        // Gambar
        $gambar = Gambar::where('ditampilkan', true)->get();
        $gambarPertama = Gambar::where('ditampilkan', true)->first();

        return view('welcome', compact(['total_masuk','total_keluar','total_akhir','hijriDate','today','tomorrow','quote','pengumuman', 'data_petugas', 'tipe_petugas','keuangan','gambar','gambarPertama','t_iq','t_rf']));
    }
}
