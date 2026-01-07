<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('jadwal.index') }}" class="text-gray-500 hover:text-gray-700 mr-4"><svg class="w-6 h-6"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg></a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Jadwal Posyandu</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <form action="{{ route('jadwal.update', $jadwal) }}" method="POST" class="p-6 space-y-6">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal <span
                                    class="text-red-500">*</span></label><input type="date" name="tanggal" id="tanggal"
                                value="{{ old('tanggal', $jadwal->tanggal->format('Y-m-d')) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi <span
                                    class="text-red-500">*</span></label><input type="text" name="lokasi" id="lokasi"
                                value="{{ old('lokasi', $jadwal->lokasi) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai <span
                                    class="text-red-500">*</span></label><input type="time" name="waktu_mulai"
                                id="waktu_mulai"
                                value="{{ old('waktu_mulai', \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i')) }}"
                                required class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai
                                <span class="text-red-500">*</span></label><input type="time" name="waktu_selesai"
                                id="waktu_selesai"
                                value="{{ old('waktu_selesai', \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i')) }}"
                                required class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="kegiatan" class="block text-sm font-medium text-gray-700">Kegiatan <span
                                    class="text-red-500">*</span></label><input type="text" name="kegiatan"
                                id="kegiatan" value="{{ old('kegiatan', $jadwal->kegiatan) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="kader_id" class="block text-sm font-medium text-gray-700">Kader
                                PJ</label><select name="kader_id" id="kader_id"
                                class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="">Pilih</option>@foreach($kaders as $kader)<option
                                value="{{ $kader->id }}" {{ old('kader_id', $jadwal->kader_id) == $kader->id ? 'selected' : '' }}>{{ $kader->nama }}</option>@endforeach
                            </select></div>
                        <div><label for="status" class="block text-sm font-medium text-gray-700">Status <span
                                    class="text-red-500">*</span></label><select name="status" id="status" required
                                class="mt-1 block w-full rounded-lg border-gray-300">@foreach(['Dijadwalkan', 'Berlangsung', 'Selesai', 'Dibatalkan'] as $s)
                                    <option value="{{ $s }}" {{ old('status', $jadwal->status) == $s ? 'selected' : '' }}>
                                {{ $s }}</option>@endforeach</select></div>
                    </div>
                    <div><label for="keterangan"
                            class="block text-sm font-medium text-gray-700">Keterangan</label><textarea
                            name="keterangan" id="keterangan" rows="2"
                            class="mt-1 block w-full rounded-lg border-gray-300">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('jadwal.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-lg">Batal</a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>