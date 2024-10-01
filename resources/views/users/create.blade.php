@extends('layouts.layout')

@section('content')
    <h4 class="text-xl font-bold mb-5">Tambah Pengguna Baru</h4>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold mb-2">Nama</label>
            <input type="text" id="name" name="name"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold mb-2">Password</label>
            <input type="password" id="password" name="password"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-semibold mb-2">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm" required>
        </div>

        <button type="submit" class="btn bg-blue-700 text-white font-medium py-2 px-4 rounded-md">Simpan</button>
    </form>
@endsection
