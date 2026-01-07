<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('lansia.index') }}" class="text-gray-500 hover:text-gray-700 mr-4"><svg class="w-6 h-6"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg></a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Data Lansia</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <form action="{{ route('lansia.update', $lansia) }}" method="POST" class="p-6 space-y-6">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label for="nama" class="block text-sm font-medium text-gray-700">Nama <span
                                    class="text-red-500">*</span></label><input type="text" name="nama" id="nama"
                                value="{{ old('nama', $lansia->nama) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir
                                <span class="text-red-500">*</span></label><input type="date" name="tanggal_lahir"
                                id="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $lansia->tanggal_lahir->format('Y-m-d')) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin
                                <span class="text-red-500">*</span></label><select name="jenis_kelamin"
                                id="jenis_kelamin" required class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="">Pilih</option>
                                <option value="L" {{ old('jenis_kelamin', $lansia->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $lansia->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select></div>
                        <div><label for="no_hp" class="block text-sm font-medium text-gray-700">No. HP</label><input
                                type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $lansia->no_hp) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="golongan_darah" class="block text-sm font-medium text-gray-700">Golongan
                                Darah</label><select name="golongan_darah" id="golongan_darah"
                                class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="">Pilih</option>@foreach(['A', 'B', 'AB', 'O'] as $gd)<option
                                value="{{ $gd }}" {{ old('golongan_darah', $lansia->golongan_darah) == $gd ? 'selected' : '' }}>{{ $gd }}</option>@endforeach
                            </select></div>
                    </div>
                    <div><label for="alamat" class="block text-sm font-medium text-gray-700">Alamat <span
                                class="text-red-500">*</span></label><textarea name="alamat" id="alamat" rows="2"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300">{{ old('alamat', $lansia->alamat) }}</textarea>
                    </div>
                    <div><label for="riwayat_penyakit" class="block text-sm font-medium text-gray-700">Riwayat
                            Penyakit</label><textarea name="riwayat_penyakit" id="riwayat_penyakit" rows="2"
                            class="mt-1 block w-full rounded-lg border-gray-300">{{ old('riwayat_penyakit', $lansia->riwayat_penyakit) }}</textarea>
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('lansia.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-lg">Batal</a>
                        <button type="submit"
                            class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-6 rounded-lg">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>