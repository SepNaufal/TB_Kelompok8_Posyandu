<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('ibu-hamil.index') }}" class="text-gray-500 hover:text-gray-700 mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Ibu Hamil: {{ $ibuHamil->nama }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">Informasi Ibu Hamil</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('ibu-hamil.edit', $ibuHamil) }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm">Edit</a>
                        <a href="{{ route('catatan.create', ['type' => 'ibu_hamil', 'id' => $ibuHamil->id]) }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm">+ Catatan</a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><h4 class="text-sm font-medium text-gray-500">Nama</h4><p class="mt-1 text-lg font-semibold text-gray-900">{{ $ibuHamil->nama }}</p></div>
                        <div><h4 class="text-sm font-medium text-gray-500">Usia</h4><p class="mt-1 text-lg text-gray-900">{{ $ibuHamil->usia }} tahun</p></div>
                        <div><h4 class="text-sm font-medium text-gray-500">Usia Kehamilan</h4><p class="mt-1"><span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-purple-100 text-purple-800">{{ $ibuHamil->usia_kehamilan ?? '-' }} minggu ({{ $ibuHamil->trimester }})</span></p></div>
                        <div><h4 class="text-sm font-medium text-gray-500">HPL</h4><p class="mt-1 text-lg text-gray-900">{{ $ibuHamil->hpl ? $ibuHamil->hpl->format('d F Y') : '-' }}</p></div>
                        <div><h4 class="text-sm font-medium text-gray-500">Golongan Darah</h4><p class="mt-1 text-lg text-gray-900">{{ $ibuHamil->golongan_darah ?? '-' }}</p></div>
                        <div><h4 class="text-sm font-medium text-gray-500">No. HP</h4><p class="mt-1 text-lg text-gray-900">{{ $ibuHamil->no_hp ?? '-' }}</p></div>
                        <div><h4 class="text-sm font-medium text-gray-500">Nama Suami</h4><p class="mt-1 text-lg text-gray-900">{{ $ibuHamil->nama_suami ?? '-' }}</p></div>
                        <div class="md:col-span-2"><h4 class="text-sm font-medium text-gray-500">Alamat</h4><p class="mt-1 text-lg text-gray-900">{{ $ibuHamil->alamat }}</p></div>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="bg-gradient-to-r from-green-500 to-teal-500 px-6 py-4"><h3 class="text-lg font-semibold text-white">Riwayat Catatan Kesehatan</h3></div>
                <div class="p-6">
                    @if($ibuHamil->catatanKesehatans->count() > 0)
                        <div class="space-y-4">
                            @foreach($ibuHamil->catatanKesehatans->sortByDesc('tanggal') as $catatan)
                                <div class="border rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-500">{{ $catatan->tanggal->format('d F Y') }}</p>
                                            <p class="mt-1 font-medium text-gray-900">{{ $catatan->catatan }}</p>
                                            @if($catatan->tekanan_darah_sistol)<p class="text-sm text-gray-600">Tekanan Darah: {{ $catatan->tekanan_darah }}</p>@endif
                                        </div>
                                        <a href="{{ route('catatan.show', $catatan) }}" class="text-blue-600 hover:text-blue-800 text-sm">Detail</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">Belum ada catatan kesehatan</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
