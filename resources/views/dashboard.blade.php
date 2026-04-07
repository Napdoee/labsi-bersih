<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 tracking-tight">
            {{ __('Dashboard Overview') }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, pantau metrik utama Anda hari ini.</p>
    </x-slot>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex items-center justify-between group hover:-translate-y-1 hover:shadow-[0_8px_20px_-6px_rgba(6,81,237,0.15)] transition-all duration-300">
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-1">Total Pengguna</p>
                <h3 class="text-3xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">1,245</h3>
                <div class="flex items-center gap-1 mt-2 text-xs">
                    <span class="text-emerald-500 font-medium flex items-center">
                        <svg class="w-3 h-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                        +12.5%
                    </span>
                    <span class="text-gray-400">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex items-center justify-between group hover:-translate-y-1 hover:shadow-[0_8px_20px_-6px_rgba(6,81,237,0.15)] transition-all duration-300">
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-1">Pendapatan</p>
                <h3 class="text-3xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors">Rp 45M</h3>
                <div class="flex items-center gap-1 mt-2 text-xs">
                    <span class="text-emerald-500 font-medium flex items-center">
                        <svg class="w-3 h-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                        +8.2%
                    </span>
                    <span class="text-gray-400">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex items-center justify-between group hover:-translate-y-1 hover:shadow-[0_8px_20px_-6px_rgba(6,81,237,0.15)] transition-all duration-300">
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-1">Pesanan Baru</p>
                <h3 class="text-3xl font-bold text-gray-900 group-hover:text-amber-500 transition-colors">320</h3>
                <div class="flex items-center gap-1 mt-2 text-xs">
                    <span class="text-rose-500 font-medium flex items-center">
                        <svg class="w-3 h-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        -2.4%
                    </span>
                    <span class="text-gray-400">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 flex items-center justify-between group hover:-translate-y-1 hover:shadow-[0_8px_20px_-6px_rgba(6,81,237,0.15)] transition-all duration-300">
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-1">Tingkat Konversi</p>
                <h3 class="text-3xl font-bold text-gray-900 group-hover:text-sky-500 transition-colors">4.5%</h3>
                <div class="flex items-center gap-1 mt-2 text-xs">
                    <span class="text-emerald-500 font-medium flex items-center">
                        <svg class="w-3 h-3 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"></path></svg>
                        +1.2%
                    </span>
                    <span class="text-gray-400">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-sky-50 flex items-center justify-center text-sky-500 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Chart Area -->
        <div class="xl:col-span-2 bg-white overflow-hidden shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 rounded-2xl">
            <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 tracking-tight">Aktivitas Terbaru</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Ringkasan grafik performa platform mingguan.</p>
                </div>
                <div class="flex items-center gap-2">
                    <select class="text-sm border-gray-200 rounded-lg text-gray-600 focus:ring-indigo-500 focus:border-indigo-500 py-1.5 pl-3 pr-8 bg-gray-50/50">
                        <option>Minggu Ini</option>
                        <option>Bulan Ini</option>
                        <option>Tahun Ini</option>
                    </select>
                </div>
            </div>
            <div class="p-6">
                <!-- Simulasi Bar Chart yang keren menggunakan Tailwind -->
                <div class="h-64 flex items-end gap-2 sm:gap-4 justify-between w-full relative pt-6">
                    <!-- Garis bantu background -->
                    <div class="absolute inset-0 flex flex-col justify-between pt-6 pb-6 pointer-events-none">
                        <div class="w-full border-b border-gray-100 border-dashed"></div>
                        <div class="w-full border-b border-gray-100 border-dashed"></div>
                        <div class="w-full border-b border-gray-100 border-dashed"></div>
                        <div class="w-full border-b border-gray-100 border-dashed"></div>
                    </div>
                    
                    <!-- Bars -->
                    <div class="relative w-full flex flex-col justify-end group cursor-pointer z-10"><div class="h-[40%] bg-indigo-200 group-hover:bg-indigo-300 rounded-t-lg transition-all"></div><span class="text-[10px] text-gray-400 text-center mt-2 font-medium">Sen</span></div>
                    <div class="relative w-full flex flex-col justify-end group cursor-pointer z-10"><div class="h-[70%] bg-indigo-500 group-hover:bg-indigo-600 rounded-t-lg shadow-md transition-all"></div><span class="text-[10px] text-gray-400 text-center mt-2 font-medium">Sel</span></div>
                    <div class="relative w-full flex flex-col justify-end group cursor-pointer z-10"><div class="h-[45%] bg-indigo-300 group-hover:bg-indigo-400 rounded-t-lg transition-all"></div><span class="text-[10px] text-gray-400 text-center mt-2 font-medium">Rab</span></div>
                    <div class="relative w-full flex flex-col justify-end group cursor-pointer z-10"><div class="h-[90%] bg-indigo-600 group-hover:bg-indigo-700 rounded-t-lg shadow-lg transition-all"></div><span class="text-[10px] text-gray-800 text-center mt-2 font-bold">Kam</span></div>
                    <div class="relative w-full flex flex-col justify-end group cursor-pointer z-10"><div class="h-[60%] bg-indigo-400 group-hover:bg-indigo-500 rounded-t-lg shadow-sm transition-all"></div><span class="text-[10px] text-gray-400 text-center mt-2 font-medium">Jum</span></div>
                    <div class="relative w-full flex flex-col justify-end group cursor-pointer z-10"><div class="h-[30%] bg-indigo-200 group-hover:bg-indigo-300 rounded-t-lg transition-all"></div><span class="text-[10px] text-gray-400 text-center mt-2 font-medium">Sab</span></div>
                    <div class="relative w-full flex flex-col justify-end group cursor-pointer z-10"><div class="h-[20%] bg-indigo-100 group-hover:bg-indigo-200 rounded-t-lg transition-all"></div><span class="text-[10px] text-gray-400 text-center mt-2 font-medium">Min</span></div>
                </div>
            </div>
        </div>

        <!-- Notifications/List Area -->
        <div class="bg-white overflow-hidden shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 rounded-2xl flex flex-col">
            <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center bg-white">
                <h3 class="text-lg font-bold text-gray-900 tracking-tight">Pemberitahuan</h3>
                <button class="text-[11px] font-bold text-indigo-600 hover:text-indigo-700 bg-indigo-50 hover:bg-indigo-100 px-2.5 py-1 rounded-md transition">Tandai Dibaca</button>
            </div>
            <div class="p-6 space-y-5 flex-1 overflow-y-auto">
                <!-- Item 1 -->
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500 flex-shrink-0 ring-4 ring-emerald-50/50 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900">Pesanan Selesai</p>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Pesanan #1200 atas nama Budi telah berhasil diproses ke pelanggan.</p>
                        <span class="text-[10px] font-medium text-gray-400 mt-1.5 block">2 jam yang lalu</span>
                    </div>
                </div>
                
                <!-- Item 2 -->
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500 flex-shrink-0 ring-4 ring-indigo-50/50 mt-0.5 relative">
                        <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-indigo-500 border-2 border-white rounded-full"></span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900">Pendaftaran Baru</p>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Siti Aminah telah membuat akun baru sebagai agen.</p>
                        <span class="text-[10px] font-medium text-indigo-400 mt-1.5 block">5 jam yang lalu</span>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="flex items-start gap-4 opacity-70">
                    <div class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center text-rose-500 flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-900">Peringatan Sistem</p>
                        <p class="text-xs text-gray-500 mt-1 leading-relaxed">Terjadi kegagalan sinkronisasi data pada server backup.</p>
                        <span class="text-[10px] font-medium text-gray-400 mt-1.5 block">1 hari yang lalu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
