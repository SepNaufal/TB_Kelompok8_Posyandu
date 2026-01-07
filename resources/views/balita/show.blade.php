<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('balita.index') }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4 class="fw-bold text-primary mb-0">Detail Balita: {{ $balita->nama }}</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-lg-8">
            <!-- Info Balita -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-person-badge"></i> Informasi Balita</span>
                    <a href="{{ route('balita.edit', $balita) }}" class="btn btn-sm btn-light">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Nama</label>
                            <p class="fw-bold">{{ $balita->nama }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Usia</label>
                            <p class="fw-bold">{{ $balita->usia_lengkap }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Tanggal Lahir</label>
                            <p>{{ $balita->tanggal_lahir->format('d F Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Jenis Kelamin</label>
                            <p>
                                <span class="badge bg-{{ $balita->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">
                                    {{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Nama Orang Tua</label>
                            <p>{{ $balita->nama_ortu }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">NIK</label>
                            <p>{{ $balita->nik ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Berat Badan</label>
                            <p>{{ $balita->berat_badan ?? '-' }} kg</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Tinggi Badan</label>
                            <p>{{ $balita->tinggi_badan ?? '-' }} cm</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted small">Alamat</label>
                            <p>{{ $balita->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Catatan Kesehatan -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-journal-medical"></i> Catatan Kesehatan</span>
                    <a href="{{ route('catatan.create', ['type' => 'balita', 'id' => $balita->id]) }}"
                        class="btn btn-sm btn-light">
                        <i class="bi bi-plus"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if($balita->catatanKesehatans->count() > 0)
                        @foreach($balita->catatanKesehatans->sortByDesc('tanggal')->take(5) as $catatan)
                            <div class="border-bottom pb-2 mb-2">
                                <small class="text-muted">{{ $catatan->tanggal->format('d M Y') }}</small>
                                <p class="mb-1">{{ Str::limit($catatan->catatan, 60) }}</p>
                                <a href="{{ route('catatan.show', $catatan) }}"
                                    class="btn btn-sm btn-outline-primary">Detail</a>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center mb-0">Belum ada catatan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>