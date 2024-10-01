@extends('layouts.layout')

@section('content')
    <h4 class="text-2xl font-bold mb-8 text-gray-800">Daftar Pemilih</h4>

    <!-- Success message -->
    @if (session('success'))
        <div class="bg-green-500 text-white py-2 px-4 rounded mb-6 shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form for importing CSV -->
    <div class="flex justify-between items-center mb-6">
        <form action="{{ route('pemilih.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center">
            @csrf
            <input type="file" name="csv_file"
                class="block text-sm text-gray-900 border border-gray-300 rounded-lg mr-4 cursor-pointer focus:outline-none focus:ring focus:border-blue-300"
                required>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring">Import
                CSV</button>
        </form>

        <a href="{{ route('pemilih.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md focus:outline-none focus:ring">Tambah
            Pemilih</a>
    </div>

    <!-- Grouping and display by tingkat and kelas -->
    @foreach ($pemilih->groupBy(['tingkat', 'kelas']) as $tingkat => $kelasGroup)
        <div class="mb-10">
            <h5 class="text-xl font-semibold text-gray-700 mb-4 border-b border-gray-300 pb-2">Tingkat: {{ $tingkat }}
            </h5>

            @foreach ($kelasGroup as $kelas => $pemilihGroup)
                <h6 class="text-lg font-medium text-gray-600 mb-2">Kelas: {{ $kelas }}</h6>

                <!-- Table for pemilih per kelas -->
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full leading-normal dataTable">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    No. Absen</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Tingkat</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-300 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemilihGroup as $p)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="px-5 py-4 text-sm">{{ $p->no_absen }}</td>
                                    <td class="px-5 py-4 text-sm">{{ $p->nama }}</td>
                                    <td class="px-5 py-4 text-sm">{{ $p->tingkat }}</td>
                                    <td class="px-5 py-4 text-sm">{{ $p->kelas }}</td>
                                    <td class="px-5 py-4 text-sm">
                                        <a href="{{ route('pemilih.edit', $p->id) }}"
                                            class="text-yellow-600 hover:text-yellow-700 font-bold py-1 px-3 rounded-lg shadow focus:outline-none focus:ring">Edit</a>
                                        <form action="{{ route('pemilih.destroy', $p->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-700 font-bold py-1 px-3 rounded-lg shadow focus:outline-none focus:ring">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
