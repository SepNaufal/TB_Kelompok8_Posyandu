<x-app-layout>
    <x-slot name="header">
        <h4 class="fw-bold text-success mb-0"><i class="bi bi-speedometer2"></i> Dashboard</h4>
    </x-slot>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-6 text-primary mb-2">{{ $stats['balita'] }}</div>
                    <small class="text-muted">Total Balita</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-6 text-purple mb-2" style="color: #6f42c1;">{{ $stats['ibu_hamil'] }}</div>
                    <small class="text-muted">Ibu Hamil</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-6 text-warning mb-2">{{ $stats['lansia'] }}</div>
                    <small class="text-muted">Total Lansia</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-6 text-success mb-2">{{ $stats['kader'] }}</div>
                    <small class="text-muted">Kader Aktif</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-6 text-info mb-2">{{ $stats['jadwal_mendatang'] }}</div>
                    <small class="text-muted">Jadwal Mendatang</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="display-6 text-danger mb-2">{{ $stats['catatan_bulan_ini'] }}</div>
                    <small class="text-muted">Catatan Bulan Ini</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Jadwal Mendatang -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-calendar-event"></i> Jadwal Posyandu Mendatang
                </div>
                <div class="card-body">
                    @if($jadwalMendatang->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($jadwalMendatang as $jadwal)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <strong>{{ $jadwal->kegiatan }}</strong>
                                        <br><small class="text-muted">{{ $jadwal->tanggal->format('d M Y') }} |
                                            {{ $jadwal->lokasi }}</small>
                                    </div>
                                    <span
                                        class="badge bg-{{ $jadwal->status == 'Dijadwalkan' ? 'primary' : 'success' }}">{{ $jadwal->status }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">Tidak ada jadwal mendatang</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Catatan Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <i class="bi bi-journal-medical"></i> Catatan Kesehatan Terbaru
                </div>
                <div class="card-body">
                    @if($catatanTerbaru->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($catatanTerbaru as $catatan)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between">
                                        <strong>{{ $catatan->catatantable?->nama ?? 'Data Dihapus' }}</strong>
                                        <small class="text-muted">{{ $catatan->tanggal->format('d M Y') }}</small>
                                    </div>
                                    <small class="text-muted">{{ Str::limit($catatan->catatan, 50) }}</small>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">Belum ada catatan kesehatan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>