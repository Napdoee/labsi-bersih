<x-app-layout>
    <div class="page-header">
        <h1 class="page-title">User Account</h1>
        <p class="page-subtitle">Manage your account security and view your information.</p>
    </div>

    <div class="grid-container">
        <!-- User Info Card -->
        <div class="card col-4">
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 2rem;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->displayName) }}&size=128&background=4F46E5&color=fff" alt="Profile Picture" style="width: 120px; height: 120px; border-radius: 24px; margin-bottom: 1rem; box-shadow: var(--shadow-lg);">
                <h2 style="font-size: 1.25rem; font-weight: 700;">{{ auth()->user()->displayName }}</h2>
                <span style="color: var(--text-muted); font-size: 0.9rem;">{{ auth()->user()->username }}</span>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div>
                    <span style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Status Akun</span>
                    <span style="font-weight: 500;">{{ auth()->user()->hasRole('asisten') ? 'Asisten Laboratorium' : 'Ketua Tingkat' }}</span>
                </div>
                <div>
                    <span style="display: block; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 600;">Bergabung Sejak</span>
                    <span style="font-weight: 500;">{{ auth()->user()->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="col-8">
            <!-- Edit Profile Form (Only for password information as requested) -->
            <div class="card" style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.25rem;">Ganti Kata Sandi</h3>
                <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 1.5rem;">
                    Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.
                </p>
                
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label class="form-label" for="current_password">Kata Sandi Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                        @if($errors->updatePassword->has('current_password'))
                            <span style="color: #EF4444; font-size: 0.75rem;">{{ $errors->updatePassword->first('current_password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Kata Sandi Baru</label>
                        <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                        @if($errors->updatePassword->has('password'))
                            <span style="color: #EF4444; font-size: 0.75rem;">{{ $errors->updatePassword->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                        @if($errors->updatePassword->has('password_confirmation'))
                            <span style="color: #EF4444; font-size: 0.75rem;">{{ $errors->updatePassword->first('password_confirmation') }}</span>
                        @endif
                    </div>

                    <div style="display: flex; align-items: center; gap: 1rem; margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        
                        @if (session('status') === 'password-updated')
                            <p style="font-size: 0.85rem; color: var(--secondary);">Berhasil disimpan.</p>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
