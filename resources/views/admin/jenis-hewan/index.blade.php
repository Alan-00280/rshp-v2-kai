<x-teemplate title="Manajemen Jenis Hewan - RSHP UNAIR">

<div class="mb-3">
    <form action="{{ route('admin.jenis-hewan.create') }}" method="GET">
        <button 
            type="submit" 
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-4 py-2 rounded-md shadow transition"
        >
            <i class="fas fa-plus"></i> 
            Tambah Jenis Hewan
        </button>
    </form>
</div>
  


<div class="page-container p-6">
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-700 uppercase text-sm tracking-wider">
                    <th class="py-3 px-4 border-b">ID</th>
                    <th class="py-3 px-4 border-b">Nama Jenis Hewan</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisHewan as $index => $hewan)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $hewan->nama_jenis_hewan }}</td>
                    <td class="py-2 px-4 border-b text-center space-x-2">
                        <button 
                            type="button" 
                            class="inline-flex items-center gap-1 bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold py-1 px-3 rounded transition"
                            onclick="window.location='#'"
                        >
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <button 
                            type="button" 
                            class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold py-1 px-3 rounded transition"
                            onclick="if(confirm('Apakah Anda yakin ingin menghapus jenis hewan ini?')) { document.getElementById('delete-form-{{ $hewan->idjenis_hewan }}').submit(); }"
                        >
                            <i class="fas fa-trash"></i> Hapus
                        </button>

                        <form id="delete-form-{{ $hewan->idjenis_hewan }}" action="#" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

</x-teemplate>