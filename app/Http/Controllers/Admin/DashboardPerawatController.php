<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik', 'ras'])->get();
        return view('admin.dashboard-perawat', compact('pets'));
    }
}
