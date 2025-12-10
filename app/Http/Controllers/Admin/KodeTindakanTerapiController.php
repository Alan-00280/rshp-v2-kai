<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        // Eloquent
        // $kodeTindakanTerapi = KodeTindakanTerapi::all();

        // Query Builder
       $kodeTindakanTerapi = DB::table('kode_tindakan_terapi')
            ->select('idkode_tindakan_terapi', 'kode', 'deskripsi_tindakan_terapi')
            ->get();

        return view('admin.kodetindakanterapi.index', compact('kodeTindakanTerapi'));
    }
    public function create()
    {
        return view('admin.kodetindakanterapi.create');
    }
    public function store(Request $request)
    {
        // validasi input
        $validatedData = $this->validateKodeTindakanTerapi($request);

        // helper function untuk menyimpan data         
        $kodeTindakanTerapi = $this->createKodeTindakanTerapi($validatedData);

        return redirect()->route('admin.kodetindakanterapi.index')
                        ->with('success', 'Kode tindakan berhasil ditambahkan.');
    }
    protected function validateKodeTindakanTerapi(Request $request, $id = null)
    {
        // data yang bersifat uniq
        $uniqueRule = $id ?
        'unique:kode_tindakan_terapi,kode_tindakan,'. $id .',idkode_tindakan_terapi': 
        'unique:kode_tindakan_terapi,kode';

        // validasi input
        return $request->validate([
            'kode' => [
                'required',
                'string',
                'max:255',
                'min:3', 
                $uniqueRule
            ],
        ],[
            'kode.required' => 'Kode tindakan wajib diisi.',
            'kode.string' => 'Kode tindakan harus berupa teks.',
            'kode.max' => 'Kode tindakan tidak boleh lebih dari 255 karakter.',
            'kode.min' => 'Kode tindakan minimal 3 karakter.',
            'kode.unique' => 'Kode tindakan sudah ada dalam database.',
        ]);
    }
    //helper untuk membuat data baru
    protected function createKodeTindakanTerapi(array $data)
    {
        try{
            // Eloquent
            // return KodeTindakanTerapi::create([
            //     'kode' => $data['kode'],
            //     'deskripsi_tindakan' => $data['deskripsi_tindakan'],
            //     'biaya_tindakan' => $data['biaya_tindakan'],
            // ]);

            // Query Builder
            $kodeTindakanTerapi = DB::table('kode_tindakan_terapi')->insert([
                'kode' => $data['kode']
            ]);

        return $kodeTindakanTerapi;
        } catch (\Exception $e){
            // tangani error jika diperlukan
            throw new \Exception('Gagal menyimpan kode tindakan: ' . $e->getMessage());
        }
    }   
    // helper untuk format nama menjadi titlr case
    protected function formatNamaKodeTindakanTerapi($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
    public function destroy(Request $request)
    {
        $id = $request->param('id');
    } 
}
