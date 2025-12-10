<x-teemplate title="Tambah Role User - RSHP UNAIR">
<div class="mt-20">
    <div class="container mx-auto max-w-2xl">
        <h1 class="text-center font-bold text-3xl mb-10">Tambah Role User Baru</h1>
        
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

            <form action="{{ route('admin.roleuser.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="iduser">
                        Pilih User <span class="text-red-500">*</span>
                    </label>
                    <select id="iduser" 
                            name="iduser" 
                            class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 @error('iduser') border-red-500 @enderror" 
                            required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                {{ $user->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="idrole">
                        Pilih Role <span class="text-red-500">*</span>
                    </label>
                    <select id="idrole" 
                            name="idrole" 
                            class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500 @error('idrole') border-red-500 @enderror" 
                            required>
                        <option value="">-- Pilih Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->idrole }}" {{ old('idrole') == $role->idrole ? 'selected' : '' }}>
                                {{ $role->nama_role }}
                            </option>
                        @endforeach
                    </select>
                    @error('idrole')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-8">
                    <a href="{{ route('admin.roleuser.index') }}" 
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
            <p class="text-sm">Pastikan Anda memilih user dan role dengan benar. Setiap user dapat memiliki lebih dari satu role.</p>
        </div>
    </div>
</div>
</x-teemplate>