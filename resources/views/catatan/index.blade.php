<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catatan Kesehatan</h2>
            <a href="{{ route('catatan.create') }}"
                class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Catatan
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
                    <form method="GET" action="{{ route('catatan.index') }}" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1"><input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari catatan atau tindakan..."
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500"></div>
                        <select name="type" class="rounded-lg border-gray-300">
                            <option value="">Semua Tipe</option>
                            <option value="balita" {{ request('type') == 'balita' ? 'selected' : '' }}>Balita</option>
                            <option value="ibu_hamil" {{ request('type') == 'ibu_hamil' ? 'selected' : '' }}>Ibu Hamil
                            </option>
                            <option value="lansia" {{ request('type') == 'lansia' ? 'selected' : '' }}>Lansia</option>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tindakan
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($catatans as $catatan)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $catatan->tanggal->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4"><span
                                            class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-teal-100 text-teal-800">{{ $catatan->type_label }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $catatan->catatantable?->nama ?? 'Data dihapus' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($catatan->catatan, 50) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ Str::limit($catatan->tindakan, 30) ?? '-' }}</td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('catatan.show', $catatan) }}"
                                                class="text-blue-600 hover:text-blue-900">Detail</a>
                                            <a href="{{ route('catatan.edit', $catatan) }}"
                                                class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            <form action="{{ route('catatan.destroy', $catatan) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Yakin hapus?')">@csrf
                                                @method('DELETE')<button type="submit"
                                                    class="text-red-600 hover:text-red-900">Hapus</button></form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada catatan kesehatan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($catatans->hasPages())
                <div class="px-6 py-4 border-t">{{ $catatans->links() }}</div>@endif
            </div>
        </div>
    </div>
</x-app-layout>