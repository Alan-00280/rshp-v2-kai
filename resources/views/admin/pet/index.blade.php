<x-teemplate title="Manajemen Data Hewan - RSHP UNAIR">

<div class="page-container">
    <div class ="page-header">
        <h1>Manajemen Data Hewan</h1>
    </div>
    <div class="mb-3">
        <!-- Tombol untuk tambah kategori klinis baru -->   
        <form action="{{ route('admin.pet.create') }}" method="GET" style="display: inline;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Hewan Baru
            </button>
        </form>
    </div>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Hewan</th>
                    <th>Tanggal Lahir</th>
                    <th>Warna Tanda</th>
                    <th>Jenis Kelamin</th>
                    <th>Ras Hewan</th>
                    <th>Nama Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pets as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $item->warna_tanda }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->ras->nama_ras ?? 'N/A' }}</td> {{-- Menggunakan null coalescing operator untuk menghindari error jika relasi ras tidak ada --}}
                    <td>{{ $item->pemilik->user->nama ?? 'N/A' }}</td> {{-- Menggunakan null coalescing operator untuk menghindari error jika relasi pemilik atau user tidak ada --}}
                    <td>
                       <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus hewan ini?')) { document.getElementById('delete-form-{{ $item->idpet }}').submit(); }">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        <form id="delete-form-{{ $item->idpet }}" action="#" method="POST" style="display: none;">
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
