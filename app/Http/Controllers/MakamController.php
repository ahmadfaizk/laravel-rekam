<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Makam;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MakamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makams = Makam::paginate(6);
        return view('makam.index', compact('makams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::where('id_provinsi', 11)->get();
        $kecamatans = Kecamatan::where('id_kabupaten', 1101)->get();
        return view('makam.create', compact('provinsis', 'kabupatens', 'kecamatans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg',
            'provinsi' => 'required|exists:provinsi,id',
            'kabupaten' => 'required|exists:kabupaten,id',
            'kecamatan' => 'required|exists:kecamatan,id',
        ]);

        $fileFoto = $request->file('foto');
        $namaFoto = date('dmY') .'_'. Str::random(10) . '.' . $fileFoto->getClientOriginalExtension();
        Storage::putFileAs('public/makam', $fileFoto, $namaFoto);

        $makam = Makam::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
            'foto' => $namaFoto,
            'id_provinsi' => $request->provinsi,
            'id_kabupaten' => $request->kabupaten,
            'id_kecamatan' => $request->kecamatan,
            'id_user' => auth()->id(),
        ]);

        return redirect()->route('makam.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Makam  $makam
     * @return \Illuminate\Http\Response
     */
    public function show(Makam $makam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Makam  $makam
     * @return \Illuminate\Http\Response
     */
    public function edit(Makam $makam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Makam  $makam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Makam $makam)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg',
            'provinsi' => 'required|exists:provinsi,id',
            'kabupaten' => 'required|exists:kabupaten,id',
            'kecamatan' => 'required|exists:kecamatan,id',
        ]);

        $makam->nama = $request->nama;
        $makam->harga = $request->harga;
        $makam->stok = $request->stok;
        $makam->deskripsi = $request->deskripsi;
        $makam->alamat = $request->alamat;
        $makam->id_provinsi = $request->provinsi;
        $makam->id_kabupaten = $request->kabupaten;
        $makam->id_kecamatan = $request->kecamatan;

        if ($request->has('foto')) {
            Storage::delete('public/makam'.$makam->foto);
            $fileFoto = $request->input('foto');
            $namaFoto = date('dmY') .'_'. Str::random(10) . '.' . $fileFoto->getClientOriginalExtension();
            Storage::putFileAs('public/makam', $fileFoto, $namaFoto);
            $makam->foto = $namaFoto;
        }

        $makam->save();
        return redirect()->route('makam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Makam  $makam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Makam $makam)
    {
        $makam->delete();
        return redirect()->route('makam.index');
    }
}
