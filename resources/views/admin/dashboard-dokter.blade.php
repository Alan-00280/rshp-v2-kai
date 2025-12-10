<x-teemplate>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dokter Dashboard') }}</div>

                <div class="card-body">
                    <p>Selamat datang, <strong>{{ session('user_name') }}</strong>! Anda login sebagai <strong>{{ session('user_role_name') }}</strong>.</p>
                    <hr>

                    {{-- Data Hewan Peliharaan --}}
                    <div class="mt-4">
                        <h5>Data Hewan Peliharaan (Pet)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Hewan</th>
                                        <th>Pemilik</th>
                                        <th>Ras</th>
                                        <th>Tanggal Lahir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pets as $pet)
                                        <tr>
                                            <td>{{ $pet->nama_pet }}</td>
                                            <td>{{ $pet->pemilik->user->name ?? 'N/A' }}</td>
                                            <td>{{ $pet->ras->nama_ras ?? 'N/A' }}</td>
                                            <td>{{ $pet->tanggal_lahir }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data hewan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Data Kategori Klinis --}}
                    <div class="mt-4">
                        <h5>Data Kategori Klinis</h5>
                        <ul class="list-group">
                            @forelse ($kategoriKlinis as $item)
                                <li class="list-group-item">{{ $item->nama_kategori_klinis }}</li>
                            @empty
                                <li class="list-group-item">Tidak ada data kategori klinis.</li>
                            @endforelse
                        </ul>
                    </div>

                    {{-- Data Kode Tindakan Terapi --}}
                    <div class="mt-4">
                        <h5>Data Kode Tindakan Terapi</h5>
                        <ul class="list-group">
                            @forelse ($kodeTindakanTerapi as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $item->deskripsi }}
                                    <span class="badge bg-primary rounded-pill">{{ $item->kode_tindakan }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">Tidak ada data kode tindakan terapi.</li>
                            @endforelse
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</x-teemplate>
