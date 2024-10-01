<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK PGRI 2 Malang</title>
    @if (app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Menggunakan manifest untuk memuat file CSS dan JS yang benar -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>
    @endif

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/logopgri1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.jqueryui.css"
        integrity="sha512-YydtVInqiFLmalqu/0L19ygXUp4dOTQaw/qjP/h5G8kIbTd9m60aEtZCH+D4oLor1I3C1ZOULeJeBrif+8KEaw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <main>
        <div id="main-wrapper" class="flex w-full">

            <!-- Gunakan Str::is untuk memeriksa wildcard -->
            @if (!Str::is('pemilihan*', Route::currentRouteName()))
                <!-- Cek apakah pengguna sudah login sebagai admin -->
                @auth('admin')
                    @include('layouts.components.sidebar')
                @endauth

                <!-- Cek apakah pengguna sudah login sebagai user biasa -->
                @auth('web')
                    @include('layouts.components.sidebar')
                @endauth
            @endif


            <div
                class="{{ !(Str::is('pemilihan*', Route::currentRouteName()) || Str::is('login*', Route::currentRouteName())) ? 'page-wrapper' : '' }} w-full overflow-hidden">
                <!-- Navbar hanya ditampilkan jika user atau admin terautentikasi -->
                @if (!Str::is('pemilihan*', Route::currentRouteName()))
                    @auth('admin')
                        @include('layouts.components.navbar')
                    @endauth

                    @auth('web')
                        @include('layouts.components.navbar')
                    @endauth
                @endif

                <main
                    class="{{ !(Str::is('pemilihan*', Route::currentRouteName()) || Str::is('login*', Route::currentRouteName())) ? 'h-full overflow-y-auto max-w-full pt-4 w-full' : '' }}">
                    <div
                        class="{{ !(Str::is('pemilihan*', Route::currentRouteName()) || Str::is('login*', Route::currentRouteName())) ? 'container full-container py-5 flex flex-col gap-6' : '' }}">
                        <!-- Toolbar, tampilkan berdasarkan peran user -->
                        @if (!Str::is('pemilihan*', Route::currentRouteName()))
                            @auth('admin')
                                @include('layouts.components.toolbar')
                            @endauth

                            @auth('web')
                                @include('layouts.components.toolbar')
                            @endauth
                        @endif

                        @yield('content')

                        <!-- Footer, umum untuk semua user -->
                        @include('layouts.components.footer')
                    </div>
                </main>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/iconify-icon/dist/iconify-icon.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@preline/dropdown/index.js') }}"></script>
    <script src="{{ asset('assets/libs/@preline/overlay/index.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>

    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <script>
        document.querySelectorAll('button[class*="bg-"], a[class*="bg-"]').forEach(element => {
            element.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');

                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = `${size}px`;

                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>

    <!-- DataTables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
