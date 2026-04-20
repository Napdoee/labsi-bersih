<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lapor Sampah di Lab') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('kelas.sampah.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                                <strong class="font-bold">Oops! Ada yang salah.</strong>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Alert ketika tidak ada jadwal --}}
                        <div id="no-jadwal-alert" class="mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded hidden">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.168 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700 font-medium">Tidak ada jadwal praktikum hari ini.</p>
                                    <p class="mt-1 text-sm text-yellow-600">Anda hanya dapat membuat laporan sampah pada hari yang memiliki jadwal praktikum.</p>
                                </div>
                            </div>
                        </div>

                        <div id="form-fields">
                            {{-- Pilih Ruangan / Lab --}}
                            <div class="mb-4">
                                <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Pilih Ruangan / Lab</label>
                                <select id="id_ruangan" name="id_ruangan" required class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Sedang memuat ruangan... --</option>
                                </select>
                            </div>

                            {{-- Info Pinalti (ditampilkan setelah ruangan dipilih) --}}
                            <div id="pinalti-info" class="mb-4 hidden">
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-blue-700 font-medium">Deteksi Pinalti Otomatis</p>
                                            <p id="pinalti-text" class="mt-1 text-sm text-blue-600">Sistem akan otomatis mendeteksi kelas di sesi sebelumnya.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Upload Foto --}}
                            <div class="mb-4">
                                <label for="foto_sampah" class="block text-sm font-medium text-gray-700">Foto Bukti Sampah</label>
                                <div class="mt-1">
                                    <div id="drop-zone" class="flex justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 py-10 transition-colors hover:border-indigo-400 cursor-pointer">
                                        <div class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M1 8a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.07 3h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0016.07 6H17a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V8zm13.5 3a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM10 14a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                            </svg>
                                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                <label for="foto_sampah" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2">
                                                    <span>Pilih foto</span>
                                                    <input id="foto_sampah" name="foto_sampah" type="file" class="sr-only" accept="image/*" required>
                                                </label>
                                                <p class="pl-1">atau drag & drop</p>
                                            </div>
                                            <p class="text-xs leading-5 text-gray-500 mt-1">PNG, JPG, JPEG, WebP max 5MB</p>
                                        </div>
                                    </div>
                                    {{-- Preview foto --}}
                                    <div id="preview-container" class="mt-3 hidden">
                                        <img id="preview-image" class="w-full max-h-64 object-cover rounded-lg border border-gray-200" alt="Preview foto">
                                        <button type="button" id="remove-photo" class="mt-2 text-sm text-red-600 hover:text-red-800 underline">
                                            Hapus foto
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-6">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Keterangan / Deskripsi (Opsional)</label>
                                <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Misal: Sampah berserakan di meja praktikum..."></textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('kelas.sampah.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline mr-4">Batal</a>
                            <button type="submit" id="btn-submit" disabled class="inline-flex items-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest cursor-not-allowed transition ease-in-out duration-150">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
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
                btnSubmit.classList.remove('bg-gray-400', 'cursor-not-allowed');
                btnSubmit.classList.add('bg-indigo-600', 'hover:bg-indigo-700', 'focus:bg-indigo-700', 'active:bg-indigo-900', 'focus:outline-none', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:ring-offset-2');
            }

            function disableSubmit() {
                btnSubmit.disabled = true;
                btnSubmit.classList.add('bg-gray-400', 'cursor-not-allowed');
                btnSubmit.classList.remove('bg-indigo-600', 'hover:bg-indigo-700', 'focus:bg-indigo-700', 'active:bg-indigo-900', 'focus:outline-none', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:ring-offset-2');
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
                        previewContainer.classList.remove('hidden');
                        dropZone.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    fotoSelected = false;
                    previewContainer.classList.add('hidden');
                    dropZone.classList.remove('hidden');
                }
                validateForm();
            });

            // Hapus foto
            removePhotoBtn.addEventListener('click', function() {
                fotoInput.value = '';
                fotoSelected = false;
                previewContainer.classList.add('hidden');
                dropZone.classList.remove('hidden');
                validateForm();
            });

            // Drag & drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            dropZone.addEventListener('dragover', function() {
                this.classList.add('border-indigo-500', 'bg-indigo-50');
            });

            dropZone.addEventListener('dragleave', function() {
                this.classList.remove('border-indigo-500', 'bg-indigo-50');
            });

            dropZone.addEventListener('drop', function(e) {
                this.classList.remove('border-indigo-500', 'bg-indigo-50');
                const files = e.dataTransfer.files;
                if (files.length > 0 && files[0].type.startsWith('image/')) {
                    fotoInput.files = files;
                    fotoInput.dispatchEvent(new Event('change'));
                }
            });

            // 1. Fetch ruangan saat halaman dimuat
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
                        ruanganSelect.classList.add('bg-gray-50');
                        noJadwalAlert.classList.remove('hidden');
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
                    pinaltiInfo.classList.remove('hidden');
                    pinaltiText.textContent = 'Sistem akan otomatis menentukan kelas di sesi sebelumnya sebagai penerima pinalti saat laporan dikirim.';
                } else {
                    pinaltiInfo.classList.add('hidden');
                }
                validateForm();
            });

            // 3. Validasi form
            ruanganSelect.addEventListener('change', validateForm);
        });
    </script>
</x-app-layout>
