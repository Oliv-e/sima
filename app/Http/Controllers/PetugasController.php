<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\PetugasIdulAdha;
use App\Models\PetugasIdulFitri;
use App\Models\PetugasJumat;
use App\Models\PetugasTarawih;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function takeAll() {
        $data[1] = PetugasJumat::first();
        $data[2] = PetugasTarawih::first();
        $data[3] = PetugasIdulFitri::first();
        $data[4] = PetugasIdulAdha::first();

        return $data;
    }
    public function updateOne($type, $id, $request) {
        switch ($type) {
            case 'jumat':
                $data = PetugasJumat::whereId($id)->first();
                $data->update([
                    'khatib' => $request->khatib,
                    'imam' => $request->imam,
                    'muadzin' => $request->muadzin,
                    'bilal' => $request->bilal,
                ]);
                break;
            case 'tarawih':
                $data = PetugasTarawih::whereId($id)->first();
                $data->update([
                    'imam' => $request->imam,
                    'kultum' => $request->kultum,
                    'sholawat' => $request->sholawat,
                ]);
                break;
            case 'fitri':
                $data = PetugasIdulFitri::whereId($id)->first();
                $data->update([
                    'khatib' => $request->khatib,
                    'imam' => $request->imam,
                    'bilal' => $request->bilal,
                    'moderator' => $request->moderator,
                ]);
                break;
            case 'adha':
                $data = PetugasIdulAdha::whereId($id)->first();
                $data->update([
                    'khatib' => $request->khatib,
                    'imam' => $request->imam,
                    'bilal' => $request->bilal,
                    'moderator' => $request->moderator,
                ]);
                break;
            default:
                $data = null;
                break;
        }
        return $data;
    }
    public function index() {
        $data = $this->takeAll();
        $data[5] = Configuration::first();
        return view('admin.petugas.index', ['data' => $data]);
    }
    public function view($id, $type) {
        
        switch ($type) {
            case 'jumat':
                $data = PetugasJumat::whereId($id)->first();
                break;
            case 'tarawih':
                $data = PetugasTarawih::whereId($id)->first();
                break;
            case 'fitri':
                $data = PetugasIdulFitri::whereId($id)->first();
                break;
            case 'adha':
                $data = PetugasIdulAdha::whereId($id)->first();
                break;
            default:
                $data = null;
                break;
        }
        
        return view('admin.petugas.edit', ['data' => $data, 'type' => $type]);
    }
    public function update($id, $type, Request $request) {
        $data = $this->updateOne($type, $id, $request);

        return redirect()->route('petugas.index')->with('success','Data Berhasil Diperbarui');
    }
}
