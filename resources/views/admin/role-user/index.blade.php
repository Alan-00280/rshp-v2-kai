<x-teemplate title="Manajemen Data Role Pengguna - RSHP UNAIR">
<div class="mt-20">
<div class="container mx-auto">
    <h1 class="text-center font-bold text-3xl mb-10">Manajemen Data Role Pengguna</h1>
    
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="mb-6">
        <form action="{{ route('admin.roleuser.create') }}" method="GET">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                <i class="fas fa-plus"></i> Tambah Role Pengguna Baru
            </button>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pengguna</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Role</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($roleUsers as $index => $item)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->nama_user }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_role }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button type="button" 
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2 transition duration-150 ease-in-out" 
                                onclick="window.location='{{ route('admin.roleuser.edit', $item->idrole_user) }}'">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" 
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded transition duration-150 ease-in-out" 
                                onclick="confirmDelete({{ $item->idrole_user }})">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $item->idrole_user }}" 
                              action="{{ route('admin.roleuser.delete', $item->idrole_user) }}" 
                              method="POST" 
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada data role pengguna
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>

<script>
function confirmDelete(id) {
    if(confirm('Apakah Anda yakin ingin menghapus role pengguna ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
</x-teemplate>