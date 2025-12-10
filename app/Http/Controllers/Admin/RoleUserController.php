<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleUser; 
use Illuminate\Support\Facades\DB; 

class RoleUserController extends Controller
{
    public function index()
    {
        // Query Builder (Sudah diperbaiki di response sebelumnya)
        $roleUsers = DB::table('role_user')
        ->select(
            'role_user.idrole_user', 
            'role_user.iduser', 
            'role_user.idrole',
            'user.nama as nama_user', 
            'role.nama_role' 
        )
        ->join('user', 'role_user.iduser', '=', 'user.iduser')
        ->join('role', 'role_user.idrole', '=', 'role.idrole')
        ->get();

        return view('admin.role-user.index', compact('roleUsers'));
    }
    
    // PERBAIKAN: Mengirim data users dan roles ke view create
    public function create()
    {
        // Ambil semua user dan role yang diperlukan untuk dropdown
        $users = DB::table('user')->select('iduser', 'nama')->get();
        $roles = DB::table('role')->select('idrole', 'nama_role')->get();

        return view('admin.role-user.create', compact('users', 'roles'));
    }
    
    public function store(Request $request)
    {
        // PERBAIKAN: Memvalidasi iduser dan idrole
        $validatedData = $this->validateRoleUser($request); 

        // helper function untuk menyimpan data     
        $roleUsers = $this->createRoleUser($validatedData);

        return redirect()->route('admin.roleuser.index')
                        ->with('success', 'Role pengguna berhasil ditambahkan.');
    }
    
    // PERBAIKAN: Memvalidasi iduser dan idrole
    protected function validateRoleUser(Request $request, $id = null)
    {
        // Cek kombinasi iduser dan idrole agar tidak ada duplikasi
        // Jika idrole_user sudah ada, abaikan idrole_user tersebut saat cek unique
        $ignoreId = $id ? ",{$id},idrole_user" : '';

        return $request->validate([
            'iduser' => [
                'required',
                'integer',
                'exists:user,iduser',
                // Rule unik untuk memastikan kombinasi user-role tidak duplikat
                "unique:role_user,iduser,NULL,NULL,idrole,{$request->idrole}"
            ],
            'idrole' => [
                'required',
                'integer',
                'exists:role,idrole',
            ],
        ],[
            'iduser.required' => 'Pengguna wajib dipilih.',
            'iduser.exists' => 'Pengguna tidak valid.',
            'iduser.unique' => 'Pengguna ini sudah memiliki peran ini.',
            'idrole.required' => 'Peran wajib dipilih.',
            'idrole.exists' => 'Peran tidak valid.',
        ]);
    }
    
    // helper untuk membuat data baru
    protected function createRoleUser(array $data)
    {
        try{
            // Query Builder
            // PERBAIKAN: Menyimpan iduser dan idrole
            $roleUsers = DB::table('role_user')->insert([
                'iduser' => $data['iduser'], 
                'idrole' => $data['idrole'],
                // Tambahkan timestamps jika ada: 
                // 'created_at' => now(),
                // 'updated_at' => now(),
            ]);
            
        return $roleUsers;
        } catch (\Exception $e){
            // tangani error jika diperlukan
            throw new \Exception('Gagal menyimpan role pengguna: ' . $e->getMessage());
        }
    }
    
    // helper untuk format nama menjadi titlr case (tidak diperlukan lagi di sini, tapi dipertahankan jika digunakan di tempat lain)
    protected function formatNamaRoleUser($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
    
    public function destroy($id)
    {
    try {
        $roleUser = RoleUser::findOrFail($id);
        $roleUser->delete();
        
        return redirect()->route('admin.roleuser.index')
                        ->with('success', 'Role pengguna berhasil dihapus');
    } catch (\Exception $e) {
        return redirect()->route('admin.roleuser.index')
                        ->with('error', 'Gagal menghapus role pengguna: ' . $e->getMessage());
    }
}

    // edit function
    public function edit($id)
    {
        // Ambil data role_user berdasarkan id
        $roleUser = DB::table('role_user')->where('idrole_user', $id)->first();

        // Ambil semua user dan role yang diperlukan untuk dropdown
        $users = DB::table('user')->select('iduser', 'nama')->get();
        $roles = DB::table('role')->select('idrole', 'nama_role')->get();

        return view('admin.role-user.edit', compact('roleUser', 'users', 'roles'));
    }
    // update function
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $this->validateRoleUser($request, $id);

        try {
            // Update data role_user
            DB::table('role_user')
                ->where('idrole_user', $id)
                ->update([
                    'iduser' => $validatedData['iduser'],
                    'idrole' => $validatedData['idrole'],
                    // 'updated_at' => now(), // Jika menggunakan timestamps
                ]);

            return redirect()->route('admin.roleuser.index')
                             ->with('success', 'Role pengguna berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani error jika diperlukan
            throw new \Exception('Gagal memperbarui role pengguna: ' . $e->getMessage());
        }
    }
}