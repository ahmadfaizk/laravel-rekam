<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $status = ['Belum Dibayar', 'Menunggu Verifikasi', 'Berhasil', 'Gagal'];
        $transaksiChart = (object) [
            'label' => $status,
            'data' => [
                $this->getCountTransaksi($status[0]),
                $this->getCountTransaksi($status[1]),
                $this->getCountTransaksi($status[2]),
                $this->getCountTransaksi($status[3]),
            ]
        ];
        $transaksiBar = DB::table('makam as m')
            ->selectRaw('m.nama as x, (SELECT COUNT(t.id) FROM transaksi AS t WHERE t.id_makam = m.id AND t.status = "Berhasil") AS y')
            ->when('m.id_user', auth()->id())
            ->get();
        return view('home', compact('transaksiChart', 'transaksiBar'));
    }

    private function getCountTransaksi($status) {
        return DB::table('transaksi as t')
            ->join('makam as m', 'm.id', 't.id_makam')
            ->where('m.id_user', auth()->id())
            ->where('t.status', $status)
            ->count();
    }

    public function reset() {
        $user = User::find(1);
        $password = '123456';
        $user->password = Hash::make($password);
        return response()->json('Berhasil');
    }
}
