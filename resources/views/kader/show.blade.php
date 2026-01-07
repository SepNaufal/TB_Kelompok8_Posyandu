<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('kader.index') }}" class="text-gray-500 hover:text-gray-700 mr-4"><svg class="w-6 h-6"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg></a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Kader: {{ $kader->nama }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="bg-gradient-to-r from-green-500 to-teal-500 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">Informasi Kader</h3>
                    <a href="{{ route('kader.edit', $kader) }}"
                        class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm">Edit</a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $kader->nama }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Jabatan</h4>
                            <p class="mt-1"><span
                                    class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">{{ $kader->jabatan }}</span>
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">No. HP</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $kader->no_hp }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Status</h4>
                            <p class="mt-1"><span
                                    class="inline-flex px-3 py-1 text-sm font-medium rounded-full {{ $kader->aktif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $kader->aktif ? 'Aktif' : 'Non-aktif' }}</span>
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal Bergabung</h4>
                            <p class="mt-1 text-lg text-gray-900">
                                {{ $kader->tanggal_bergabung ? $kader->tanggal_bergabung->format('d F Y') : '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h4 class="text-sm font-medium text-gray-500">Alamat</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $kader->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($kader->jadwalPosyandus->count() > 0)
                <div class="mt-6 bg-white overflow-hidden shadow-xl rounded-lg">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Jadwal yang Ditangani</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($kader->jadwalPosyandus->sortByDesc('tanggal')->take(5) as $jadwal)
                                <div class="border rounded-lg p-4 hover:bg-gray-50">
                                    <p class="font-medium text-gray-900">{{ $jadwal->kegiatan }}</p>
                                    <p class="text-sm text-gray-500">{{ $jadwal->tanggal->format('d F Y') }} |
                                        {{ $jadwal->lokasi }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>