<x-teemplate title="Manajemen Data Pemilik - RSHP UNAIR">

    <div class="page-container">
        <div class="page-header">
            <h1>Manajemen Data Pemilik</h1>
        </div>
        <div class="mb-3">
            <!-- Tombol untuk tambah kategori klinis baru -->
            <form action="{{ route('admin.pemilik.create') }}" method="GET" style="display: inline;">   
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Pemilik Baru
                </button>
            </form>
        </div>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Pemilik</th>
                    <th>No WA</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemilik as $index => $item)
                <tr>
                    <!-- ini penting untuk di front-end -->
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_pemilik }}</td>
                    <td>{{ $item->no_wa }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus pemilik ini?')) { document.getElementById('delete-form-{{ $item->idpemilik }}').submit(); }">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $item->idpemilik }}" action="#" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    <div>
    <footer>
        <p>&copy; Copyright 2025 Universitas Airlangga. All Rights Reserved</p>
    </footer>
    </div>
</x-teemplate>