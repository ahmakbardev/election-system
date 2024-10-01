@extends('layouts.layout')

@section('content')
    <h4 class="text-xl font-bold mb-5">Daftar Sesi Pemilihan</h4>

    <a href="{{ route('sessions.create') }}" class="btn bg-blue-700 text-white font-medium py-2 px-4 rounded-md mb-5">Tambah
        Sesi</a>

    @if (session('success'))
        <div class="bg-green-500 text-white py-2 px-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full mt-5">
        <thead>
            <tr>
                <th>Nama Sesi</th>
                <th>Kode Unik</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sessions as $session)
                <tr>
                    <td>{{ $session->name }}</td>
                    <td>{{ $session->code }}</td>
                    <td>{{ $session->is_open ? 'Terbuka' : 'Tertutup' }}</td>
                    <td>
                        <a href="{{ route('sessions.edit', $session->id) }}"
                            class="btn bg-yellow-700 text-white py-2 px-4 rounded-md">Edit</a>
                        <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-red-700 text-white py-2 px-4 rounded-md">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
