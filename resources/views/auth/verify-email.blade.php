<x-guest-layout>
    <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
        <div class="login-form">
            <div class="text-center">
                <h3 class="title">Verifikasi Email</h3>
            </div>
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan kepada Anda? Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan email lain kepada Anda.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                </div>
            @endif
            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-primary-button>
                            {{ __('Kirim Ulang') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
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
