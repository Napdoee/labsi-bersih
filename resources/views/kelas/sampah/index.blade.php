<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
            <div>
                <h1 class="page-title">Riwayat Laporan Sampah</h1>
                <p class="page-subtitle">Daftar laporan kebersihan ruangan praktikum.</p>
            </div>
            <a href="{{ route('kelas.sampah.create') }}" class="btn btn-primary" style="text-decoration: none;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"></path></svg>
                Buat Laporan Baru
            </a>
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
                        <th>Foto</th>
                        <th>Kelas Pinalti</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->waktu_lapor)->translatedFormat('d M Y, H:i') }}</td>
                            <td style="font-weight: 600;">{{ $item->ruangan->nama_ruangan ?? '-' }}</td>
                            <td>
                                @if($item->foto_sampah)
                                <a href="{{ asset('storage/' . $item->foto_sampah) }}" target="_blank" style="color: var(--primary); font-size: 0.85rem; font-weight: 600; text-decoration: none;">Lihat Foto</a>
                                @else
                                <span style="color: var(--text-muted);">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->kelasPinalti)
                                    <span class="badge badge-danger" style="background-color: #FEE2E2; color: #B91C1C;">{{ $item->kelasPinalti->nama_kelas }}</span>
                                @else
                                    <span class="badge" style="background-color: #F1F5F9; color: #64748B;">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status === 'menunggu')
                                    <span class="badge badge-warning">Menunggu</span>
                                @elseif($item->status === 'diverifikasi')
                                    <span class="badge badge-success">Diverifikasi</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.85rem;">
                                {{ $item->deskripsi ?? '-' }}
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                            Belum ada data laporan sampah.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
