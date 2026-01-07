<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('lansia.index') }}" class="btn btn-outline-secondary me-3"><i
                    class="bi bi-arrow-left"></i></a>
            <h4 class="fw-bold text-warning mb-0">Detail Lansia: {{ $lansia->nama }}</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-person-badge"></i> Informasi Lansia</span>
                    <a href="{{ route('lansia.edit', $lansia) }}" class="btn btn-sm btn-light"><i
                            class="bi bi-pencil"></i> Edit</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Nama</label>
                            <p class="fw-bold">{{ $lansia->nama }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Usia</label>
                            <p>{{ $lansia->usia }} tahun</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Jenis Kelamin</label>
                            <p><span
                                    class="badge bg-{{ $lansia->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">{{ $lansia->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">No. HP</label>
                            <p>{{ $lansia->no_hp ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Golongan Darah</label>
                            <p>{{ $lansia->golongan_darah ?? '-' }}</p>
                        </div>
                        <div class="col-12 mb-3"><label class="form-label text-muted small">Alamat</label>
                            <p>{{ $lansia->alamat }}</p>
                        </div>
                        <div class="col-12"><label class="form-label text-muted small">Riwayat Penyakit</label>
                            <p>{{ $lansia->riwayat_penyakit ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-journal-medical"></i> Catatan Kesehatan</span>
                    <a href="{{ route('catatan.create', ['type' => 'lansia', 'id' => $lansia->id]) }}"
                        class="btn btn-sm btn-light"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @if($lansia->catatanKesehatans->count() > 0)
                        @foreach($lansia->catatanKesehatans->sortByDesc('tanggal')->take(5) as $catatan)
                            <div class="border-bottom pb-2 mb-2">
                                <small class="text-muted">{{ $catatan->tanggal->format('d M Y') }}</small>
                                <p class="mb-1">{{ Str::limit($catatan->catatan, 60) }}</p>
                                @if($catatan->tekanan_darah_sistol)<small class="text-muted">TD:
                                {{ $catatan->tekanan_darah }}</small>@endif
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