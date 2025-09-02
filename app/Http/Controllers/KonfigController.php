<?php

namespace App\Http\Controllers;

use App\Models\Konfig;
use Illuminate\Http\Request;

class KonfigController extends Controller
{
    public function index() {
        $data = Konfig::all();
        return view("admin.konfig.index", compact('data'));
    }
    public function update($id, Request $request) {
        Konfig::whereId( $id )->update(['val' => $request->val]);
        return redirect()->back()->with('success','Data Berhasil Diganti');
    }
}
