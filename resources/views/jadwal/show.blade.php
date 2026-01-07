<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('jadwal.index') }}" class="text-gray-500 hover:text-gray-700 mr-4"><svg class="w-6 h-6"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg></a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Jadwal: {{ $jadwal->kegiatan }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">Detail Jadwal Posyandu</h3>
                    <a href="{{ route('jadwal.edit', $jadwal) }}"
                        class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm">Edit</a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $jadwal->tanggal->format('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Waktu</h4>
                            <p class="mt-1 text-lg text-gray-900">
                                {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Kegiatan</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $jadwal->kegiatan }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Lokasi</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $jadwal->lokasi }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Kader Penanggung Jawab</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $jadwal->kader?->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Status</h4>
                            <p class="mt-1"><span
                                    class="inline-flex px-3 py-1 text-sm font-medium rounded-full {{ $jadwal->status_badge }}">{{ $jadwal->status }}</span>
                            </p>
                        </div>
                        @if($jadwal->keterangan)
                            <div class="md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-500">Keterangan</h4>
                                <p class="mt-1 text-lg text-gray-900">{{ $jadwal->keterangan }}</p>
                        </div>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>