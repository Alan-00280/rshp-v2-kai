<x-teemplate title="Manajemen Kode Tindakan Terapi - RSHP UNAIR">


    <div class="page-container">
        <h1>Manajemen Data Kode Tindakan Terapi</h1>
        <div class="mb-3">
            <!-- Tombol untuk tambah kategori klinis baru -->
            <form action="{{ route('admin.kodetindakanterapi.create') }}" method="GET" style="display: inline;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kode Tindakan Baru
                </button>
            </form>
        </div>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Kode Tindakan</th>
                    <th>Deskripsi Tindakan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kodeTindakanTerapi as $index => $item)
                <tr>
                    <!-- pastikan nama yang dipanggil harus sama dengan yang ada di database, jadi jika di database namanya kodeTindakanTerapi maka di panggil juga kodeTindakanTerapi -->
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus kode tindakan ini?')) { document.getElementById('delete-form-{{ $item->idkode_tindakan_terapi }}').submit(); }">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $item->idkode_tindakan_terapi }}" action="#" method="POST" style="display: none;">
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