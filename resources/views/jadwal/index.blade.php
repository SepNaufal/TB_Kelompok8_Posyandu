<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Posyandu</h2>
            <a href="{{ route('jadwal.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Jadwal
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}</div>@endif

            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('jadwal.index') }}" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1"><input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari kegiatan atau lokasi..."
                                class="w-full rounded-lg border-gray-300 focus:border-blue-500"></div>
                        <select name="status" class="rounded-lg border-gray-300">
                            <option value="">Semua Status</option>
                            @foreach(['Dijadwalkan', 'Berlangsung', 'Selesai', 'Dibatalkan'] as $s)<option
                                value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Filter</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kegiatan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kader PJ
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($jadwals as $jadwal)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm">
                                        <div class="font-medium text-gray-900">{{ $jadwal->tanggal->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $jadwal->kegiatan }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $jadwal->lokasi }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $jadwal->kader?->nama ?? '-' }}</td>
                                    <td class="px-6 py-4"><span
                                            class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $jadwal->status_badge }}">{{ $jadwal->status }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('jadwal.show', $jadwal) }}"
                                                class="text-blue-600 hover:text-blue-900">Detail</a>
                                            <a href="{{ route('jadwal.edit', $jadwal) }}"
                                                class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Yakin hapus?')">@csrf
                                                @method('DELETE')<button type="submit"
                                                    class="text-red-600 hover:text-red-900">Hapus</button></form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">Belum ada jadwal posyandu
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($jadwals->hasPages())
                <div class="px-6 py-4 border-t">{{ $jadwals->links() }}</div>@endif
            </div>
        </div>
    </div>
</x-app-layout>