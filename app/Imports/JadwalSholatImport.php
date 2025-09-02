<?php

namespace App\Imports;

use App\Models\JadwalSholat;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class JadwalSholatImport implements OnEachRow, WithStartRow
{
    public function startRow(): int
    {
        return 11; // data mulai dari baris ke-11
    }
    public function onRow(Row $row)
    {
        $data = $row->toArray();
        // Lewati jika tidak ada tanggal
        if (empty($data[1])) {
            return;
        }

        // Ambil tanggal dari format: "Minggu, 01/06/2025"
        $parts = explode(',', $data[1]);
        if (count($parts) < 2) {
            return;
        }

        try {
            $tanggal = Carbon::createFromFormat('d/m/Y', trim($parts[1]))->format('Y-m-d');
        } catch (\Exception $e) {
            return; // Format salah, skip
        }

        if (JadwalSholat::where('tanggal', $tanggal)->exists()) {
            return;
        }

        JadwalSholat::create([
            'tanggal' => $tanggal,
            'imsak' => $data[3] ?? null,
            'subuh' => $data[4] ?? null,
            'terbit' => $data[5] ?? null,
            'dhuha' => $data[6] ?? null,
            'dzuhur' => $data[7] ?? null,
            'ashar' => $data[8] ?? null,
            'maghrib' => $data[9] ?? null,
            'isya' => $data[10] ?? null,
        ]);
    }
}
