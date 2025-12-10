<x-teemplate title="Edit Role - RSHP UNAIR">
<div class="mt-20">
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-center font-bold text-3xl mb-10">Edit Role</h1>
        
        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <form action="{{ route('admin.role.update', $role->idrole) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_role">
                        Nama Role <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama_role"
                           name="nama_role"
                           value="{{ old('nama_role', $role->nama_role) }}"
                           placeholder="Masukkan nama role"
                           class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 @error('nama_role') border-red-500 @enderror"
                           required>
                    @error('nama_role')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-600 text-xs italic mt-2">Contoh: Administrator, Dokter, Resepsionis, Perawat</p>
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('admin.role.index') }}" 
                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                        <i class="fas fa-save mr-2"></i>Update
                    </button>
                </div>
            </form>
        </div>

        <!-- Warning Box -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
            <p class="font-bold">Peringatan:</p>
            <p class="text-sm">Perubahan nama role akan berpengaruh pada sistem manajemen hak akses. Pastikan perubahan sudah sesuai.</p>
        </div>
    </div>
</div>
</x-teemplate>