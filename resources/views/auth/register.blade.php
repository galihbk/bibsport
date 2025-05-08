<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
        <div class="login-form">
            <div class="text-center">
                <h3 class="title">Daftar</h3>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-2 position-relative">
                    <x-input-label for="name" :value="__('Nama Organizer')" />
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" placeholder="CV/PT. Abc" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red" />
                </div>
                <div class="mb-2 position-relative">
                    <x-input-label for="email" :value="__('Email Organizer')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="email" placeholder="example@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red" />
                </div>
                <div class="mb-2 position-relative">
                    <x-input-label for="organizer_type" :value="__('Jenis Organizer')" />
                    <select name="organizer_type" id="organizer_type" class="form-control" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Perorangan" {{ old('organizer_type') == 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                        <option value="Badan Usaha" {{ old('organizer_type') == 'Badan Usaha' ? 'selected' : '' }}>Badan Usaha / Perusahaan</option>
                    </select>
                    <x-input-error :messages="$errors->get('organizer_type')" class="mt-2" style="color: red" />
                </div>
                <div class="row">
                    <div class="position-relative col-lg-6">
                        <x-input-label for="password" :value="__('Kata Sandi')" class="mb-1 text-dark" />
                        <x-text-input type="password" id="dlab-password2" class="form-control" type="password"
                            name="password" required autocomplete="new-password" />
                        <span class="show-pass eye" id="show-pass2">
                            <i class="fa fa-eye-slash"></i>
                            <i class="fa fa-eye"></i>
                        </span>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="col-lg-6 position-relative">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                        <x-text-input id="password_confirmation" id="dlab-password1" class="form-control" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <span class="show-pass eye" id="show-pass1">
                            <i class="fa fa-eye-slash"></i>
                            <i class="fa fa-eye"></i>
                        </span>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red" />
                    </div>
                </div>
                <div class="form-row d-flex justify-content-between mt-2 mb-2">
                    <div class="mb-4">
                    </div>
                    <div class="mb-4">
                        @if (Route::has('password.request'))
                        <a class="btn-link text-primary0" href="{{ route('password.request') }}">
                            {{ __('Lupa kata sandi?') }}
                        </a>
                        @endif
                    </div>
                </div>
                <div class="text-center mb-4">
                    <x-primary-button class="btn btn-primary btn-block">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </div>
                <p class="text-center">Sudah punya akun?
                    <a class="btn-link text-primary" href="{{ url('login') }}">Masuk disini</a>
                </p>
            </form>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="pages-left h-100">
            <div class="login-content">
                <a href="index.html"><img src="{{ url('assets') }}/img/logo-bibsport-text-right.png" width="30%"
                        class="mb-3" alt=""></a>

            </div>
            <div class="login-media text-center">
                <img src="{{ url('assets-admin') }}/images/login.png" alt="">
            </div>
        </div>
    </div>
</x-guest-layout>