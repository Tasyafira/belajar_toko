<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function show()
    {
        return Transaksi::all();
    }

    public function detail($id)
    {
    if(Transaksi::where('id_transaksi', $id)->exists()) {
    $data_transaksi = DB::table('transaksi')
           ->join('pelanggan', 'transaksi.id_pelanggan', '=', 'pelanggan.id_pelanggan')
           ->join('petugas', 'transaksi.id_petugas', '=', 'petugas.id_petugas')
           ->select('transaksi.id_transaksi', 'pelanggan.id_pelanggan', 'petugas.id_petugas', 'transaksi.tgl_transaksi')
           ->where('transaksi.id_transaksi', '=', $id)
           ->get();
    return Response()->json($data_transaksi);
   }
    else {
     return Response()->json(['message' => 'Tidak ditemukan' ]);
    }
    }

    public function store(Request $request)
    {
    $validator=Validator::make($request->all(),
    [
    'id_pelanggan' => 'required',
    'id_petugas' => 'required',
    ]
    );
    if($validator->fails()) {
    return Response()->json($validator->errors());
    }
    $simpan = Transaksi::create([
    'id_pelanggan' => $request->id_pelanggan,
    'id_petugas' => $request->id_petugas,
    'tgl_transaksi' => date("Y-m-d")
    ]);

    if($simpan) {
    return Response()->json(['status'=>1]);
    }
    else {
    return Response()->json(['status'=>0]);
    }
    }

    public function update($id, Request $request)  {
        $validator=Validator::make($request->all(),
        [
            'id_pelanggan' => 'required',
            'id_petugas' => 'required',
        ]);
       
        if($validator->fails()) {
        return Response()->json($validator->errors());
        }
       
        $ubah = Transaksi::where('id_transaksi', $id)->update([
            'id_pelanggan' => $request->id_pelanggan,
            'id_petugas' => $request->id_petugas,
            'tgl_transaksi' => date("Y-m-d")
        ]);
        if($ubah) {
        return Response()->json(['status' => 1]);
        }
        else {
        return Response()->json(['status' => 0]);
        }
    }

    public function destroy($id)
    {
       $hapus = Transaksi::where('id_transaksi', $id)->delete();
       if($hapus) {
       return Response()->json(['status' => 1]);
    }
       else {
       return Response()->json(['status' => 0]);
}
}
}