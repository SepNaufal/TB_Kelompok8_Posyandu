<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('catatan.index') }}" class="btn btn-outline-secondary me-3"><i
                    class="bi bi-arrow-left"></i></a>
            <h4 class="fw-bold text-danger mb-0">Detail Catatan Kesehatan</h4>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-journal-medical"></i> Informasi Catatan</span>
                    <a href="{{ route('catatan.edit', $catatan) }}" class="btn btn-sm btn-light"><i
                            class="bi bi-pencil"></i> Edit</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Tanggal</label>
                            <p class="fw-bold">{{ $catatan->tanggal->format('d F Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Tipe Pasien</label>
                            <p><span class="badge bg-{{ $catatan->type_label == 'Balita' ? 'primary' : ($catatan->type_label == 'Ibu Hamil' ? 'purple' : 'warning') }}"
                                    style="{{ $catatan->type_label == 'Ibu Hamil' ? 'background-color:#6f42c1;' : '' }}">{{ $catatan->type_label }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Nama Pasien</label>
                            <p class="fw-bold">{{ $catatan->catatantable?->nama ?? 'Data Dihapus' }}</p>
                        </div>
                    </div>
                    <hr>
                    <h6 class="text-muted mb-3">Data Kesehatan</h6>
                    <div class="row">
                        <div class="col-md-4 mb-3"><label class="form-label text-muted small">Berat Badan</label>
                            <p>{{ $catatan->berat_badan ? $catatan->berat_badan . ' kg' : '-' }}</p>
                        </div>
                        <div class="col-md-4 mb-3"><label class="form-label text-muted small">Tinggi Badan</label>
                            <p>{{ $catatan->tinggi_badan ? $catatan->tinggi_badan . ' cm' : '-' }}</p>
                        </div>
                        <div class="col-md-4 mb-3"><label class="form-label text-muted small">Suhu Tubuh</label>
                            <p>{{ $catatan->suhu_tubuh ? $catatan->suhu_tubuh . ' °C' : '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3"><label class="form-label text-muted small">Tekanan Darah</label>
                            <p>{{ $catatan->tekanan_darah ?? '-' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 mb-3"><label class="form-label text-muted small">Catatan</label>
                            <p>{{ $catatan->catatan }}</p>
                        </div>
                        <div class="col-12"><label class="form-label text-muted small">Tindakan</label>
                            <p>{{ $catatan->tindakan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>