<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center">
            <a href="{{ route('catatan.index') }}" class="btn btn-outline-secondary me-3"><i
                    class="bi bi-arrow-left"></i></a>
            <h4 class="fw-bold text-danger mb-0">Tambah Catatan Kesehatan</h4>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-danger text-white"><i class="bi bi-plus-circle"></i> Form Tambah Catatan
                </div>
                <div class="card-body">
                    <form action="{{ route('catatan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal" class="form-label">Tanggal <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                                    max="{{ date('Y-m-d') }}" required>
                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="catatantable_type" class="form-label">Tipe Pasien <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('catatantable_type') is-invalid @enderror"
                                    id="catatantable_type" name="catatantable_type" required
                                    onchange="updatePatientList()">
                                    <option value="">Pilih Tipe</option>
                                    <option value="App\Models\Balita" {{ old('catatantable_type', $type == 'balita' ? 'App\Models\Balita' : '') == 'App\Models\Balita' ? 'selected' : '' }}>Balita
                                    </option>
                                    <option value="App\Models\IbuHamil" {{ old('catatantable_type', $type == 'ibu_hamil' ? 'App\Models\IbuHamil' : '') == 'App\Models\IbuHamil' ? 'selected' : '' }}>Ibu
                                        Hamil</option>
                                    <option value="App\Models\Lansia" {{ old('catatantable_type', $type == 'lansia' ? 'App\Models\Lansia' : '') == 'App\Models\Lansia' ? 'selected' : '' }}>Lansia
                                    </option>
                                </select>
                                @error('catatantable_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="catatantable_id" class="form-label">Nama Pasien <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('catatantable_id') is-invalid @enderror"
                                    id="catatantable_id" name="catatantable_id" required>
                                    <option value="">Pilih Pasien</option>
                                </select>
                                @error('catatantable_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                <input type="number" step="0.01" class="form-control" id="berat_badan"
                                    name="berat_badan" value="{{ old('berat_badan') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" step="0.01" class="form-control" id="tinggi_badan"
                                    name="tinggi_badan" value="{{ old('tinggi_badan') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tekanan_darah_sistol" class="form-label">TD Sistol</label>
                                <input type="number" class="form-control" id="tekanan_darah_sistol"
                                    name="tekanan_darah_sistol" value="{{ old('tekanan_darah_sistol') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="tekanan_darah_diastol" class="form-label">TD Diastol</label>
                                <input type="number" class="form-control" id="tekanan_darah_diastol"
                                    name="tekanan_darah_diastol" value="{{ old('tekanan_darah_diastol') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="suhu_tubuh" class="form-label">Suhu Tubuh (°C)</label>
                                <input type="number" step="0.1" class="form-control" id="suhu_tubuh" name="suhu_tubuh"
                                    value="{{ old('suhu_tubuh') }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="catatan" class="form-label">Catatan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan"
                                    name="catatan" rows="3" required>{{ old('catatan') }}</textarea>
                                @error('catatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="tindakan" class="form-label">Tindakan</label>
                                <textarea class="form-control" id="tindakan" name="tindakan"
                                    rows="2">{{ old('tindakan') }}</textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('catatan.index') }}" class="btn btn-secondary"><i class="bi bi-x-lg"></i>
                                Batal</a>
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const balitas = @json($balitas);
        const ibuHamils = @json($ibuHamils);
        const lansias = @json($lansias);
        const oldId = {{ old('catatantable_id', $subject?->id ?? 'null') }};

        function updatePatientList() {
            const type = document.getElementById('catatantable_type').value;
            const select = document.getElementById('catatantable_id');
            select.innerHTML = '<option value="">Pilih Pasien</option>';

            let data = [];
            if (type === 'App\\Models\\Balita') data = balitas;
            else if (type === 'App\\Models\\IbuHamil') data = ibuHamils;
            else if (type === 'App\\Models\\Lansia') data = lansias;

            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.nama;
                if (item.id == oldId) option.selected = true;
                select.appendChild(option);
            });
        }

        document.addEventListener('DOMContentLoaded', updatePatientList);
    </script>
</x-app-layout>