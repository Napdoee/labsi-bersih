@php
    $navClasses = "flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 ease-in-out font-medium ";
    $activeClasses = $navClasses . "bg-indigo-50 text-indigo-700 shadow-[inset_0px_0px_0px_1px_rgba(99,102,241,0.1)]";
    $inactiveClasses = $navClasses . "text-gray-600 hover:bg-gray-50 hover:text-gray-900";
@endphp

<!-- Desktop Sidebar -->
<aside class="hidden lg:flex flex-col w-[280px] h-screen border-r border-gray-100 bg-white shadow-[2px_0_8px_-4px_rgba(0,0,0,0.05)] z-20">
    <!-- Logo -->
    <div class="flex items-center h-20 px-8 border-b border-gray-50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 font-bold text-2xl text-indigo-600">
            <x-application-logo class="block h-9 w-auto fill-current" />
            <span class="tracking-tight">{{ config('app.name', 'Laravel') }}</span>
        </a>
    </div>
    
    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 custom-scrollbar">
        <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-4 px-4">Menu Utama</div>
        
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? $activeClasses : $inactiveClasses }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            {{ __('Dashboard') }}
        </a>
        
        <a href="#" class="{{ $inactiveClasses }}">
            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Data Pengguna
        </a>

        <a href="#" class="{{ $inactiveClasses }}">
            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Laporan
        </a>
    </div>
</aside>

<!-- Mobile Sidebar Backdrop -->
<div 
    x-show="sidebarOpen" 
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-gray-900/40 z-40 lg:hidden backdrop-blur-sm"
    @click="sidebarOpen = false"
    style="display: none;"
></div>

<!-- Mobile Sidebar -->
<aside 
    x-show="sidebarOpen"
    x-transition:enter="transition ease-in-out duration-300 transform"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-50 w-[280px] bg-white shadow-2xl lg:hidden flex flex-col h-screen"
    style="display: none;"
>
    <!-- Logo & Close Button -->
    <div class="flex items-center justify-between h-20 px-6 border-b border-gray-50">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 font-bold text-2xl text-indigo-600">
            <x-application-logo class="block h-8 w-auto fill-current" />
            <span>{{ config('app.name', 'Laravel') }}</span>
        </a>
        <button @click="sidebarOpen = false" class="p-2 -mr-2 text-gray-400 hover:bg-gray-100 rounded-xl focus:outline-none transition">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation Area -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 custom-scrollbar">
        <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-4 px-4">Menu Utama</div>
        
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? $activeClasses : $inactiveClasses }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            {{ __('Dashboard') }}
        </a>
        
        <a href="#" class="{{ $inactiveClasses }}">
            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Data Pengguna
        </a>
    </div>
    
    <!-- Mobile Logout Bottom -->
    <div class="p-4 border-t border-gray-50 bg-gray-50/50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-200 font-medium">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Keluar
            </button>
        </form>
    </div>
</aside>

<style>
/* Custom scrollbar for webkit */
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: #e5e7eb;
    border-radius: 10px;
}
.custom-scrollbar:hover::-webkit-scrollbar-thumb {
    background-color: #d1d5db;
}
</style>
