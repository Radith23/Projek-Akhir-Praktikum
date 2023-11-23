<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    // Get All Mahasiswa
    public function getAllMahasiswa(Request $request)
    {
        $mahasiswa = Mahasiswa::with('prodi')->get();

        return response()->json([
            'status' => 'Success',
            'message' => 'Seluruh data mahasiswa tertampil',
            'mahasiswa' => $mahasiswa
        ], 200);
    }

    // Get Mahasiswa By Token
    public function getMahasiswaByToken(Request $request)
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Token mahasiswa berhasil diambil',
            'mahasiswa' => $request->mahasiswa
        ], 200);
    }

    // get Mahasiswa By NIM
    public function getMahasiswaByNim(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->with('prodi', 'matakuliahs')->first();

        if ($mahasiswa) {
            return response()->json([
                'status' => 'Success',
                'message' => "Mahasiswa dengan nim $nim berhasil ditampilkan",
                'mahasiswa' => $mahasiswa
            ], 200);
        } else {
            return response()->json([
                'status' => 'Not Found',
                'message' => "Mahasiswa dengan nim $nim tidak ditemukan",
            ], 400);
        }
    }
}
