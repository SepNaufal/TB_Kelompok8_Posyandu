<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('kader.index') }}" class="btn btn-outline-secondary me-3"><i
                    class="bi bi-arrow-left"></i></a>
            <h4 class="fw-bold text-success mb-0">Detail Kader: {{ $kader->nama }}</h4>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-person-badge"></i> Informasi Kader</span>
                    <a href="{{ route('kader.edit', $kader) }}" class="btn btn-sm btn-light"><i
                            class="bi bi-pencil"></i> Edit</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Nama</label>
                            <p class="fw-bold">{{ $kader->nama }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Jabatan</label>
                            <p><span class="badge bg-info">{{ $kader->jabatan }}</span></p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">No. HP</label>
                            <p>{{ $kader->no_hp }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Tanggal Bergabung</label>
                            <p>{{ $kader->tanggal_bergabung ? $kader->tanggal_bergabung->format('d F Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Status</label>
                            <p><span
                                    class="badge bg-{{ $kader->aktif ? 'success' : 'secondary' }}">{{ $kader->aktif ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </p>
                        </div>
                        <div class="col-12"><label class="form-label text-muted small">Alamat</label>
                            <p>{{ $kader->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white"><i class="bi bi-calendar-event"></i> Jadwal yang
                    Ditangani</div>
                <div class="card-body">
                    @if($kader->jadwalPosyandus->count() > 0)
                        @foreach($kader->jadwalPosyandus->sortByDesc('tanggal')->take(5) as $jadwal)
                            <div class="border-bottom pb-2 mb-2">
                                <strong>{{ $jadwal->kegiatan }}</strong>
                                <br><small class="text-muted">{{ $jadwal->tanggal->format('d M Y') }} |
                                    {{ $jadwal->lokasi }}</small>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center mb-0">Belum ada jadwal</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>