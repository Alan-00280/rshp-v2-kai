<x-teemplate title="RSHP - Resepsionis Dashboard">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <!-- Card Registrasi -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Registrasi Baru</h5>
                    </div>
                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(isset($showStep2) && $showStep2)
                            <!-- LANGKAH 2: Data Hewan -->
                            <form method="POST" action="{{ route('dashboard') }}">
                                @csrf
                                <input type="hidden" name="step" value="2">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Pet</label>
                                            <input type="text" name="nama_pet" class="form-control" value="{{ old('nama_pet') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Ras Hewan</label>
                                            <select name="ras_id" class="form-select" required>
                                                <option value="">-- Pilih Ras --</option>
                                                @foreach($listRas as $ras)
                                                    <option value="{{ $ras->id }}" {{ old('ras_id') == $ras->id ? 'selected' : '' }}>
                                                        {{ $ras->nama_ras }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="jantan" {{ old('jenis_kelamin') == 'jantan' ? 'checked' : '' }} required>
                                                <label class="form-check-label">Jantan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="betina" {{ old('jenis_kelamin') == 'betina' ? 'checked' : '' }} required>
                                                <label class="form-check-label">Betina</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Warna / Tanda Khusus</label>
                                    <textarea name="warna_tanda" class="form-control" rows="2" placeholder="Contoh: Coklat dengan kaos kaki putih">{{ old('warna_tanda') }}</textarea>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" name="kembali" value="1" formaction="{{ route('dashboard') }}" class="btn btn-secondary">
                                        ← Kembali ke Data Pemilik
                                    </button>
                                    <button type="submit" class="btn btn-success">Simpan Data Pet & Selesai</button>
                                </div>
                            </form>

                        @else
                            <!-- LANGKAH 1: Data Pemilik -->
                            <form method="POST" action="{{ route('dashboard') }}">
                                @csrf
                                <input type="hidden" name="step" value="1">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Pemilik</label>
                                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nomor WhatsApp</label>
                                            <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" placeholder="contoh: 081234567890" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Lanjut ke Data Pet →</button>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>

                <!-- Card Dashboard Data -->
                <div class="card">
                    <div class="card-header">
                        {{ __('Resepsionis Dashboard') }}
                    </div>
                    <div class="card-body">
                        <p>Selamat datang, <strong>{{ session('user_name') }}</strong>! Anda login sebagai <strong>{{ session('user_role_name') }}</strong>.</p>
                        <hr>

                        {{-- Data Pemilik --}}
                        <div class="mt-4">
                            <h5>Data Pemilik</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Pemilik</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pemilik as $item)
                                        <tr>
                                            <td>{{ $item->user->nama ?? 'N/A' }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->telepon }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data pemilik.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pets as $pet)
                                        <tr>
                                            <td>{{ $pet->nama }}</td>
                                            <td>{{ $pet->pemilik->user->nama ?? 'N/A' }}</td>
                                            <td>{{ $pet->ras->nama_ras ?? 'N/A' }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data hewan.</td>
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
</x-template>