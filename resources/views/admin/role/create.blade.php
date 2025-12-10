<x-teemplate title="Tambah Role Baru - RSHP UNAIR">
<div class="mt-20">
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-center font-bold text-3xl mb-10">Tambah Role Baru</h1>
        
        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_role">
                        Nama Role <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama_role"
                           name="nama_role"
                           value="{{ old('nama_role') }}"
                           placeholder="Masukkan nama role"
                           class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 @error('nama_role') border-red-500 @enderror"
                           required>
                    @error('nama_role')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('admin.role.index') }}" 
                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 rounded" role="alert">
            <p class="font-bold">Informasi:</p>
            <p class="text-sm">Role digunakan untuk mengatur hak akses pengguna dalam sistem. Contoh: Administrator, Dokter, Resepsionis, dll.</p>
        </div>
    </div>
</div>
</x-teemplate>