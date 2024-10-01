@extends('layouts.layout')

@section('content')
    <h4 class="text-xl font-bold mb-5">Tambah Sesi Pemilihan</h4>

    <form action="{{ route('sessions.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold mb-2">Nama Sesi</label>
            <input type="text" name="name" id="name" class="block w-full border-gray-200 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="code" class="block text-sm font-semibold mb-2">Kode Unik</label>
            <input type="text" name="code" id="code" class="block w-full border-gray-200 rounded-md" required>
        </div>

        <button type="submit" class="btn bg-blue-700 text-white font-medium py-2 px-4 rounded-md">Buat Sesi</button>
    </form>
@endsection
