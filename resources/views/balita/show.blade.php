<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('balita.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Balita: {{ $balita->nama }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <!-- Header with actions -->
                <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">Informasi Balita</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('balita.edit', $balita) }}"
                            class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm transition">
                            Edit
                        </a>
                        <a href="{{ route('catatan.create', ['type' => 'balita', 'id' => $balita->id]) }}"
                            class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm transition">
                            + Catatan Kesehatan
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama Lengkap</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $balita->nama }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">NIK</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $balita->nik ?? '-' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal Lahir</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $balita->tanggal_lahir->format('d F Y') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Usia</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $balita->usia_formatted }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Jenis Kelamin</h4>
                            <p class="mt-1">
                                <span
                                    class="inline-flex px-3 py-1 text-sm font-medium rounded-full {{ $balita->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                    {{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama Orang Tua</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $balita->nama_ortu }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Berat Badan</h4>
                            <p class="mt-1 text-lg text-gray-900">
                                {{ $balita->berat_badan ? $balita->berat_badan . ' kg' : '-' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tinggi Badan</h4>
                            <p class="mt-1 text-lg text-gray-900">
                                {{ $balita->tinggi_badan ? $balita->tinggi_badan . ' cm' : '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h4 class="text-sm font-medium text-gray-500">Alamat</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $balita->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Kesehatan -->
            <div class="mt-6 bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="bg-gradient-to-r from-green-500 to-teal-500 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">Riwayat Catatan Kesehatan</h3>
                </div>
                <div class="p-6">
                    @if($balita->catatanKesehatans->count() > 0)
                        <div class="space-y-4">
                            @foreach($balita->catatanKesehatans->sortByDesc('tanggal') as $catatan)
                                <div class="border rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-500">{{ $catatan->tanggal->format('d F Y') }}</p>
                                            <p class="mt-1 font-medium text-gray-900">{{ $catatan->catatan }}</p>
                                            @if($catatan->tindakan)
                                                <p class="mt-1 text-sm text-gray-600"><strong>Tindakan:</strong>
                                                    {{ $catatan->tindakan }}</p>
                                            @endif
                                            <div class="mt-2 flex flex-wrap gap-2 text-xs text-gray-500">
                                                @if($catatan->berat_badan)
                                                    <span class="bg-gray-100 px-2 py-1 rounded">BB: {{ $catatan->berat_badan }}
                                                        kg</span>
                                                @endif
                                                @if($catatan->tinggi_badan)
                                                    <span class="bg-gray-100 px-2 py-1 rounded">TB: {{ $catatan->tinggi_badan }}
                                                        cm</span>
                                                @endif
                                                @if($catatan->suhu_tubuh)
                                                    <span class="bg-gray-100 px-2 py-1 rounded">Suhu:
                                                        {{ $catatan->suhu_tubuh }}°C</span>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ route('catatan.show', $catatan) }}"
                                            class="text-blue-600 hover:text-blue-800 text-sm">Detail</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p class="mt-2">Belum ada catatan kesehatan</p>
                            <a href="{{ route('catatan.create', ['type' => 'balita', 'id' => $balita->id]) }}"
                                class="mt-4 inline-block text-green-600 hover:text-green-800">Tambah catatan pertama →</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>