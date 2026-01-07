<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-danger mb-0"><i class="bi bi-journal-medical"></i> Catatan Kesehatan</h4>
            <a href="{{ route('catatan.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah
                Catatan</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle"></i>
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('catatan.index') }}" class="row g-3">
                <div class="col-md-5"><input type="text" name="search" class="form-control"
                        placeholder="Cari catatan atau tindakan..." value="{{ request('search') }}"></div>
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="">Semua Tipe</option>
                        <option value="balita" {{ request('type') == 'balita' ? 'selected' : '' }}>Balita</option>
                        <option value="ibu_hamil" {{ request('type') == 'ibu_hamil' ? 'selected' : '' }}>Ibu Hamil
                        </option>
                        <option value="lansia" {{ request('type') == 'lansia' ? 'selected' : '' }}>Lansia</option>
                    </select>
                </div>
                <div class="col-md-4"><button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i>
                        Cari</button></div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Nama Pasien</th>
                            <th>Catatan</th>
                            <th>Data Kesehatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($catatans as $index => $catatan)
                            <tr>
                                <td>{{ $catatans->firstItem() + $index }}</td>
                                <td>{{ $catatan->tanggal->format('d M Y') }}</td>
                                <td><span
                                        class="badge bg-{{ $catatan->type_label == 'Balita' ? 'primary' : ($catatan->type_label == 'Ibu Hamil' ? 'purple' : 'warning') }}"
                                        style="{{ $catatan->type_label == 'Ibu Hamil' ? 'background-color:#6f42c1;' : '' }}">{{ $catatan->type_label }}</span>
                                </td>
                                <td><strong>{{ $catatan->catatantable?->nama ?? 'Data Dihapus' }}</strong></td>
                                <td>{{ Str::limit($catatan->catatan, 40) }}</td>
                                <td>
                                    @if($catatan->berat_badan)<small>BB: {{ $catatan->berat_badan }}kg</small><br>@endif
                                    @if($catatan->tekanan_darah_sistol)<small>TD:
                                    {{ $catatan->tekanan_darah }}</small>@endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('catatan.show', $catatan) }}" class="btn btn-sm btn-info"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ route('catatan.edit', $catatan) }}" class="btn btn-sm btn-warning"><i
                                            class="bi bi-pencil"></i></a>
                                    <form action="{{ route('catatan.destroy', $catatan) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button
                                            type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted"><i class="bi bi-inbox display-6"></i>
                                    <p class="mb-0 mt-2">Belum ada catatan kesehatan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($catatans->hasPages())
        <div class="card-footer">{{ $catatans->links() }}</div>@endif
    </div>
</x-app-layout>