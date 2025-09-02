<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function update(Request $request) {
        //dd($request->tampilkan);
        $data = Configuration::first();
        $data->update([
            'petugas' => $request->tampilkan
        ]);

        return redirect()->back()->with('success','Tampilan Berhasil Diganti');
    }
}
