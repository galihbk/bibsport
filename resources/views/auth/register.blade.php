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
                <div class="mb-4 position-relative">
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red" />
                </div>
                <div class="mb-4 position-relative">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red" />
                </div>
                <div class="mb-4 position-relative">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="mb-1 text-dark" />
                    <x-text-input type="password" id="dlab-password2" class="form-control" type="password"
                        name="password" required autocomplete="new-password" />
                    <span class="show-pass eye" id="show-pass2">
                        <i class="fa fa-eye-slash"></i>
                        <i class="fa fa-eye"></i>
                    </span>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mb-4 position-relative">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                    <x-text-input id="password_confirmation" id="dlab-password1" class="form-control" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <span class="show-pass eye" id="show-pass1">
                        <i class="fa fa-eye-slash"></i>
                        <i class="fa fa-eye"></i>
                    </span>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red" />
                </div>
                <div class="form-row d-flex justify-content-between mt-4 mb-2">
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
                <h6 class="login-title"><span>Or continue with</span></h6>

                <div class="mb-3">
                    <ul class="d-flex align-self-center justify-content-center">
                        <li><a target="_blank" href="https://www.facebook.com/"
                                class="fab fa-facebook-f btn-facebook"></a></li>
                        <li><a target="_blank" href="https://www.google.com/"
                                class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
                        <li><a target="_blank" href="https://www.linkedin.com/"
                                class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
                        <li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
                    </ul>
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
                <a href="index.html"><img src="{{ url('assets') }}/img/logo-text-right.png" width="30%"
                        class="mb-3" alt=""></a>

                <p>Your true value is determined by how much more you give in value than you take in payment. ...</p>
            </div>
            <div class="login-media text-center">
                <img src="{{ url('assets-admin') }}/images/login.png" alt="">
            </div>
        </div>
    </div>
</x-guest-layout>
