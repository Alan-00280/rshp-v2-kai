<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pet;
use Illuminate\Http\Request;

class DashboardDokterController extends Controller
{
    public function index()
    {
        return view('admin.dashboard-dokter', ['pets' => Pet::all(), 'kategoriKlinis' => KategoriKlinis::all(), 'kodeTindakanTerapi'=>KodeTindakanTerapi::all()]);
    }
}
