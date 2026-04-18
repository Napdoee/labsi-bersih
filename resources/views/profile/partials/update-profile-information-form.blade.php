<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>
    <div>
        <x-text-input id="username" name="username" type="text" class="mt-1 block w-full bg-gray-100" :value="old('username', $user->username)" readonly />
        {{-- <span class="text-sm font-semibold text-gray-700 leading-tight">{{ Auth::user()->display_name }}</span>
        <span class="text-[11px] font-medium text-gray-400">{{  Str::upper( Auth::user()->roles->first()->name ?? 'Null') }}</span> --}}
    </div>
</section>
