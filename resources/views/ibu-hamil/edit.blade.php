<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('ibu-hamil.index') }}" class="btn btn-outline-secondary me-3"><i
                    class="bi bi-arrow-left"></i></a>
            <h4 class="fw-bold mb-0" style="color: #6f42c1;">Edit Data Ibu Hamil</h4>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <i class="bi bi-pencil"></i> Form Edit Ibu Hamil
                </div>
                <div class="card-body">
                    <form action="{{ route('ibu-hamil.update', $ibuHamil) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="{{ old('nama', $ibuHamil->nama) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $ibuHamil->tanggal_lahir->format('Y-m-d')) }}"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="{{ old('no_hp', $ibuHamil->no_hp) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                <select class="form-select" id="golongan_darah" name="golongan_darah">
                                    <option value="">Pilih</option>
                                    @foreach(['A', 'B', 'AB', 'O'] as $gd)
                                        <option value="{{ $gd }}" {{ old('golongan_darah', $ibuHamil->golongan_darah) == $gd ? 'selected' : '' }}>{{ $gd }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="usia_kehamilan" class="form-label">Usia Kehamilan (minggu)</label>
                                <input type="number" class="form-control" id="usia_kehamilan" name="usia_kehamilan"
                                    value="{{ old('usia_kehamilan', $ibuHamil->usia_kehamilan) }}" min="1" max="42">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="hpl" class="form-label">HPL</label>
                                <input type="date" class="form-control" id="hpl" name="hpl"
                                    value="{{ old('hpl', $ibuHamil->hpl?->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_suami" class="form-label">Nama Suami</label>
                                <input type="text" class="form-control" id="nama_suami" name="nama_suami"
                                    value="{{ old('nama_suami', $ibuHamil->nama_suami) }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                    required>{{ old('alamat', $ibuHamil->alamat) }}</textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('ibu-hamil.index') }}" class="btn btn-secondary"><i
                                    class="bi bi-x-lg"></i> Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i>
                                Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>