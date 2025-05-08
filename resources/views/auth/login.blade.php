<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
        <div class="login-form">
            <div class="text-center">
                <h3 class="title">Masuk</h3>
                <p>Masuk untuk memulai menggunakan aplikasi</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">

                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control form-control" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red" />
                </div>
                <div class="mb-4 position-relative">
                    <x-input-label for="password" :value="__('Kata Sandi')" class="mb-1 text-dark" />

                    <x-text-input type="password" id="dlab-password" class="form-control form-control" type="password"
                        name="password" required autocomplete="current-password" />
                    <span class="show-pass eye">

                        <i class="fa fa-eye-slash"></i>
                        <i class="fa fa-eye"></i>

                    </span>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>
                <div class="form-row d-flex justify-content-between mt-4 mb-2">
                    <div class="mb-4">
                        <div class="form-check custom-checkbox mb-3">
                            <input type="checkbox" class="form-check-input" id="customCheckBox1" name="remember">
                            <label class="form-check-label mt-1" for="customCheckBox1">Ingat saya</label>
                        </div>
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
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
                <h6 class="login-title"><span>Or continue with</span></h6>

                <div class="mb-3">
                    <ul class="d-flex align-self-center justify-content-center">
                        <li><a target="_blank" href="https://www.google.com/"
                                class="btn-google-plus mx-2"><i class="fa-brands fa-google-plus-g"></i></a></li>
                    </ul>
                </div>
                <p class="text-center">Belum punya akun?
                    <a class="btn-link text-primary" href="{{ url('register') }}">Daftar disini</a>
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