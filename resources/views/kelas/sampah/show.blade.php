<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <a href="{{ route('dashboard') }}" style="color: var(--text-muted); display: flex; align-items: center; transition: color 0.2s;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <div>
                <h1 class="page-title">Detail Laporan Sampah</h1>
                <p class="page-subtitle">Informasi lengkap mengenai temuan sampah.</p>
            </div>
        </div>
    </x-slot>

    <div class="grid-container">
        <div class="card col-12">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
                <div>
                    <span style="font-size: 0.85rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Ruangan</span>
                    <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-main);">{{ $laporan->ruangan->nama_ruangan }}</h2>
                </div>
                {{-- <div style="text-align: right;">
                    <span style="font-size: 0.85rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Status Laporan</span>
                    @if($laporan->status === 'menunggu')
                        <span class="badge badge-warning" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Menunggu Verifikasi</span>
                    @elseif($laporan->status === 'diverifikasi')
                        <span class="badge badge-success" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Diverifikasi</span>
                    @else
                        <span class="badge badge-danger" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Ditolak</span>
                    @endif
                </div> --}}
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <div style="margin-bottom: 1.5rem;">
                        <span style="font-size: 0.85rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Waktu Pelaporan</span>
                        <span style="font-weight: 600; color: var(--text-main);">{{ \Carbon\Carbon::parse($laporan->waktu_lapor)->translatedFormat('l, d F Y - H:i') }}</span>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <span style="font-size: 0.85rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Pelapor</span>
                        <span style="font-weight: 600; color: var(--text-main);">{{ $laporan->user->displayName ?? 'System' }}</span>
                        <span style="display: block; font-size: 0.8rem; color: var(--text-muted);">{{ $laporan->kelasPelapor->nama_kelas ?? 'Asisten Lab' }}</span>
                    </div>
                </div>
                <div>
                    <div style="margin-bottom: 1.5rem;">
                        <span style="font-size: 0.85rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Deskripsi / Keterangan</span>
                        <p style="color: var(--text-main); line-height: 1.5; margin: 0;">{{ $laporan->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}</p>
                    </div>
                </div>
            </div>

            @if($laporan->foto_sampah)
                <div style="margin-top: 2rem;">
                    <span style="font-size: 0.85rem; color: var(--text-muted); display: block; margin-bottom: 1rem;">Bukti Foto</span>
                    <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border); background-color: #f8fafc; display: flex; justify-content: center; align-items: center; max-height: 500px;">
                        <img src="{{ asset('storage/' . $laporan->foto_sampah) }}" alt="Foto Sampah" style="max-width: 100%; height: auto; object-fit: contain;">
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
