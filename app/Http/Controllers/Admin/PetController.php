<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet; // Import model Pet
use Illuminate\Support\Facades\DB; // Import Query Builder from table database

class PetController extends Controller
{
    public function index()
    {
        // Eloquent
        // $pets = Pet::with(['pemilik.user', 'ras'])->get(); // Eager load relasi pemilik dan ras

        // Query Builder
        $pets = DB::table('pet')
        ->select(
            'pet.idpet',
            'pet.nama',
            'pet.tanggal_lahir',
            'pet.warna_tanda',
            'pet.jenis_kelamin',
            'ras_hewan.nama_ras as nama_ras',
            'user.nama as nama_pemilik'
        )
        ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
        ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
        ->join('user', 'pemilik.iduser', '=', 'user.iduser')
        ->get();
        return view('admin.pet.index', compact('pets'));
    }
    public function create()
    {
        return view('admin.pet.create');
    }
    public function store(Request $request)
    {
        // validasi input
        $validatedData = $this->validatePet($request);

        // helper function untuk menyimpan data
        $pet = $this->createPet($validatedData);

        return redirect()->route('admin.pet.index')
                        ->with('success', 'Hewan berhasil ditambahkan.');
    }
    protected function validatePet(Request $request, $id = null)
    {
        // data yang bersifat uniq
        $uniqueRule = $id ?
        'unique:pet,nama,'. $id .',idpet':  
        'unique:pet,nama';

        // validasi input
        return $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                'min:3', 
                $uniqueRule
            ],
            'tanggal_lahir' => [
                'required',
            ],
            'warna_tanda' => [
                'required',
                'string',
                'max:255',
                'min:3', 
            ],
            'jenis_kelamin' => [
                'required',
                'string',
                'max:255',
                'min:3', 
            ],
            'idras_hewan' => [
                'required',
                'integer',
            ],
            'idpemilik' => [
                'required',
                'integer',
            ],
        ],[
            'nama.required' => 'Nama hewan wajib diisi.',
            'nama.string' => 'Nama hewan harus berupa teks.',
            'nama.max' => 'Nama hewan tidak boleh lebih dari 255 karakter.',
            'nama.min' => 'Nama hewan minimal 3 karakter.',
            'nama.unique' => 'Nama hewan sudah ada dalam database.',
            'tanggal_lahir.required' => 'Tanggal lahir hewan wajib diisi.',
            'warna_tanda.required' => 'Warna tanda hewan wajib diisi.', 
            'warna_tanda.string' => 'Warna tanda hewan harus berupa teks.', 
            'warna_tanda.max' => 'Warna tanda hewan tidak boleh lebih dari 255 karakter.', 
            'warna_tanda.min' => 'Warna tanda hewan minimal 3 karakter.', 
            'jenis_kelamin.required' => 'Jenis kelamin hewan wajib diisi.',         
            'jenis_kelamin.string' => 'Jenis kelamin hewan harus berupa teks.',         
            'jenis_kelamin.max' => 'Jenis kelamin hewan tidak boleh lebih dari 255 karakter.',         
            'jenis_kelamin.min' => 'Jenis kelamin hewan minimal 3 karakter.', 
            'idras_hewan.required' => 'Ras hewan wajib diisi.',         
            'idras_hewan.integer' => 'Ras hewan harus berupa angka.', 
            'idpemilik.required' => 'Pemilik hewan wajib diisi.',         
            'idpemilik.integer' => 'Pemilik hewan harus berupa angka.', 
        ]);
    }
    //helper untuk membuat data baru
    protected function createPet(array $data)
    {
        try{
            // // Eloquent
            // return Pet::create([
            //     'nama' => $data['nama'],
            //     'tanggal_lahir' => $data['tanggal_lahir'],
            //     'warna_tanda' => $data['warna_tanda'],
            //     'jenis_kelamin' => $data['jenis_kelamin'],
            //     'idras_hewan' => $data['idras_hewan'],
            //     'idpemilik' => $data['idpemilik'],
            // ]);

            // Query Builder
            $pet = DB::table('pet')->insert([
                'nama' => $this->formatNamaPet($data['nama']),
                'tanggal_lahir' => $data['tanggal_lahir'],
                'warna_tanda' => $data['warna_tanda'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'idras_hewan' => $data['idras_hewan'],
                'idpemilik' => $data['idpemilik'],
            ]);

        return $pet;
        } catch (\Exception $e){
            // tangani error jika diperlukan
            throw new \Exception('Gagal menyimpan hewan: ' . $e->getMessage());
        }
    }
    // helper untuk format nama menjadi titlr case
    protected function formatNamaPet($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
    public function destroy(Request $request)
    {
        $id = $request->param('id');
    }
}
