<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary me-3"><i
                    class="bi bi-arrow-left"></i></a>
            <h4 class="fw-bold text-info mb-0">Detail Jadwal</h4>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-calendar-event"></i> Informasi Jadwal</span>
                    <a href="{{ route('jadwal.edit', $jadwal) }}" class="btn btn-sm btn-light"><i
                            class="bi bi-pencil"></i> Edit</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Kegiatan</label>
                            <p class="fw-bold">{{ $jadwal->kegiatan }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Status</label>
                            <p><span
                                    class="badge bg-{{ $jadwal->status == 'Dijadwalkan' ? 'primary' : ($jadwal->status == 'Selesai' ? 'success' : ($jadwal->status == 'Berlangsung' ? 'warning' : 'danger')) }}">{{ $jadwal->status }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Tanggal</label>
                            <p>{{ $jadwal->tanggal->format('d F Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Waktu</label>
                            <p>{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Lokasi</label>
                            <p>{{ $jadwal->lokasi }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Kader Penanggung
                                Jawab</label>
                            <p>{{ $jadwal->kader?->nama ?? '-' }}</p>
                        </div>
                        <div class="col-12"><label class="form-label text-muted small">Keterangan</label>
                            <p>{{ $jadwal->keterangan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>