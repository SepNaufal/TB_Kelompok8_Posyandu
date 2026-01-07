<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('ibu-hamil.index') }}" class="btn btn-outline-secondary me-3"><i class="bi bi-arrow-left"></i></a>
            <h4 class="fw-bold mb-0" style="color: #6f42c1;">Detail Ibu Hamil: {{ $ibuHamil->nama }}</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #6f42c1;">
                    <span><i class="bi bi-person-badge"></i> Informasi Ibu Hamil</span>
                    <a href="{{ route('ibu-hamil.edit', $ibuHamil) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i> Edit</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Nama</label>
                            <p class="fw-bold">{{ $ibuHamil->nama }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Usia</label>
                            <p>{{ $ibuHamil->usia }} tahun</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Usia Kehamilan</label>
                            <p><span class="badge" style="background-color: #6f42c1;">{{ $ibuHamil->usia_kehamilan ?? '-' }} minggu ({{ $ibuHamil->trimester }})</span></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">HPL</label>
                            <p>{{ $ibuHamil->hpl ? $ibuHamil->hpl->format('d F Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Golongan Darah</label>
                            <p>{{ $ibuHamil->golongan_darah ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">No. HP</label>
                            <p>{{ $ibuHamil->no_hp ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted small">Nama Suami</label>
                            <p>{{ $ibuHamil->nama_suami ?? '-' }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted small">Alamat</label>
                            <p>{{ $ibuHamil->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-journal-medical"></i> Catatan Kesehatan</span>
                    <a href="{{ route('catatan.create', ['type' => 'ibu_hamil', 'id' => $ibuHamil->id]) }}" class="btn btn-sm btn-light"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @if($ibuHamil->catatanKesehatans->count() > 0)
                        @foreach($ibuHamil->catatanKesehatans->sortByDesc('tanggal')->take(5) as $catatan)
                            <div class="border-bottom pb-2 mb-2">
                                <small class="text-muted">{{ $catatan->tanggal->format('d M Y') }}</small>
                                <p class="mb-1">{{ Str::limit($catatan->catatan, 60) }}</p>
                                @if($catatan->tekanan_darah_sistol)<small class="text-muted">TD: {{ $catatan->tekanan_darah }}</small>@endif
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
