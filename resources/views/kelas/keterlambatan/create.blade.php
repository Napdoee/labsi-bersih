<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lapor Keterlambatan Asisten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('kelas.keterlambatan.store') }}" method="POST">
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

                        <div class="mb-4">
                            <label for="id_jadwal" class="block text-sm font-medium text-gray-700">Pilih Jadwal Hari Ini</label>
                            <select id="id_jadwal" name="id_jadwal" required class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Sedang memuat jadwal... --</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="id_asisten" class="block text-sm font-medium text-gray-700">Nama Asisten</label>
                            <select id="id_asisten" name="id_asisten" required disabled class="mt-1 block w-full border-gray-300 bg-gray-50 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Jadwal Terlebih Dahulu --</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="waktu_masuk_aktual" class="block text-sm font-medium text-gray-700">Waktu Masuk Aktual</label>
                            <input type="time" id="waktu_masuk_aktual" name="waktu_masuk_aktual" required class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <p class="mt-1 text-xs text-gray-500">Masukkan jam saat asisten benar-benar masuk ke ruangan.</p>
                        </div>

                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Keterangan / Deskripsi (Opsional)</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Misal: Asisten masuk terlambat tanpa konfirmasi sebelumnya..."></textarea>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('kelas.keterlambatan.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline mr-4">Batal</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
            const jadwalSelect = document.getElementById('id_jadwal');
            const asistenSelect = document.getElementById('id_asisten');

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
                        jadwalSelect.disabled = true;
                    }
                })
                .catch(error => console.error('Error fetching jadwal:', error));

            // 2. Fetch Asisten saat jadwal dipilih
            jadwalSelect.addEventListener('change', function() {
                const idJadwal = this.value;
                
                asistenSelect.innerHTML = '<option value="">-- Memuat asisten... --</option>';
                asistenSelect.disabled = true;

                if (!idJadwal) {
                    asistenSelect.innerHTML = '<option value="">-- Pilih Jadwal Terlebih Dahulu --</option>';
                    return;
                }

                fetch(`/kelas/keterlambatan/asisten/${idJadwal}`)
                    .then(response => response.json())
                    .then(result => {
                        asistenSelect.innerHTML = '<option value="">-- Pilih Asisten --</option>';
                        
                        if(result.success && result.data.length > 0) {
                            result.data.forEach(asisten => {
                                asistenSelect.innerHTML += `<option value="${asisten.id_asisten}">${asisten.nama_asisten}</option>`;
                            });
                            asistenSelect.disabled = false;
                            asistenSelect.classList.remove('bg-gray-50');
                        } else {
                            asistenSelect.innerHTML = '<option value="">-- Tidak ada asisten terdaftar --</option>';
                        }
                    })
                    .catch(error => console.error('Error fetching asisten:', error));
            });
        });
        </script>
</x-app-layout>