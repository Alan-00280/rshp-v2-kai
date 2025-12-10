<x-teemplate title="Edit Role User - RSHP UNAIR">
<div class="mt-20">
<div class="container mx-auto max-w-md">
    <h1 class="text-center font-bold text-3xl mb-10">Edit Role Pengguna</h1>
    
    <form action="{{ route('admin.roleuser.update', $roleUser->idrole_user) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="iduser">
                Pilih User
            </label>
            <select id="iduser" name="iduser" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($users as $user)
                    <option value="{{ $user->iduser }}" {{ $roleUser->iduser == $user->iduser ? 'selected' : '' }}>
                        {{ $user->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="idrole">
                Pilih Role
            </label>
            <select id="idrole" name="idrole" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($roles as $role)
                    <option value="{{ $role->idrole }}" {{ $roleUser->idrole == $role->idrole ? 'selected' : '' }}>
                        {{ $role->nama_role }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update
            </button>
            <a href="{{ route('admin.roleuser.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Kembali
            </a>
        </div>
    </form>
</div>
</div>
</x-teemplate>