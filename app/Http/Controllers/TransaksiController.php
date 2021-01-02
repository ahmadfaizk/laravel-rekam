<?php

namespace App\Http\Controllers;

use App\Models\Makam;
use App\Models\Transaksi;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TransaksiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transaksis = collect([]);
        if ($user->hasRole('penjual')) {
            $transaksis = DB::table('transaksi as t')
                ->join('makam as m', 'm.id', 't.id_makam')
                ->select('t.*', 'm.nama as nama_makam')
                ->where('m.id_user', auth()->id())
                ->paginate(10);
        } else {
            $transaksis = DB::table('transaksi as t')
                ->join('makam as m', 'm.id', 't.id_makam')
                ->select('t.*', 'm.nama as nama_makam')
                ->where('t.id_user', auth()->id())
                ->paginate(10);
        }
        foreach($transaksis as $transaksi) {
            $transaksi->waktu_transaksi = $this->formatDate($transaksi->waktu_transaksi);
        }
        return view('transaksi.index', compact('transaksis'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:makam'
        ]);
        $makam = Makam::find($request->id);
        $transaksi = Transaksi::create([
            'id_makam' => $makam->id,
            'id_user' => auth()->id(),
            'total_transaksi' => $makam->harga,
            'waktu_transaksi' => now(),
        ]);

        return redirect()->route('transaksi.show', $transaksi->id);
    }

    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->waktu_transaksi = $this->formatDate($transaksi->waktu_transaksi);
        return view('transaksi.show', compact('transaksi'));
    }

    private function formatDate($date) {
        return Carbon::parse($date)->format('H:i, d M Y');
    }

    public function confirm(Request $request) {
        $this->validate($request, [
            'id' => 'required|exists:transaksi',
            'bukti' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        $transaksi = Transaksi::find($request->id);

        $fileBukti = $request->file('bukti');
        $namaBukti = date('dmY') .'_'. Str::random(10) . '.' . $fileBukti->getClientOriginalExtension();
        Storage::putFileAs('public/transaksi', $fileBukti, $namaBukti);
        $transaksi->bukti_transfer = $namaBukti;
        $transaksi->waktu_pembayaran = now();
        $transaksi->status = 'Menunggu Verifikasi';
        $transaksi->save();

        return redirect()->route('transaksi.show', $transaksi->id);
    }

    public function confirmPembayaran(Request $request) {
        $this->validate($request, [
            'id' => 'required|exists:transaksi',
            'aksi' => ['required', Rule::in(['Tolak Pembayaran', 'Setujui Pembayaran'])]
        ]);
        
        $transaksi = Transaksi::find($request->id);
        if ($request->aksi == 'Setujui Pembayaran') {
            $transaksi->status = 'Berhasil';
            $makam = Makam::find($transaksi->id_makam);
            $makam->stok = $makam->stok - 1;
            $makam->save();
        } else {
            $transaksi->status = 'Gagal';
            Storage::delete('public/transaksi/'.$transaksi->bukti_transfer);
            $transaksi->bukti_transfer = null;
        }
        $transaksi->save();

        return redirect()->route('transaksi.show', $transaksi->id);
    }

    public function print($id) {
        $transaksi = Transaksi::find($id);
        $transaksi->tanggal = Carbon::parse($transaksi->waktu_pembayaran)->format('d F Y');
        $transaksi->waktu_transaksi = $this->formatDate($transaksi->waktu_transaksi);
        $transaksi->waktu_pembayaran = $this->formatDate($transaksi->waktu_pembayaran);
        $pdf = PDF::loadView('transaksi.invoice', compact('transaksi'));
        return $pdf->stream();
        return view('transaksi.invoice', compact('transaksi'));
    }
}
