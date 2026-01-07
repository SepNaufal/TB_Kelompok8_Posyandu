<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Posyandu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Balita Card -->
                <div class="bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-pink-100 text-sm font-medium">Total Balita</p>
                            <p class="text-3xl font-bold">{{ $stats['balita'] }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m9 5.197v1"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('balita.index') }}" class="mt-4 inline-flex items-center text-sm text-pink-100 hover:text-white">
                        Lihat detail →
                    </a>
                </div>

                <!-- Ibu Hamil Card -->
                <div class="bg-gradient-to-br from-purple-500 to-indigo-500 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Total Ibu Hamil</p>
                            <p class="text-3xl font-bold">{{ $stats['ibu_hamil'] }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('ibu-hamil.index') }}" class="mt-4 inline-flex items-center text-sm text-purple-100 hover:text-white">
                        Lihat detail →
                    </a>
                </div>

                <!-- Lansia Card -->
                <div class="bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-sm font-medium">Total Lansia</p>
                            <p class="text-3xl font-bold">{{ $stats['lansia'] }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('lansia.index') }}" class="mt-4 inline-flex items-center text-sm text-amber-100 hover:text-white">
                        Lihat detail →
                    </a>
                </div>

                <!-- Kader Card -->
                <div class="bg-gradient-to-br from-green-500 to-teal-500 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Kader Aktif</p>
                            <p class="text-3xl font-bold">{{ $stats['kader'] }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('kader.index') }}" class="mt-4 inline-flex items-center text-sm text-green-100 hover:text-white">
                        Lihat detail →
                    </a>
                </div>

                <!-- Jadwal Mendatang Card -->
                <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Jadwal Mendatang</p>
                            <p class="text-3xl font-bold">{{ $stats['jadwal_mendatang'] }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('jadwal.index') }}" class="mt-4 inline-flex items-center text-sm text-blue-100 hover:text-white">
                        Lihat detail →
                    </a>
                </div>

                <!-- Catatan Bulan Ini Card -->
                <div class="bg-gradient-to-br from-slate-600 to-gray-700 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-300 text-sm font-medium">Catatan Bulan Ini</p>
                            <p class="text-3xl font-bold">{{ $stats['catatan_bulan_ini'] }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('catatan.index') }}" class="mt-4 inline-flex items-center text-sm text-slate-300 hover:text-white">
                        Lihat detail →
                    </a>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Jadwal Mendatang -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Jadwal Posyandu Mendatang</h3>
                    </div>
                    <div class="p-6">
                        @if($jadwalMendatang->count() > 0)
                            <div class="space-y-4">
                                @foreach($jadwalMendatang as $jadwal)
                                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0 w-14 text-center">
                                            <div class="text-2xl font-bold text-blue-600">{{ $jadwal->tanggal->format('d') }}</div>
                                            <div class="text-xs text-gray-500 uppercase">{{ $jadwal->tanggal->format('M') }}</div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $jadwal->kegiatan }}</p>
                                            <p class="text-sm text-gray-500">{{ $jadwal->lokasi }}</p>
                                            <p class="text-xs text-gray-400">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</p>
                                        </div>
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $jadwal->status_badge }}">
                                            {{ $jadwal->status }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="mt-2">Tidak ada jadwal mendatang</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Catatan Kesehatan Terbaru -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-teal-500 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Catatan Kesehatan Terbaru</h3>
                    </div>
                    <div class="p-6">
                        @if($catatanTerbaru->count() > 0)
                            <div class="space-y-4">
                                @foreach($catatanTerbaru as $catatan)
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    {{ $catatan->type_label }}
                                                </span>
                                                <p class="mt-2 text-sm font-medium text-gray-900">
                                                    {{ $catatan->catatantable?->nama ?? 'Data dihapus' }}
                                                </p>
                                                <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($catatan->catatan, 100) }}</p>
                                            </div>
                                            <span class="text-xs text-gray-400">{{ $catatan->tanggal->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="mt-2">Belum ada catatan kesehatan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
