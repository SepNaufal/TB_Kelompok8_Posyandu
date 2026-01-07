<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('kader.index') }}" class="text-gray-500 hover:text-gray-700 mr-4"><svg class="w-6 h-6"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg></a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Data Kader</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <form action="{{ route('kader.update', $kader) }}" method="POST" class="p-6 space-y-6">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label for="nama" class="block text-sm font-medium text-gray-700">Nama <span
                                    class="text-red-500">*</span></label><input type="text" name="nama" id="nama"
                                value="{{ old('nama', $kader->nama) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="no_hp" class="block text-sm font-medium text-gray-700">No. HP <span
                                    class="text-red-500">*</span></label><input type="text" name="no_hp" id="no_hp"
                                value="{{ old('no_hp', $kader->no_hp) }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div><label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan <span
                                    class="text-red-500">*</span></label><select name="jabatan" id="jabatan" required
                                class="mt-1 block w-full rounded-lg border-gray-300">
                                <option value="">Pilih</option>
                                @foreach(['Ketua', 'Sekretaris', 'Bendahara', 'Anggota'] as $j)<option value="{{ $j }}"
                                    {{ old('jabatan', $kader->jabatan) == $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select></div>
                        <div><label for="tanggal_bergabung" class="block text-sm font-medium text-gray-700">Tanggal
                                Bergabung</label><input type="date" name="tanggal_bergabung" id="tanggal_bergabung"
                                value="{{ old('tanggal_bergabung', $kader->tanggal_bergabung?->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-lg border-gray-300"></div>
                        <div class="flex items-center"><input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $kader->aktif) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-green-600"><label for="aktif"
                                class="ml-2 text-sm text-gray-700">Status Aktif</label></div>
                    </div>
                    <div><label for="alamat" class="block text-sm font-medium text-gray-700">Alamat <span
                                class="text-red-500">*</span></label><textarea name="alamat" id="alamat" rows="3"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300">{{ old('alamat', $kader->alamat) }}</textarea>
                    </div>
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('kader.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-lg">Batal</a>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>