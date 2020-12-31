<?php

namespace App\Http\Controllers;

use App\Models\Makam;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index()
    {
        $makams = Makam::paginate(6);
        return view('marketplace.index', compact('makams'));
    }
}
