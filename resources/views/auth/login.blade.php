<x-guest-layout>
    <div class="mb-8 text-center animate-fade-in">
        <a href="/" class="inline-flex flex-col items-center gap-4 group">
            <div class="w-50 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 ease-out">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-auto h-20" />
            </div>
            <div>
                <p class="text-indigo-600 font-semibold text-xs uppercase tracking-[0.2em] mt-2">Laboratorium Sistem Informasi</p>
            </div>
        </a>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Username -->
        <div class="group">
            <label for="username" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 group-focus-within:text-indigo-600 transition-colors duration-200">Username</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-300 group-focus-within:text-indigo-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="username" class="block w-full pl-12 pr-4 py-4 bg-white border border-gray-100 rounded-2xl focus:ring-[6px] focus:ring-indigo-500/5 focus:border-indigo-500 focus:shadow-sm transition-all duration-200 outline-none text-gray-700 font-medium placeholder:text-gray-300 shadow-[0_2px_10px_-3px_rgba(0,0,0,0.04)]" type="text" name="username" :value="old('username')" required autofocus placeholder="Masukkan Username" />
            </div>
            <x-input-error :messages="$errors->get('username')" class="mt-2 text-xs font-medium" />
        </div>

        <!-- Password -->
        <div class="group">
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-400 group-focus-within:text-indigo-600 transition-colors duration-200">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-indigo-600 hover:text-indigo-500 transition-colors" href="{{ route('password.request') }}">
                        Lupa?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-300 group-focus-within:text-indigo-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" class="block w-full pl-12 pr-4 py-4 bg-white border border-gray-100 rounded-2xl focus:ring-[6px] focus:ring-indigo-500/5 focus:border-indigo-500 focus:shadow-sm transition-all duration-200 outline-none text-gray-700 font-medium placeholder:text-gray-300 shadow-[0_2px_10px_-3px_rgba(0,0,0,0.04)]"
                                type="password"
                                name="password"
                                required placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-medium" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <div class="relative flex items-center">
                    <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-gray-200 text-indigo-600 shadow-sm focus:ring-indigo-500/20 cursor-pointer transition-all" name="remember">
                </div>
                <span class="ms-3 text-sm font-medium text-gray-500 group-hover:text-gray-700 transition-colors">{{ __('Ingat perangkat ini') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center items-center py-4 px-4 rounded-2xl shadow-xl shadow-indigo-100 bg-indigo-600 hover:bg-indigo-700 hover:shadow-indigo-200 text-white font-extrabold text-sm transition-all transform active:scale-[0.98]">
                Sign In ke Panel
                <svg class="ms-2 w-4 h-4 translate-x-0 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>
        </div>
    </form>

    <div class="mt-10 text-center">
        <p class="text-xs text-gray-400 font-medium">© {{ date('Y') }} LabSI Bersih. All rights reserved.</p>
    </div>
</x-guest-layout>
