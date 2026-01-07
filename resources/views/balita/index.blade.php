<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-primary mb-0"><i class="bi bi-balloon-heart"></i> Data Balita</h4>
            <a href="{{ route('balita.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> Tambah Balita
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter & Search -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('balita.index') }}" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari nama, nama ortu, atau alamat..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="sort" class="form-select">
                        <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Urutkan: Nama</option>
                        <option value="tanggal_lahir" {{ request('sort') == 'tanggal_lahir' ? 'selected' : '' }}>Urutkan:
                            Tanggal Lahir</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Urutkan:
                            Terbaru</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Orang Tua</th>
                            <th>BB / TB</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($balitas as $index => $balita)
                            <tr>
                                <td>{{ $balitas->firstItem() + $index }}</td>
                                <td><strong>{{ $balita->nama }}</strong></td>
                                <td>{{ $balita->usia_lengkap }}</td>
                                <td>
                                    <span class="badge bg-{{ $balita->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">
                                        {{ $balita->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </td>
                                <td>{{ $balita->nama_ortu }}</td>
                                <td>{{ $balita->berat_badan ?? '-' }} kg / {{ $balita->tinggi_badan ?? '-' }} cm</td>
                                <td class="text-center">
                                    <a href="{{ route('balita.show', $balita) }}" class="btn btn-sm btn-info"
                                        title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('balita.edit', $balita) }}" class="btn btn-sm btn-warning"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('balita.destroy', $balita) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox display-6"></i>
                                    <p class="mb-0 mt-2">Belum ada data balita</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($balitas->hasPages())
            <div class="card-footer">
                {{ $balitas->links() }}
            </div>
        @endif
    </div>
</x-app-layout>