<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Makam;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakamController extends Controller
{
    public function index()
    {
        $makams = Makam::where('id_user', auth()->id())->paginate(6);
        return view('makam.index', compact('makams'));
    }

    public function create()
    {
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::where('id_provinsi', 11)->get();
        $kecamatans = Kecamatan::where('id_kabupaten', 1101)->get();
        return view('makam.create', compact('provinsis', 'kabupatens', 'kecamatans'));
    }

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
        $namaFoto = Storage::disk('public_uploads')->put('makam', $fileFoto);

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

    public function show(Makam $makam)
    {
        return view('makam.show', compact('makam'));
    }

    public function edit(Makam $makam)
    {
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::where('id_provinsi', $makam->id_provinsi)->get();
        $kecamatans = Kecamatan::where('id_kabupaten', $makam->id_kabupaten)->get();
        return view('makam.edit', compact('makam', 'provinsis', 'kabupatens', 'kecamatans'));
    }

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
            Storage::disk('public_uploads')->delete($makam->foto);
            $fileFoto = $request->file('foto');
            $namaFoto = Storage::disk('public_uploads')->put('makam', $fileFoto);
            $makam->foto = $namaFoto;
        }

        $makam->save();
        return redirect()->route('makam.index');
    }

    public function destroy(Makam $makam)
    {
        $makam->delete();
        return redirect()->route('makam.index');
    }
}
