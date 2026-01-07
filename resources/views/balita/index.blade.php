<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Balita
            </h2>
            <a href="{{ route('balita.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Balita
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Message -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <!-- Search and Filter -->
                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('balita.index') }}" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama balita, orang tua, atau alamat..."
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        </div>
                        <div class="flex gap-2">
                            <select name="sort"
                                class="rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama</option>
                                <option value="tanggal_lahir" {{ request('sort') == 'tanggal_lahir' ? 'selected' : '' }}>
                                    Tanggal Lahir</option>
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Tanggal
                                    Input</option>
                            </select>
                            <select name="order"
                                class="rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>A-Z</option>
                                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Z-A</option>
                            </select>
                            <button type="submit"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">
                                Filter
                            </button>
                            @if(request()->hasAny(['search', 'sort', 'order']))
                                <a href="{{ route('balita.index') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Usia</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Kelamin</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Orang Tua</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    BB/TB</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($balitas as $balita)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $balita->nama }}</div>
                                        <div class="text-sm text-gray-500">{{ $balita->tanggal_lahir->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $balita->usia_formatted }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $balita->jenis_kelamin == 'L' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                            {{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $balita->nama_ortu }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $balita->berat_badan ? $balita->berat_badan . ' kg' : '-' }} /
                                        {{ $balita->tinggi_badan ? $balita->tinggi_badan . ' cm' : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('balita.show', $balita) }}"
                                                class="text-blue-600 hover:text-blue-900">Detail</a>
                                            <a href="{{ route('balita.edit', $balita) }}"
                                                class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            <form action="{{ route('balita.destroy', $balita) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m9 5.197v1">
                                            </path>
                                        </svg>
                                        <p class="mt-2">Belum ada data balita</p>
                                        <a href="{{ route('balita.create') }}"
                                            class="mt-4 inline-block text-green-600 hover:text-green-800">Tambah data balita
                                            pertama →</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($balitas->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $balitas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>