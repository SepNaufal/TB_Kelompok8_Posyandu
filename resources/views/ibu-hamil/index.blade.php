<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0" style="color: #6f42c1;"><i class="bi bi-person-hearts"></i> Data Ibu Hamil</h4>
            <a href="{{ route('ibu-hamil.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Tambah Ibu Hamil
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('ibu-hamil.index') }}" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, alamat, atau nama suami..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select">
                        <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Urutkan: Nama</option>
                        <option value="usia_kehamilan" {{ request('sort') == 'usia_kehamilan' ? 'selected' : '' }}>Urutkan: Usia Kehamilan</option>
                        <option value="hpl" {{ request('sort') == 'hpl' ? 'selected' : '' }}>Urutkan: HPL</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button>
                </div>
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
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Usia Kehamilan</th>
                            <th>HPL</th>
                            <th>Nama Suami</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ibuHamils as $index => $ibuHamil)
                            <tr>
                                <td>{{ $ibuHamils->firstItem() + $index }}</td>
                                <td><strong>{{ $ibuHamil->nama }}</strong></td>
                                <td>{{ $ibuHamil->usia }} tahun</td>
                                <td>
                                    <span class="badge" style="background-color: #6f42c1;">
                                        {{ $ibuHamil->usia_kehamilan ?? '-' }} minggu ({{ $ibuHamil->trimester }})
                                    </span>
                                </td>
                                <td>{{ $ibuHamil->hpl ? $ibuHamil->hpl->format('d M Y') : '-' }}</td>
                                <td>{{ $ibuHamil->nama_suami ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ibu-hamil.show', $ibuHamil) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('ibu-hamil.edit', $ibuHamil) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('ibu-hamil.destroy', $ibuHamil) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox display-6"></i>
                                    <p class="mb-0 mt-2">Belum ada data ibu hamil</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($ibuHamils->hasPages())
            <div class="card-footer">{{ $ibuHamils->links() }}</div>
        @endif
    </div>
</x-app-layout>