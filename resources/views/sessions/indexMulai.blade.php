@extends('layouts.layout')

@section('content')
    <h4 class="text-xl font-bold mb-5">Daftar Sesi Terbuka</h4>

    <table class="table-auto w-full mt-5">
        <thead>
            <tr>
                <th>Nama Sesi</th>
                <th>Kode Unik</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($openSessions as $session)
                <tr class="*:text-center *:py-3">
                    <td>{{ $session->name }}</td>
                    <td>{{ $session->code }}</td>
                    <td>
                        <!-- Tampilkan tombol "Mulai Sekarang" jika sesi terbuka -->
                        <a href="{{ route('pemilihan.login') }}"
                            class="btn bg-blue-700 text-white py-2 px-4 rounded-md">
                            Mulai Sekarang
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada sesi terbuka saat ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
