<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        // Eloquent
        // $roles = Role::all();

        // Query Builder
        $roles = DB::table('role')
            ->select('idrole', 'nama_role')
            ->get();
        return view('admin.role.index', compact('roles'));
    }
    public function create()
    {
        return view('admin.role.create');
    }
    public function store(Request $request) 
    {
        // validasi input
        $validatedData = $this->validateRole($request);

        // helper function untuk menyimpan data
        $role = $this->createRole($validatedData);

        return redirect()->route('admin.role.index')
                        ->with('success', 'Role berhasil ditambahkan.');
    }
    
    protected function validateRole(Request $request, $id = null)
    {
        // data yang bersifat uniq
        $uniqueRule = $id ?
        'unique:role,nama_role,'. $id .',idrole':
        'unique:role,nama_role';

        // validasi input
        return $request->validate([
            'nama_role' => [
                'required',
                'string',
                'max:255',
                'min:3', 
                $uniqueRule
            ],
        ],[
            'nama_role.required' => 'Nama role wajib diisi.',
            'nama_role.string' => 'Nama role harus berupa teks.',
            'nama_role.max' => 'Nama role tidak boleh lebih dari 255 karakter.',
            'nama_role.min' => 'Nama role minimal 3 karakter.',
            'nama_role.unique' => 'Nama role sudah ada dalam database.',
        ]);
    }
    //helper untuk membuat data baru
    protected function createRole(array $data)
    {
        try{
        //     return Role::create([
        //         'nama_role' => $data['nama_role'],
        //     ]);

        // Query Builder
        $role = DB::table('role')->insert([
            'nama_role' => $this->formatNamaRole($data['nama_role']),
        ]);

    return $role;
    } catch (\Exception $e){
            // tangani error jika diperlukan
            throw new \Exception('Gagal menyimpan role: ' . $e->getMessage());
        }
    }
    // helper untuk format nama menjadi titlr case
    protected function formatNamaRole($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
    public function destroy(Request $request)
    {
        $id = $request->param('id');
    }
    // edit dan update
    public function edit($id)
    {
        // Eloquent
        // $role = Role::findOrFail($id);

        // Query Builder
        $role = DB::table('role')
            ->where('idrole', $id)
            ->first();

        return view('admin.role.edit', compact('role'));
    }
    // update function
    public function update(Request $request, $id)
    {
        // validasi input
        $validatedData = $this->validateRole($request, $id);

        try {
            // Query Builder
            DB::table('role')
                ->where('idrole', $id)
                ->update([
                    'nama_role' => $this->formatNamaRole($validatedData['nama_role']),
                ]);

            return redirect()->route('admin.role.index')
                            ->with('success', 'Role berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.role.index')
                            ->with('error', 'Gagal memperbarui role: ' . $e->getMessage());
        }
    }
}