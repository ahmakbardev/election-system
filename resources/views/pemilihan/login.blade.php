@extends('layouts.layout')

@section('content')
    <!-- Main Content -->
    <div
        class="flex flex-col w-full overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
        <div class="justify-center items-center w-full card lg:flex max-w-md ">
            <div class="w-full card-body">
                <button class="py-4 flex justify-center w-full">
                    <img src="{{ asset('assets/images/logos/logopgri2.png') }}" alt="" class="max-w-56" />
                </button>
                <p class="mb-4 text-gray-500 text-lg text-center">Pemilihan Ketua Osis</p>

                <!-- form -->
                <form method="POST" action="{{ route('pemilihan.login.submit') }}">
                    @csrf
                    <!-- Kode Unik -->
                    <div class="mb-4">
                        <label for="forUsername" class="block text-sm font-semibold mb-2 text-gray-600">Kode Unik</label>
                        <input type="text" id="forUsername" name="text"
                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                            placeholder="Masukkan kode unik (contoh: 01XDKV)" required autofocus disabled>
                    </div>

                    <!-- Submit button -->
                    <div class="grid my-6">
                        <button type="submit"
                            class="btn bg-blue-600 hover:bg-blue-700 py-[10px] text-base text-white font-medium"
                            disabled>Submit</button>
                    </div>

                    @if ($errors->any())
                        <div class="text-red-500 text-sm">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Timer Message -->
        <div id="timerMessage" class="text-center text-red-500 text-lg mt-4"></div>

        <!-- Panduan Login (langsung muncul) -->
        <div id="panduanModal"
            class="fixed right-4 top-4 w-full max-w-sm md:max-w-md bg-white shadow-md rounded-lg p-4 z-50">
            <h3 class="font-bold text-xl">Panduan Login</h3>
            <p class="text-base mt-2">1. Masukkan <b>kode unik</b> Anda yang terdiri dari <b>absen</b>, <b>tingkat</b>, dan
                <b>kelas</b> yang digabung menjadi satu <br>contoh = <b>01XITKJ2</b>.
            </p>
            <p class="text-base mt-1">2. Pastikan kode unik benar sebelum submit.</p>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toastContainer" class="fixed bottom-5 right-5 z-50 space-y-3">
        @if (session('success'))
            <div class="my-toast bg-green-500 text-white px-6 py-4 rounded shadow-md flex items-center space-x-2 opacity-0 transform -translate-y-10 transition-all duration-500"
                id="toast-success">
                <span>{{ session('success') }}</span>
                <button onclick="hideToast('toast-success')" class="focus:outline-none text-white">✕</button>
            </div>
        @endif

        @if (session('error'))
            <div class="my-toast bg-red-500 text-white px-6 py-4 rounded shadow-md flex items-center space-x-2 opacity-0 transform -translate-y-10 transition-all duration-500"
                id="toast-error">
                <span>{{ session('error') }}</span>
                <button onclick="hideToast('toast-error')" class="focus:outline-none text-white">✕</button>
            </div>
        @endif
    </div>

    <!-- Audio Notification -->
    <audio id="toastAudioSuccess" src="{{ asset('assets/audio/success.mp3') }}" preload="auto"></audio>
    <audio id="toastAudioError" src="{{ asset('assets/audio/error.mp3') }}" preload="auto"></audio>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timer = 15;
            const submitButton = document.querySelector('button[type="submit"]');
            const inputField = document.getElementById('forUsername');
            const timerMessage = document.getElementById('timerMessage');
            const toastAudioSuccess = document.getElementById('toastAudioSuccess');
            const toastAudioError = document.getElementById('toastAudioError');

            // Disable inputs and submit initially
            submitButton.disabled = true;
            inputField.disabled = true;

            const countdown = setInterval(function() {
                timerMessage.textContent = `Silakan tunggu ${timer} detik untuk login kembali...`;
                if (timer <= 0) {
                    clearInterval(countdown);
                    timerMessage.textContent = ''; // Clear the message
                    submitButton.disabled = false;
                    inputField.disabled = false;
                }
                timer--;
            }, 1000);

            // Toast notification logic
            const toastSuccess = document.getElementById('toast-success');
            const toastError = document.getElementById('toast-error');

            if (toastSuccess || toastError) {
                // Play audio notification based on the type
                if (toastSuccess) {
                    toastAudioSuccess.play();
                    showToastAnimation(toastSuccess);
                }
                if (toastError) {
                    toastAudioError.play();
                    showToastAnimation(toastError);
                }

                // Auto-hide after 5 seconds
                setTimeout(function() {
                    if (toastSuccess) {
                        hideToast(toastSuccess);
                    }
                    if (toastError) {
                        hideToast(toastError);
                    }
                }, 5000);
            }
        });

        function showToastAnimation(toast) {
            setTimeout(() => {
                toast.classList.remove('opacity-0', '-translate-y-10');
                toast.classList.add('opacity-100', 'translate-y-0');
            }, 200); // Delay to show animation
        }

        // Fungsi untuk menyembunyikan toast
        function hideToast(toast) {
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', '-translate-y-10');
            setTimeout(() => {
                toast.remove();
            }, 500); // Remove element after animation
        }
    </script>
@endsection
