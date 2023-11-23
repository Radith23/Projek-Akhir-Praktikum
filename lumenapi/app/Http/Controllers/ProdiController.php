<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
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

    // Get All Prodi
    public function getAllProdi(Request $request)
    {
        $prodi = Prodi::all();

        return response()->json([
            'status' => 'Success',
            'message' => 'Data prodi berhasil ditampilkan',
            'prodi' => $prodi
        ], 200);
    }
}
