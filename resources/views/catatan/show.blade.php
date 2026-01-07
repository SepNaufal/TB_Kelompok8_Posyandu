<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('catatan.index') }}" class="text-gray-500 hover:text-gray-700 mr-4"><svg class="w-6 h-6"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg></a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Catatan Kesehatan</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="bg-gradient-to-r from-teal-500 to-green-500 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">Catatan Kesehatan</h3>
                    <a href="{{ route('catatan.edit', $catatan) }}"
                        class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm">Edit</a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tipe Pasien</h4>
                            <p class="mt-1"><span
                                    class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-teal-100 text-teal-800">{{ $catatan->type_label }}</span>
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nama Pasien</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">
                                {{ $catatan->catatantable?->nama ?? 'Data dihapus' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal Pemeriksaan</h4>
                            <p class="mt-1 text-lg text-gray-900">{{ $catatan->tanggal->format('d F Y') }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h4 class="text-sm font-medium text-gray-500">Catatan</h4>
                            <p class="mt-1 text-gray-900">{{ $catatan->catatan }}</p>
                        </div>
                        @if($catatan->tindakan)
                            <div class="md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-500">Tindakan</h4>
                                <p class="mt-1 text-gray-900">{{ $catatan->tindakan }}</p>
                        </div>@endif
                    </div>

                    @if($catatan->berat_badan || $catatan->tinggi_badan || $catatan->tekanan_darah_sistol || $catatan->suhu_tubuh)
                        <div class="mt-6 pt-6 border-t">
                            <h4 class="font-medium text-gray-700 mb-4">Data Pemeriksaan</h4>
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                @if($catatan->berat_badan)
                                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                                        <p class="text-sm text-gray-500">Berat Badan</p>
                                        <p class="text-xl font-bold text-gray-900">{{ $catatan->berat_badan }} kg</p>
                                </div>@endif
                                @if($catatan->tinggi_badan)
                                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                                        <p class="text-sm text-gray-500">Tinggi Badan</p>
                                        <p class="text-xl font-bold text-gray-900">{{ $catatan->tinggi_badan }} cm</p>
                                </div>@endif
                                @if($catatan->tekanan_darah_sistol)
                                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                                        <p class="text-sm text-gray-500">Tekanan Darah</p>
                                        <p class="text-xl font-bold text-gray-900">{{ $catatan->tekanan_darah }}</p>
                                </div>@endif
                                @if($catatan->suhu_tubuh)
                                    <div class="bg-gray-50 p-4 rounded-lg text-center">
                                        <p class="text-sm text-gray-500">Suhu Tubuh</p>
                                        <p class="text-xl font-bold text-gray-900">{{ $catatan->suhu_tubuh }}°C</p>
                                </div>@endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>