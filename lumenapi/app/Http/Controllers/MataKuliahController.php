<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
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

    // Get All Matkul
    public function getAllMataKuliah(Request $request)
    {
        $mataKuliah = MataKuliah::all();

        return response()->json([
            'status' => 'Success',
            'message' => 'Seluruh data mata kuliah telah ditampilkan',
            'matakuliah' => $mataKuliah
        ], 200);
    }

    // Post Matkul into profile
    public function postMataKuliah(Request $request, $mkId)
    {
        // Retrieve token
        $nim = $request->mahasiswa->nim;

        //Cek apakah mahasiswa terdaftar atau tidak
        $mahasiswa = Mahasiswa::find($nim);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Mahasiswa Not Found'
            ], 400);
        }

        //Cek apakah mata kuliah terdaftar atau tidak
        $mataKuliah = MataKuliah::find($mkId);

        if (!$mataKuliah) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Mata Kuliah Not Found'
            ], 400);
        }

        // Cek apakah mahasiswa sudah terdaftar pada mata kuliah tersebut
        if ($mahasiswa->matakuliahs()->where('mkId', $mkId)->exists()) {
            return response()->json([
                'status' => 'Duplicate',
                'message' => 'Mahasiswa sudah terdaftar pada Mata Kuliah tersebut'
            ], 400);
        }

        //Menambahkan mata kuliah ke dalam mahasiswa
        $mahasiswa->matakuliahs()->attach($mkId);

        return response()->json([
            'status' => 'Success',
            'message' => 'Mata Kuliah berhasil ditambahkan',
            'data' => [
                'mahasiswa' => $mahasiswa,
                'matakuliah' => $mataKuliah
            ]
        ], 200);
    }

    public function putMataKuliah(Request $request, $mkId)
    {
        // Retrieve token
        $nim = $request->mahasiswa->nim;

        $mahasiswa = Mahasiswa::find($nim);

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Mahasiswa Not Found'
            ], 400);
        }

        //Cek apakah mata kuliah terdaftar atau tidak
        $mataKuliah = MataKuliah::find($mkId);

        if (!$mataKuliah) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Mata Kuliah Not Found'
            ], 400);
        }

        // Cek apakah mahasiswa sudah terdaftar pada mata kuliah tersebut
        if ($mahasiswa->matakuliahs()->where('mkId', $mkId)->exists()) {
            return response()->json([
                'status' => 'Duplicate',
                'message' => 'Mahasiswa sudah terdaftar pada Mata Kuliah tersebut'
            ], 400);
        }

        //Menghapus mata kuliah dari mahasiswa
        $mahasiswa->matakuliahs()->detach($mkId);

        return response()->json([
            'status' => 'Success',
            'message' => 'Mata Kuliah berhasil dihapus',
            'data' => [
                'mahasiswa' => $mahasiswa,
                'matakuliah' => $mataKuliah
            ]
        ], 200);
    }
}