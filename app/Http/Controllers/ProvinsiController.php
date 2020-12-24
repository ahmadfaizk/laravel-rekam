<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index()
    {
        $data = Provinsi::all();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Provinsi::where('id', $id)->with('kabupaten')->first();
        return response()->json($data);
    }
}
