<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-warning mb-0"><i class="bi bi-person-walking"></i> Data Lansia</h4>
            <a href="{{ route('lansia.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Lansia</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle"></i> {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('lansia.index') }}" class="row g-3">
                <div class="col-md-8"><input type="text" name="search" class="form-control" placeholder="Cari nama atau alamat..." value="{{ request('search') }}"></div>
                <div class="col-md-4"><button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> Cari</button></div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>No</th><th>Nama</th><th>Usia</th><th>Jenis Kelamin</th><th>No. HP</th><th>Riwayat Penyakit</th><th class="text-center">Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse($lansias as $index => $lansia)
                            <tr>
                                <td>{{ $lansias->firstItem() + $index }}</td>
                                <td><strong>{{ $lansia->nama }}</strong></td>
                                <td>{{ $lansia->usia }} tahun</td>
                                <td><span class="badge bg-{{ $lansia->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">{{ $lansia->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span></td>
                                <td>{{ $lansia->no_hp ?? '-' }}</td>
                                <td>{{ Str::limit($lansia->riwayat_penyakit, 30) ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('lansia.show', $lansia) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('lansia.edit', $lansia) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('lansia.destroy', $lansia) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted"><i class="bi bi-inbox display-6"></i><p class="mb-0 mt-2">Belum ada data lansia</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($lansias->hasPages())<div class="card-footer">{{ $lansias->links() }}</div>@endif
    </div>
</x-app-layout>