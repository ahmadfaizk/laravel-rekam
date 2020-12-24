<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function show($id)
    {
        $data = Kabupaten::where('id', $id)->with('kecamatan')->first();
        return response()->json($data);
    }
}
