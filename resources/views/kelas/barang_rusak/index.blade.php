<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <div>
                <h1 class="page-title">Riwayat Laporan Barang Rusak</h1>
                <p class="page-subtitle">Pantau status perbaikan inventaris laboratorium secara real-time.</p>
            </div>
            @can('report_broken_item')
            <a href="{{ route('kelas.barang-rusak.create') }}" class="btn btn-primary" style="text-decoration: none;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"></path></svg>
                Buat Laporan Baru
            </a>
            @endcan
        </div>
    </x-slot>

    @if (session('success'))
        <div class="card" style="background-color: #DCFCE7; border-color: #86EFAC; color: #166534; margin-bottom: 1.5rem; padding: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Waktu Lapor</th>
                        <th>Ruangan</th>
                        <th>Barang</th>
                        <th>No Meja/PC</th>
                        <th>Status</th>
                        <th>Kerusakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->waktu_lapor)->translatedFormat('d M Y, H:i') }}</td>
                            <td style="font-weight: 600;">{{ $item->ruangan->nama_ruangan ?? '-' }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->no_meja_pc ?? '-' }}</td>
                            <td>
                                @if($item->status_laporan === 'Pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($item->status_laporan === 'Sedang Diperbaiki')
                                    <span class="badge badge-info">Perbaikan</span>
                                @else
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.85rem;">
                                {{ $item->deskripsi_kerusakan }}
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                            Belum ada data laporan barang rusak.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
