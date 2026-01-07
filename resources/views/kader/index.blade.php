<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-success mb-0"><i class="bi bi-people"></i> Data Kader</h4>
            <a href="{{ route('kader.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Kader</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle"></i>
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('kader.index') }}" class="row g-3">
                <div class="col-md-8"><input type="text" name="search" class="form-control"
                        placeholder="Cari nama, alamat, atau jabatan..." value="{{ request('search') }}"></div>
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
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>No. HP</th>
                            <th>Bergabung</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kaders as $index => $kader)
                            <tr>
                                <td>{{ $kaders->firstItem() + $index }}</td>
                                <td><strong>{{ $kader->nama }}</strong></td>
                                <td><span class="badge bg-info">{{ $kader->jabatan }}</span></td>
                                <td>{{ $kader->no_hp }}</td>
                                <td>{{ $kader->tanggal_bergabung ? $kader->tanggal_bergabung->format('d M Y') : '-' }}</td>
                                <td><span
                                        class="badge bg-{{ $kader->aktif ? 'success' : 'secondary' }}">{{ $kader->aktif ? 'Aktif' : 'Tidak Aktif' }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('kader.show', $kader) }}" class="btn btn-sm btn-info"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ route('kader.edit', $kader) }}" class="btn btn-sm btn-warning"><i
                                            class="bi bi-pencil"></i></a>
                                    <form action="{{ route('kader.destroy', $kader) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button
                                            type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted"><i class="bi bi-inbox display-6"></i>
                                    <p class="mb-0 mt-2">Belum ada data kader</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($kaders->hasPages())
        <div class="card-footer">{{ $kaders->links() }}</div>@endif
    </div>
</x-app-layout>