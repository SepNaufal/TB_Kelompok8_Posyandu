<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Ibu Hamil</h2>
            <a href="{{ route('ibu-hamil.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Ibu Hamil
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('ibu-hamil.index') }}" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama, alamat, atau nama suami..."
                                class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        </div>
                        <div class="flex gap-2">
                            <select name="sort" class="rounded-lg border-gray-300">
                                <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama</option>
                                <option value="usia_kehamilan" {{ request('sort') == 'usia_kehamilan' ? 'selected' : '' }}>Usia Kehamilan</option>
                                <option value="hpl" {{ request('sort') == 'hpl' ? 'selected' : '' }}>HPL</option>
                            </select>
                            <button type="submit"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">Filter</button>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usia</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usia
                                    Kehamilan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">HPL</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Suami
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($ibuHamils as $ibuHamil)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $ibuHamil->nama }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $ibuHamil->usia }} tahun</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                            {{ $ibuHamil->usia_kehamilan ?? '-' }} minggu ({{ $ibuHamil->trimester }})
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $ibuHamil->hpl ? $ibuHamil->hpl->format('d M Y') : '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $ibuHamil->nama_suami ?? '-' }}</td>
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('ibu-hamil.show', $ibuHamil) }}"
                                                class="text-blue-600 hover:text-blue-900">Detail</a>
                                            <a href="{{ route('ibu-hamil.edit', $ibuHamil) }}"
                                                class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            <form action="{{ route('ibu-hamil.destroy', $ibuHamil) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Yakin hapus?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data ibu hamil
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($ibuHamils->hasPages())
                <div class="px-6 py-4 border-t">{{ $ibuHamils->links() }}</div>@endif
            </div>
        </div>
    </div>
</x-app-layout>