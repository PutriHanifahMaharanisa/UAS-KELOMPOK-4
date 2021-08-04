<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index(){
        $pegawais = pegawai::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data pegawai',
            'data' => $pegawais
        ], 200);
    }

    public function show($id){
        $pegawai = pegawai::findOrfail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data pegawai',
            'data' => $pegawai
        ], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $pegawai = pegawai::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'email' => $request->email,
            'no_telp' => $request->no_telp
        ]);

        if ($pegawai) {
            return response()->json([
                'success' => true,
                'message' => 'pegawai Created',
                'data' => $pegawai
            ], 201);
        }
    }
    
    public function update(Request $request, pegawai $pegawai){
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'email' => 'required',
            'no_telp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $pegawai = pegawai::findOrFail($pegawai->id);
        if ($pegawai) {
            $pegawai->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'email' => $request->email,
                'no_telp' => $request->no_telp
            ]);
            return response()->json([
                'success' => true,
                'message' => 'pegawai Updated',
                'data' => $pegawai
            ], 200);
        }
    }

    public function destroy($id){
        $pegawai = pegawai::findOrfail($id);

        if ($pegawai) {
            $pegawai->delete();

            return response()->json([
                'success' => true,
                'message' => 'pegawai Deleted',
            ], 200);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'pegawai Not Found',
        ], 404);
    }
}
