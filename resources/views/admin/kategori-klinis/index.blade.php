<x-teemplate title="Manajemen Kategori Klinis - RSHP UNAIR">
 <div class="mb-3">
    <h1>Manajemen Data Kategori Klinis</h1>
    <!-- Tombol untuk tambah kategori klinis baru -->
    <form action="{{ route('admin.kategoriklinis.create') }}" method="GET" style="display: inline;">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kategori Klinis Baru
        </button>
    </form>
</div>


<div class="page-container">

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Kategori Klinis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($KategoriKlinis as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kategori_klinis }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus kategori klinis ini?')) { document.getElementById('delete-form-{{ $item->idkategori_klinis }}').submit(); }">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $item->idkategori_klinis }}" action="#" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
    </div>
    <footer>
        <p>&copy; Copyright 2025 Universitas Airlangga. All Rights Reserved</p>
    </footer>
</x-teemplate>
