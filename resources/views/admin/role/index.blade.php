<x-teemplate title="Manajemen Data Role - RSHP UNAIR">
<div class="mt-20">
    <div class="container mx-auto">
        <h1 class="text-center font-bold text-3xl mb-10">Manajemen Data Role</h1>
        
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
            <form action="{{ route('admin.role.create') }}" method="GET">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                    <i class="fas fa-plus"></i> Tambah Role Baru
                </button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Role</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Role</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($roles as $index => $item)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->idrole }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button type="button" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2 transition duration-150 ease-in-out" onclick="window.location='{{ route('admin.role.edit', $item->idrole) }}'">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded transition duration-150 ease-in-out" onclick="if(confirm('Apakah Anda yakin ingin menghapus role ini?')) { document.getElementById('delete-form-{{ $item->idrole }}').submit(); }">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            <form id="delete-form-{{ $item->idrole }}" action="{{ route('admin.role.delete', $item->idrole) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data role
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-teemplate>