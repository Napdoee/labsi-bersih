<header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-[0_1px_2px_0_rgba(0,0,0,0.02)]">
    <div class="px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-14">
            <!-- Left side: Hamburger & Search -->
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden hover:text-indigo-600 hover:bg-indigo-50 p-2 rounded-xl transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <!-- Search bar -->
                <div class="hidden md:flex items-center">
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-4 h-4 text-gray-400 group-focus-within:text-indigo-500 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" class="w-64 lg:w-80 py-2.5 pl-10 pr-4 text-sm text-gray-700 bg-gray-50/50 border border-gray-200 rounded-full focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder-gray-400" placeholder="Cari sesuatu (Ctrl+/)...">
                        
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-[10px] font-medium text-gray-400 border border-gray-200 rounded px-1.5 py-0.5 bg-white">/</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side: Notifications & Profile -->
            <div class="flex items-center gap-2 sm:gap-4">
                
                <!-- Notification Bell -->
                <button class="p-2.5 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition relative shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <!-- Badge -->
                    <span class="absolute top-2 right-2.5 w-2.5 h-2.5 bg-rose-500 border-2 border-white rounded-full"></span>
                </button>

                <!-- Settings Dropdown -->
                <div class="relative shrink-0">
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 p-1.5 border border-gray-100 rounded-full focus:outline-none transition hover:bg-gray-50 group hover:border-gray-200">
                                <img class="object-cover w-8 h-8 rounded-full ring-2 ring-transparent group-hover:ring-indigo-100 transition shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&bold=true" alt="{{ Auth::user()->name }}">
                                <div class="hidden lg:flex flex-col text-left mr-2">
                                    <span class="text-sm font-semibold text-gray-700 leading-tight">{{ Auth::user()->name }}</span>
                                    <span class="text-[11px] font-medium text-gray-400">Administrator</span>
                                </div>
                                <svg class="hidden lg:block w-4 h-4 text-gray-400 mr-1 group-hover:text-gray-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Mobile info -->
                            <div class="px-4 py-3 border-b border-gray-50 lg:hidden bg-gray-50/50">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-3 py-2.5 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ __('Profil Saya') }}
                            </x-dropdown-link>

                            <x-dropdown-link href="#" class="flex items-center gap-3 py-2.5 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 transition">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ __('Pengaturan') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-50 my-1"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="flex items-center gap-3 py-2.5 text-sm font-medium text-rose-600 hover:text-rose-700 hover:bg-rose-50 transition"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                
            </div>
        </div>
    </div>
</header>
