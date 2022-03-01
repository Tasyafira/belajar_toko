<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function show()
    {
        return Petugas::all();
    }

    public function detail($id)
    {
    if(Petugas::where('id_petugas', $id)->exists()) {
    $data = DB::table('petugas')->where('petugas.id_petugas', '=', $id)->get();
    return Response()->json($data);
   }
    else {
    return Response()->json(['message' => 'Tidak ditemukan' ]);
}
}

    public function store(Request $request)
 {
    $validator=Validator::make($request->all(),
        [
            'nama_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]
    );
    if($validator->fails()) {
        return Response()->json($validator->errors());
    }
    $simpan = Petugas::create([
        'nama_petugas' => $request->nama_petugas,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'level' => $request->level
    ]);
 if($simpan)
 {
 return Response()->json(['status' => 1]);
 }
 else
 {
 return Response()->json(['status' => 0]);
 }
 }

 public function update($id, Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'nama_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required'
        ]
        );
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }
        $ubah = Petugas::where('id_petugas', $id)->update([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => $request->level
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
        $hapus = Petugas::where('id_petugas', $id)->delete();
        if($hapus) {
        return Response()->json(['status' => 1]);
        }
        else {
        return Response()->json(['status' => 0]);
        }
    }
}
