<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold text-info mb-0"><i class="bi bi-calendar-event"></i> Jadwal Posyandu</h4>
            <a href="{{ route('jadwal.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah
                Jadwal</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show"><i class="bi bi-check-circle"></i>
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('jadwal.index') }}" class="row g-3">
                <div class="col-md-5"><input type="text" name="search" class="form-control"
                        placeholder="Cari lokasi atau kegiatan..." value="{{ request('search') }}"></div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        @foreach(['Dijadwalkan', 'Berlangsung', 'Selesai', 'Dibatalkan'] as $s)
                            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
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
                            <th>Waktu</th>
                            <th>Kegiatan</th>
                            <th>Lokasi</th>
                            <th>Kader PJ</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $index => $jadwal)
                            <tr>
                                <td>{{ $jadwals->firstItem() + $index }}</td>
                                <td>{{ $jadwal->tanggal->format('d M Y') }}</td>
                                <td>{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                                <td><strong>{{ $jadwal->kegiatan }}</strong></td>
                                <td>{{ $jadwal->lokasi }}</td>
                                <td>{{ $jadwal->kader?->nama ?? '-' }}</td>
                                <td><span
                                        class="badge bg-{{ $jadwal->status == 'Dijadwalkan' ? 'primary' : ($jadwal->status == 'Selesai' ? 'success' : ($jadwal->status == 'Berlangsung' ? 'warning' : 'danger')) }}">{{ $jadwal->status }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('jadwal.show', $jadwal) }}" class="btn btn-sm btn-info"><i
                                            class="bi bi-eye"></i></a>
                                    <a href="{{ route('jadwal.edit', $jadwal) }}" class="btn btn-sm btn-warning"><i
                                            class="bi bi-pencil"></i></a>
                                    <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus?')">@csrf @method('DELETE')<button
                                            type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted"><i class="bi bi-inbox display-6"></i>
                                    <p class="mb-0 mt-2">Belum ada jadwal</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($jadwals->hasPages())
        <div class="card-footer">{{ $jadwals->links() }}</div>@endif
    </div>
</x-app-layout>