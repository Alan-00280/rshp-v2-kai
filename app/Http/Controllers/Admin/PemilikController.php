<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use Illuminate\Support\Facades\DB;

class PemilikController extends Controller
{
    public function index()
    {
        // Eloquent
        // $pemilik = Pemilik::with('user')->get();

        // Query Builder
        $pemilik = DB::table('pemilik')
        ->select(
            'pemilik.idpemilik',
            'pemilik.no_wa', // Ditambahkan prefix 'pemilik.' untuk kejelasan
            'pemilik.alamat', // Ditambahkan prefix 'pemilik.' untuk kejelasan
            'user.nama as nama_pemilik' // Mengambil nama dari tabel user dan memberi alias
        )
        // Kunci 'pemilik.iduser' (FK) harus dihubungkan dengan 'user.id' (PK)
        ->join('user', 'pemilik.iduser', '=', 'user.iduser') 
        ->get();

        return view('admin.pemilik.index', compact('pemilik'));
    }
    public function create()
    {
        return view('admin.pemilik.create');
    }
    public function store(Request $request)
    {   
            // validasi input
            $validatedData = $this->validatePemilik($request);

            // helper function untuk menyimpan data
            $pemilik = $this->createPemilik($validatedData);

            return redirect()->route('admin.pemilik.index')
                            ->with('success', 'Pemilik berhasil ditambahkan.');
    }
    protected function validatePemilik(Request $request, $id = null)
    {
        // data yang bersifat uniq
        $uniqueRule = $id ?
        'unique:pemilik,no_wa,'. $id .',idpemilik': 
        'unique:pemilik,no_wa';

        // validasi input
        return $request->validate([
            'no_wa' => [
                'required',
                'string',
                'max:255',
                'min:3', 
                $uniqueRule
            ],
        ],[
            'no_wa.required' => 'No WA wajib diisi.',
            'no_wa.string' => 'No WA harus berupa teks.',
            'no_wa.max' => 'No WA tidak boleh lebih dari 255 karakter.',
            'no_wa.min' => 'No WA minimal 3 karakter.',
            'no_wa.unique' => 'No WA sudah ada dalam database.',
        ]); 
    }
    //helper untuk membuat data baru
    protected function createPemilik(array $data)
    {
        try{
            // Eloquent
            // return Pemilik::create([
            //     'no_wa' => $data['no_wa'],
            //     'alamat' => $data['alamat'],
            // ]);

            // Query Builder
            $pemilik = DB::table('pemilik')->insert([
                'iduser' => '1', // sementara di set 1, nanti diubah sesuai user yang login
                'no_wa' => $data['no_wa'],
                'alamat' => $data['alamat'],
            ]);

        return $pemilik;
        } catch (\Exception $e){
            // tangani error jika diperlukan
            throw new \Exception('Gagal menyimpan pemilik: ' . $e->getMessage());
        }
    } 
    // helper untuk format nama menjadi titlr case
    protected function formatNamaPemilik($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
    public function destroy(Request $request)
    {
        $id = $request->param('id');
    }
}
