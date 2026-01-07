<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('ibu-hamil.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Ibu Hamil</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <form action="{{ route('ibu-hamil.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 @error('nama') border-red-500 @enderror">
                            @error('nama')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir
                                <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}" required max="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 @error('tanggal_lahir') border-red-500 @enderror">
                            @error('tanggal_lahir')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700">No. HP</label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label for="golongan_darah" class="block text-sm font-medium text-gray-700">Golongan
                                Darah</label>
                            <select name="golongan_darah" id="golongan_darah"
                                class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="">Pilih</option>
                                <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>
                        <div>
                            <label for="usia_kehamilan" class="block text-sm font-medium text-gray-700">Usia Kehamilan
                                (minggu)</label>
                            <input type="number" name="usia_kehamilan" id="usia_kehamilan"
                                value="{{ old('usia_kehamilan') }}" min="1" max="42"
                                class="mt-1 block w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label for="hpl" class="block text-sm font-medium text-gray-700">Hari Perkiraan Lahir
                                (HPL)</label>
                            <input type="date" name="hpl" id="hpl" value="{{ old('hpl') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label for="nama_suami" class="block text-sm font-medium text-gray-700">Nama Suami</label>
                            <input type="text" name="nama_suami" id="nama_suami" value="{{ old('nama_suami') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300">
                        </div>
                    </div>
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat <span
                                class="text-red-500">*</span></label>
                        <textarea name="alamat" id="alamat" rows="3" required
                            class="mt-1 block w-full rounded-lg border-gray-300 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                        @error('alamat')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('ibu-hamil.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-lg">Batal</a>
                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>