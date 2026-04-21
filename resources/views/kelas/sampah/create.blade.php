<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">Lapor Sampah di Lab</h1>
        <p class="page-subtitle">Laporkan kondisi kebersihan ruangan praktikum untuk menjaga standar laboratorium.</p>
    </x-slot>

    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <form action="{{ route('kelas.sampah.store') }}" method="POST" enctype="multipart/form-data">
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
                        <p style="font-size: 0.85rem; color: #B45309; margin-top: 0.25rem;">Laporan sampah hanya dapat dibuat pada hari yang memiliki jadwal praktikum.</p>
                    </div>
                </div>
            </div>

            <div id="form-fields">
                {{-- Pilih Ruangan / Lab --}}
                <div class="form-group">
                    <label class="form-label" for="id_ruangan">Pilih Ruangan / Lab</label>
                    <select id="id_ruangan" name="id_ruangan" required class="form-control">
                        <option value="">-- Sedang memuat ruangan... --</option>
                    </select>
                </div>

                {{-- Info Pinalti --}}
                <div id="pinalti-info" style="display: none; background-color: #EEF2FF; border: 1px solid #C7D2FE; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
                    <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                        <svg style="color: #4F46E5; flex-shrink: 0;" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        <div>
                            <p style="font-size: 0.85rem; font-weight: 600; color: #3730A3;">Deteksi Pinalti Otomatis</p>
                            <p id="pinalti-text" style="font-size: 0.8rem; color: #4338CA; margin-top: 0.25rem;">Sistem akan mendeteksi kelas di sesi sebelumnya.</p>
                        </div>
                    </div>
                </div>

                {{-- Upload Foto --}}
                <div class="form-group">
                    <label class="form-label">Foto Bukti Sampah</label>
                    <div id="drop-zone" style="border: 2px dashed #CBD5E1; border-radius: 16px; padding: 2.5rem; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                        <svg style="color: #94A3B8; margin-bottom: 1rem;" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                        <p style="font-size: 0.9rem; font-weight: 600; color: #475569;">Klik atau seret foto ke sini</p>
                        <p style="font-size: 0.75rem; color: #94A3B8; margin-top: 0.25rem;">PNG, JPG, JPEG max 5MB</p>
                        <input id="foto_sampah" name="foto_sampah" type="file" style="display: none;" accept="image/*" required>
                    </div>

                    {{-- Preview foto --}}
                    <div id="preview-container" style="display: none; margin-top: 1rem; position: relative;">
                        <img id="preview-image" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 12px; border: 1px solid var(--border);">
                        <button type="button" id="remove-photo" style="position: absolute; top: 12px; right: 12px; background-color: rgba(239, 68, 68, 0.9); border: none; color: white; padding: 8px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label class="form-label" for="deskripsi">Keterangan / Deskripsi (Opsional)</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control" placeholder="Misal: Sampah berserakan di meja praktikum nomor 12..."></textarea>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 1.5rem; margin-top: 2rem;">
                <a href="{{ route('kelas.sampah.index') }}" style="color: var(--text-muted); font-size: 0.9rem; text-decoration: none; font-weight: 500;">Batal</a>
                <button type="submit" id="btn-submit" disabled class="btn" style="background-color: #CBD5E1; color: white; cursor: not-allowed;">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ruanganSelect = document.getElementById('id_ruangan');
            const fotoInput = document.getElementById('foto_sampah');
            const btnSubmit = document.getElementById('btn-submit');
            const noJadwalAlert = document.getElementById('no-jadwal-alert');
            const pinaltiInfo = document.getElementById('pinalti-info');
            const pinaltiText = document.getElementById('pinalti-text');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('preview-image');
            const removePhotoBtn = document.getElementById('remove-photo');
            const dropZone = document.getElementById('drop-zone');

            let fotoSelected = false;

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

            function validateForm() {
                if (ruanganSelect.value && fotoSelected) {
                    enableSubmit();
                } else {
                    disableSubmit();
                }
            }

            // Preview foto
            fotoInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    fotoSelected = true;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.style.display = 'block';
                        dropZone.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
                validateForm();
            });

            // Hapus foto
            removePhotoBtn.addEventListener('click', function() {
                fotoInput.value = '';
                fotoSelected = false;
                previewContainer.style.display = 'none';
                dropZone.style.display = 'block';
                validateForm();
            });

            // Click drop-zone
            dropZone.addEventListener('click', () => fotoInput.click());

            // Drag & drop behavior
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            dropZone.addEventListener('dragover', () => {
                dropZone.style.borderColor = 'var(--primary)';
                dropZone.style.backgroundColor = '#F8FAFC';
            });

            dropZone.addEventListener('dragleave', () => {
                dropZone.style.borderColor = '#CBD5E1';
                dropZone.style.backgroundColor = 'transparent';
            });

            dropZone.addEventListener('drop', (e) => {
                dropZone.style.borderColor = '#CBD5E1';
                dropZone.style.backgroundColor = 'transparent';
                const files = e.dataTransfer.files;
                if (files.length > 0 && files[0].type.startsWith('image/')) {
                    fotoInput.files = files;
                    fotoInput.dispatchEvent(new Event('change'));
                }
            });

            // 1. Fetch ruangan
            fetch('{{ route("kelas.sampah.ruangan-hari-ini") }}')
                .then(response => response.json())
                .then(result => {
                    ruanganSelect.innerHTML = '<option value="">-- Pilih Ruangan / Lab --</option>';

                    if (result.success && result.data.length > 0) {
                        result.data.forEach(item => {
                            const optionText = `${item.nama_ruangan} — ${item.nama_matkul} (${item.waktu_mulai} - ${item.waktu_selesai})`;
                            ruanganSelect.innerHTML += `<option value="${item.id_ruangan}">${optionText}</option>`;
                        });
                    } else {
                        ruanganSelect.innerHTML = '<option value="">-- Tidak ada jadwal hari ini --</option>';
                        ruanganSelect.disabled = true;
                        ruanganSelect.style.backgroundColor = '#F1F5F9';
                        noJadwalAlert.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching ruangan:', error);
                    ruanganSelect.innerHTML = '<option value="">-- Gagal memuat ruangan --</option>';
                    ruanganSelect.disabled = true;
                });

            // 2. Tampilkan info pinalti saat ruangan dipilih
            ruanganSelect.addEventListener('change', function() {
                if (this.value) {
                    pinaltiInfo.style.display = 'block';
                    pinaltiText.textContent = 'Sistem akan otomatis menentukan kelas di sesi sebelumnya sebagai penerima pinalti.';
                } else {
                    pinaltiInfo.style.display = 'none';
                }
                validateForm();
            });
        });
    </script>
</x-app-layout>
