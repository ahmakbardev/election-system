@extends('layouts.layout')

@section('content')
    <h4 class="text-xl font-bold mb-5">{{ isset($pemilih) ? 'Edit' : 'Tambah' }} Pemilih</h4>

    <form action="{{ isset($pemilih) ? route('pemilih.update', $pemilih->id) : route('pemilih.store') }}" method="POST">
        @csrf
        @if (isset($pemilih))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="no_absen" class="block text-gray-700">No Absen</label>
            <input type="number" name="no_absen" value="{{ old('no_absen', $pemilih->no_absen ?? '') }}" required
                class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="nama" class="block text-gray-700">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $pemilih->nama ?? '') }}" required
                class="w-full border border-gray-300 p-2 rounded">
        </div>

        <div class="mb-4">
            <label for="tingkat" class="block text-gray-700">Tingkat</label>
            <select name="tingkat" id="tingkat" required class="w-full border border-gray-300 p-2 rounded">
                <option value="">Pilih Tingkat</option>
                <option value="10" {{ old('tingkat', $pemilih->tingkat ?? '') == 10 ? 'selected' : '' }}>10</option>
                <option value="11" {{ old('tingkat', $pemilih->tingkat ?? '') == 11 ? 'selected' : '' }}>11</option>
                <option value="12" {{ old('tingkat', $pemilih->tingkat ?? '') == 12 ? 'selected' : '' }}>12</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="kelas" class="block text-gray-700">Kelas</label>
            <input type="text" name="kelas" value="{{ old('kelas', $pemilih->kelas ?? '') }}" required
                class="w-full border border-gray-300 p-2 rounded">
        </div>

        <button type="submit" class="btn bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
            {{ isset($pemilih) ? 'Update' : 'Tambah' }} Pemilih
        </button>
    </form>
@endsection
