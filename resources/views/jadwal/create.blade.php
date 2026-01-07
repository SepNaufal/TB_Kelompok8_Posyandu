<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary me-3"><i
                    class="bi bi-arrow-left"></i></a>
            <h4 class="fw-bold text-info mb-0">Tambah Jadwal Posyandu</h4>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white"><i class="bi bi-plus-circle"></i> Form Tambah Jadwal</div>
                <div class="card-body">
                    <form action="{{ route('jadwal.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="waktu_mulai" class="form-label">Waktu Mulai <span
                                        class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                    id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required>
                                @error('waktu_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="waktu_selesai" class="form-label">Waktu Selesai <span
                                        class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror"
                                    id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required>
                                @error('waktu_selesai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kegiatan" class="form-label">Kegiatan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kegiatan') is-invalid @enderror"
                                    id="kegiatan" name="kegiatan" value="{{ old('kegiatan') }}" required>
                                @error('kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                                @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kader_id" class="form-label">Kader Penanggung Jawab</label>
                                <select class="form-select" id="kader_id" name="kader_id">
                                    <option value="">Pilih Kader</option>
                                    @foreach($kaders as $kader)
                                        <option value="{{ $kader->id }}" {{ old('kader_id') == $kader->id ? 'selected' : '' }}>{{ $kader->nama }} ({{ $kader->jabatan }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    @foreach(['Dijadwalkan', 'Berlangsung', 'Selesai', 'Dibatalkan'] as $s)
                                        <option value="{{ $s }}" {{ old('status', 'Dijadwalkan') == $s ? 'selected' : '' }}>
                                            {{ $s }}</option>
                                    @endforeach
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"
                                    rows="2">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary"><i class="bi bi-x-lg"></i>
                                Batal</a>
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>