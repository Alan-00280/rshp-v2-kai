<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    public function index()
    {
        // ELoquent
        // $jenisHewan = jenishewan::all();

        // Query Buider
        $jenisHewan = Db::table('jenis_hewan')
        ->select('idjenis_hewan', 'nama_jenis_hewan')
        ->get();

        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenis-hewan.create');
    }
    public function store(Request $request)
    {
       // validasi input
       $validatedData = $this->validateJenisHewan($request);

       // helper function untuk menyimpan data
       $jenisHewan = $this->createJenisHewan($validatedData);

        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    protected function validateJenisHewan(Request $request, $id = null)
    {
        // data yang bersifat uniq
        $uniqueRule = $id ?
        'unique:jenis_hewan,nama_jenis_hewan,'. $id .',idjenis_hewan' :
        'unique:jenis_hewan,nama_jenis_hewan';

        // validasi input
        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3', 
                $uniqueRule
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks.',
            'nama_jenis_hewan.max' => 'Nama jenis hewan tidak boleh lebih dari 255 karakter.',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada dalam database.',

        ]);
    }
    //helper untuk membuat data baru
    protected function createJenisHewan(array $data)
    {
        try{
            // Eloquent
            // return JenisHewan::create([
            //     'nama_jenis_hewan'=>$this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            // ]);

            // Query Builder
            $jenisHewan = DB::table('jenis_hewan')->insert([
                'nama_jenis_hewan'=>$this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);

        return $jenisHewan;
        } catch (\Exception $e){
            // tangani error jika diperlukan
            throw new \Exception('Gagal menyimpan data jenis hewan: ' . $e->getMessage());
        }
    }
    // helper untuk format nama menjadi titlr case
    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
    public function destroy(Request $request)
    {
        $id = $request->param('id');

    }
}
