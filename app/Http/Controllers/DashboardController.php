<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
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
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        try {
            $hijri = new HijriDateTime();
            $hijriDate = $hijri->date("l, d F Y", now()->timestamp);
        } catch (\Throwable $th) {
            $hijriDate = "Tanggal Hari ini Gagal Dimuat";
        }
        $today = JadwalSholat::where('tanggal', Carbon::now()->translatedFormat('Y-m-d'))->first();
        $tomorrow = JadwalSholat::where('tanggal', Carbon::now()->addDay()->translatedFormat('Y-m-d'))->first();
        $quote = Quotes::where('ditampilkan', 1)->first();
        $pengumuman = Pengumuman::where('ditampilkan', 1)->first();
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
        $keuangan = Keuangan::orderBy('tanggal','asc')->take(5)->get();
        return view('dashboard', compact(['hijriDate','today','tomorrow','quote','pengumuman', 'data_petugas', 'tipe_petugas','keuangan','t_iq','t_rf']));
    }
}
