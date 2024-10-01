@extends('layouts.layout')

@section('content')
    <h4 class="text-xl font-bold mb-5">Edit Pengguna</h4>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold mb-2">Nama</label>
            <input type="text" id="name" name="name"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm" value="{{ $user->name }}" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold mb-2">Email</label>
            <input type="email" id="email" name="email"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm" value="{{ $user->email }}" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold mb-2">Password (Kosongkan jika tidak ingin
                diubah)</label>
            <input type="password" id="password" name="password"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-semibold mb-2">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm">
        </div>

        <button type="submit" class="btn bg-blue-700 text-white font-medium py-2 px-4 rounded-md">Update</button>
    </form>
@endsection
