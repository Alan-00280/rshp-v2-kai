<x-teemplate title="RSHP - Perawat Dashboard">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Perawat Dashboard') }}</div>

                <div class="card-body">
                    <p>Selamat datang, <strong>{{ session('user_name') }}</strong>! Anda login sebagai <strong>{{ session('user_role_name') }}</strong>.</p>
                    <hr>

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
                                            <td>{{ $pet->nama }}</td>
                                            <td>{{ $pet->pemilik->user->nama ?? 'N/A' }}</td>
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
                </div>
            </div>
        </div>
    </div>
</div>
</x-teemplate>
