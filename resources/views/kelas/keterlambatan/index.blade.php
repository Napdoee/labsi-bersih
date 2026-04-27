<x-app-layout>
    <x-slot name="header">
        <div class="flex-header">
            <div>
                <h1 class="page-title">Riwayat Keterlambatan Asisten</h1>
                <p class="page-subtitle">Pantau tingkat kedisiplinan asisten di kelas Anda.</p>
            </div>
            <a href="{{ route('kelas.keterlambatan.create') }}" class="btn btn-primary" style="text-decoration: none;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"></path></svg>
                Buat Laporan Baru
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Waktu Lapor</th>
                        <th>Mata Kuliah</th>
                        <th>Nama Asisten</th>
                        <th>Keterlambatan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->waktu_lapor)->translatedFormat('d M Y, H:i') }}</td>
                            <td style="font-weight: 600;">{{ $item->jadwal->mataKuliah->nama_matkul ?? '-' }}</td>
                            <td>{{ $item->asisten->nama_asisten ?? '-' }}</td>
                            <td>
                                @if($item->keterlambatan == 0)
                                    <span class="badge badge-success">Tepat Waktu</span>
                                @elseif($item->keterlambatan <= 15)
                                    <span class="badge badge-warning">{{ $item->keterlambatan }} Menit</span>
                                @else
                                    <span class="badge badge-danger" style="background-color: #FEE2E2; color: #B91C1C;">{{ $item->keterlambatan }} Menit</span>
                                @endif
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.85rem;">
                                {{ $item->deskripsi ?? '-' }}
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                            Belum ada data laporan keterlambatan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>