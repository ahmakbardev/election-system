@extends('layouts.layout')

@section('content')
    <h4 class="text-xl font-bold mb-5">Daftar Pengguna</h4>

    @if (session('success'))
        <div class="bg-green-500 text-white py-2 px-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('users.create') }}" class="btn bg-blue-700 text-white font-medium py-2 px-4 rounded-md mb-5">
        Tambah Pengguna
    </a>

    <table class="table-auto w-full mt-5 dataTable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="btn bg-yellow-700 text-white py-2 px-4 rounded-md">
                            Edit
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-red-700 text-white py-2 px-4 rounded-md">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
