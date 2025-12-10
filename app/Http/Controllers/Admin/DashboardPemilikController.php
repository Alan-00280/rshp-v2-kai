<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pemilik = Pemilik::where('iduser', $userId)->first();
        $pets = collect(); // default to an empty collection

        if ($pemilik) {
            $pets = Pet::where('idpemilik', $pemilik->idpemilik)->with('ras')->get();
        }

        return view('resepsionis.dashboard-pemilik', compact('pets'));
    }
}
