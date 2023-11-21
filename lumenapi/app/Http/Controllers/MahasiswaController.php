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

    public function getMahasiswa(Request $request) {
        $mahasiswa = Mahasiswa::all();

        return response()->json([
            'status' => 'Success',
            'message' => 'Seluruh data mahasiswa tertampil',
            'data' => [
                'mahasiswa' => $mahasiswa
            ]
        ], 200);
    }

    public function getMahasiswaByToken(Request $request) {
        $mahasiswa = $request->mahasiswa;

        return response()->json([
            'status' => 'Success',
            'message' => 'Selamat Datang ' . $mahasiswa->nama,
        ], 200);
    }
}
