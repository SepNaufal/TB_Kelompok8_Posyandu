<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Lansia</h2>
            <a href="{{ route('lansia.create') }}"
                class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Lansia
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
                    <form method="GET" action="{{ route('lansia.index') }}" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama atau alamat..."
                                class="w-full rounded-lg border-gray-300 focus:border-amber-500">
                        </div>
                        <button type="submit"
                            class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Filter</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usia</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis
                                    Kelamin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Riwayat
                                    Penyakit</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($lansias as $lansia)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $lansia->nama }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $lansia->usia }} tahun</td>
                                    <td class="px-6 py-4"><span
                                            class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $lansia->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">{{ $lansia->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $lansia->no_hp ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ Str::limit($lansia->riwayat_penyakit, 30) ?? '-' }}</td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('lansia.show', $lansia) }}"
                                                class="text-blue-600 hover:text-blue-900">Detail</a>
                                            <a href="{{ route('lansia.edit', $lansia) }}"
                                                class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            <form action="{{ route('lansia.destroy', $lansia) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Yakin hapus?')">@csrf
                                                @method('DELETE')<button type="submit"
                                                    class="text-red-600 hover:text-red-900">Hapus</button></form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data lansia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($lansias->hasPages())
                <div class="px-6 py-4 border-t">{{ $lansias->links() }}</div>@endif
            </div>
        </div>
    </div>
</x-app-layout>