<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('catatan.index') }}" class="text-gray-500 hover:text-gray-700 mr-4"><svg class="w-6 h-6"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg></a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Catatan Kesehatan</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <form action="{{ route('catatan.update', $catatan) }}" method="POST" class="p-6 space-y-6">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label for="catatantable_type" class="block text-sm font-medium text-gray-700">Tipe Pasien
                                <span class="text-red-500">*</span></label>
                            <select name="catatantable_type" id="catatantable_type" required
                                class="mt-1 block w-full rounded-lg border-gray-300"
                                onchange="updatePatientList(this.value)">
                                <option value="App\Models\Balita" {{ old('catatantable_type', $catatan->catatantable_type) == 'App\Models\Balita' ? 'selected' : '' }}>Balita
                                </option>
                                <option value="App\Models\IbuHamil" {{ old('catatantable_type', $catatan->catatantable_type) == 'App\Models\IbuHamil' ? 'selected' : '' }}>Ibu Hamil
                                </option>
                                <option value="App\Models\Lansia" {{ old('catatantable_type', $catatan->catatantable_type) == 'App\Models\Lansia' ? 'selected' : '' }}>Lansia
                                </option>
                            </select>
                        </div>
                        <div><label for="catatantable_id" class="block text-sm font-medium text-gray-700">Nama Pasien
                                <span class="text-red-500">*</span></label>
                            <select name="catatantable_id" id="catatantable_id" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></select>
                        </div>
                        <div><label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal <span
                                    class="text-red-500">*</span></label><input type="date" name="tanggal" id="tanggal"
                                value="{{ old('tanggal', $catatan->tanggal->format('Y-m-d')) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                    </div>
                    <div><label for="catatan" class="block text-sm font-medium text-gray-700">Catatan <span
                                class="text-red-500">*</span></label><textarea name="catatan" id="catatan" rows="3"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300">{{ old('catatan', $catatan->catatan) }}</textarea>
                    </div>
                    <div><label for="tindakan" class="block text-sm font-medium text-gray-700">Tindakan</label><textarea
                            name="tindakan" id="tindakan" rows="2"
                            class="mt-1 block w-full rounded-lg border-gray-300">{{ old('tindakan', $catatan->tindakan) }}</textarea>
                    </div>

                    <div class="border-t pt-6">
                        <h4 class="font-medium text-gray-700 mb-4">Data Pemeriksaan</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div><label for="berat_badan" class="block text-sm font-medium text-gray-700">BB
                                    (kg)</label><input type="number" step="0.01" name="berat_badan" id="berat_badan"
                                    value="{{ old('berat_badan', $catatan->berat_badan) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300"></div>
                            <div><label for="tinggi_badan" class="block text-sm font-medium text-gray-700">TB
                                    (cm)</label><input type="number" step="0.01" name="tinggi_badan" id="tinggi_badan"
                                    value="{{ old('tinggi_badan', $catatan->tinggi_badan) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300"></div>
                            <div><label for="tekanan_darah_sistol"
                                    class="block text-sm font-medium text-gray-700">Sistol</label><input type="number"
                                    name="tekanan_darah_sistol" id="tekanan_darah_sistol"
                                    value="{{ old('tekanan_darah_sistol', $catatan->tekanan_darah_sistol) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300"></div>
                            <div><label for="tekanan_darah_diastol"
                                    class="block text-sm font-medium text-gray-700">Diastol</label><input type="number"
                                    name="tekanan_darah_diastol" id="tekanan_darah_diastol"
                                    value="{{ old('tekanan_darah_diastol', $catatan->tekanan_darah_diastol) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300"></div>
                            <div><label for="suhu_tubuh" class="block text-sm font-medium text-gray-700">Suhu
                                    (°C)</label><input type="number" step="0.1" name="suhu_tubuh" id="suhu_tubuh"
                                    value="{{ old('suhu_tubuh', $catatan->suhu_tubuh) }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('catatan.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-lg">Batal</a>
                        <button type="submit"
                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-6 rounded-lg">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const balitas = @json($balitas);
        const ibuHamils = @json($ibuHamils);
        const lansias = @json($lansias);
        const currentId = {{ $catatan->catatantable_id }};

        function updatePatientList(type) {
            const select = document.getElementById('catatantable_id');
            select.innerHTML = '<option value="">Pilih Pasien</option>';
            let data = [];
            if (type === 'App\\Models\\Balita') data = balitas;
            else if (type === 'App\\Models\\IbuHamil') data = ibuHamils;
            else if (type === 'App\\Models\\Lansia') data = lansias;
            data.forEach(item => {
                const selected = item.id == currentId ? 'selected' : '';
                select.innerHTML += `<option value="${item.id}" ${selected}>${item.nama}</option>`;
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('catatantable_type');
            if (typeSelect.value) updatePatientList(typeSelect.value);
        });
    </script>
</x-app-layout>