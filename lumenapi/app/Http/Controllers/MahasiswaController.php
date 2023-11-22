<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAllMahasiswa(Request $request)
    {
        $mahasiswa = Mahasiswa::with('prodi')->get();

        return response()->json([
            'status' => 'Success',
            'message' => 'Seluruh data mahasiswa tertampil',
            'mahasiswa' => $mahasiswa
        ], 200);
    }

    public function getMahasiswaByToken(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Token mahasiswa berhasil diambil',
            'mahasiswa' => $request->mahasiswa
        ], 200);
    }
}
