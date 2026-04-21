<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">Lapor Keterlambatan Asisten</h1>
        <p class="page-subtitle">Laporkan asisten yang terlambat masuk ke ruangan praktikum.</p>
    </x-slot>

    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <form action="{{ route('kelas.keterlambatan.store') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div style="background-color: #FEE2E2; border: 1px solid #F87171; color: #991B1B; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <ul style="list-style: disc; padding-left: 1.25rem; font-size: 0.9rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Alert ketika tidak ada jadwal --}}
            <div id="no-jadwal-alert" style="display: none; background-color: #FFFBEB; border-left: 4px solid #F59E0B; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
                <div style="display: flex; gap: 0.75rem;">
                    <svg style="color: #F59E0B;" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.168 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p style="font-size: 0.9rem; font-weight: 600; color: #92400E;">Tidak ada jadwal praktikum hari ini.</p>
                        <p style="font-size: 0.85rem; color: #B45309; margin-top: 0.25rem;">Anda hanya dapat membuat laporan pada hari yang memiliki jadwal praktikum.</p>
                    </div>
                </div>
            </div>

            <div id="form-fields">
                <div class="form-group">
                    <label class="form-label" for="id_jadwal">Pilih Jadwal Hari Ini</label>
                    <select id="id_jadwal" name="id_jadwal" required class="form-control">
                        <option value="">-- Sedang memuat jadwal... --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="id_asisten">Nama Asisten</label>
                    <select id="id_asisten" name="id_asisten" required disabled class="form-control" style="background-color: #F1F5F9;">
                        <option value="">-- Pilih Jadwal Terlebih Dahulu --</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label" for="waktu_masuk_aktual">Waktu Masuk Aktual</label>
                    <input type="time" id="waktu_masuk_aktual" name="waktu_masuk_aktual" required disabled class="form-control" style="background-color: #F1F5F9;">
                    <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.4rem;">Masukkan jam saat asisten benar-benar masuk ke ruangan.</p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="deskripsi">Keterangan / Deskripsi (Opsional)</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" disabled class="form-control" style="background-color: #F1F5F9;" placeholder="Misal: Asisten masuk terlambat tanpa konfirmasi sebelumnya..."></textarea>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 1.5rem; margin-top: 2rem;">
                <a href="{{ route('kelas.keterlambatan.index') }}" style="color: var(--text-muted); font-size: 0.9rem; text-decoration: none; font-weight: 500;">Batal</a>
                <button type="submit" id="btn-submit" disabled class="btn" style="background-color: #CBD5E1; color: white; cursor: not-allowed;">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const jadwalSelect = document.getElementById('id_jadwal');
            const asistenSelect = document.getElementById('id_asisten');
            const waktuInput = document.getElementById('waktu_masuk_aktual');
            const deskripsiInput = document.getElementById('deskripsi');
            const btnSubmit = document.getElementById('btn-submit');
            const noJadwalAlert = document.getElementById('no-jadwal-alert');

            function enableSubmit() {
                btnSubmit.disabled = false;
                btnSubmit.style.backgroundColor = 'var(--primary)';
                btnSubmit.style.cursor = 'pointer';
            }

            function disableSubmit() {
                btnSubmit.disabled = true;
                btnSubmit.style.backgroundColor = '#CBD5E1';
                btnSubmit.style.cursor = 'not-allowed';
            }

            function enableField(el) {
                el.disabled = false;
                el.style.backgroundColor = 'white';
            }

            function disableField(el) {
                el.disabled = true;
                el.style.backgroundColor = '#F1F5F9';
            }

            function validateForm() {
                if (jadwalSelect.value && asistenSelect.value) {
                    enableSubmit();
                } else {
                    disableSubmit();
                }
            }

            // 1. Fetch Jadwal saat halaman dimuat
            fetch('{{ route("kelas.keterlambatan.jadwal-hari-ini") }}')
                .then(response => response.json())
                .then(result => {
                    jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
                    
                    if(result.success && result.data.length > 0) {
                        result.data.forEach(jadwal => {
                            const optionText = `${jadwal.nama_matkul} (${jadwal.waktu_mulai} - ${jadwal.waktu_selesai}) | ${jadwal.nama_ruangan}`;
                            jadwalSelect.innerHTML += `<option value="${jadwal.id_jadwal}">${optionText}</option>`;
                        });
                    } else {
                        jadwalSelect.innerHTML = '<option value="">-- Tidak ada jadwal hari ini --</option>';
                        disableField(jadwalSelect);
                        noJadwalAlert.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching jadwal:', error);
                    jadwalSelect.innerHTML = '<option value="">-- Gagal memuat jadwal --</option>';
                    disableField(jadwalSelect);
                });

            // 2. Fetch Asisten saat jadwal dipilih
            jadwalSelect.addEventListener('change', function() {
                const idJadwal = this.value;
                
                asistenSelect.innerHTML = '<option value="">-- Memuat asisten... --</option>';
                disableField(asistenSelect);
                disableSubmit();

                if (!idJadwal) {
                    asistenSelect.innerHTML = '<option value="">-- Pilih Jadwal Terlebih Dahulu --</option>';
                    disableField(waktuInput);
                    disableField(deskripsiInput);
                    return;
                }

                enableField(waktuInput);
                enableField(deskripsiInput);

                fetch(`/kelas/keterlambatan/asisten/${idJadwal}`)
                    .then(response => response.json())
                    .then(result => {
                        asistenSelect.innerHTML = '<option value="">-- Pilih Asisten --</option>';
                        
                        if(result.success && result.data.length > 0) {
                            result.data.forEach(asisten => {
                                asistenSelect.innerHTML += `<option value="${asisten.id_asisten}">${asisten.nama_asisten}</option>`;
                            });
                            enableField(asistenSelect);
                        } else {
                            asistenSelect.innerHTML = '<option value="">-- Tidak ada asisten terdaftar --</option>';
                        }
                    })
                    .catch(error => console.error('Error fetching asisten:', error));
            });

            jadwalSelect.addEventListener('change', validateForm);
            asistenSelect.addEventListener('change', validateForm);
        });
    </script>
</x-app-layout>