@extends('layouts.layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-3">
            <div class="card">
                <div class="card-body">
                    <div class="sm:flex block justify-between mb-5">
                        <h4 class="text-gray-700 text-xl font-bold sm:mb-0 mb-2">Data Calon Ketua</h4>
                        <a href="{{ route('calon_ketua.create') }}"
                            class="btn text-white font-medium hover:bg-blue-700 py-2 px-4 rounded-md">
                            Tambah Calon Ketua
                        </a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="min-w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Visi</th>
                                    <th scope="col" class="px-6 py-3">Misi</th>
                                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($calon_ketua as $calon)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $calon->nama }}</td>
                                        <td class="px-6 py-4">{{ $calon->visi }}</td>
                                        <td class="px-6 py-4">{{ $calon->misi }}</td>
                                        <td class="px-6 py-4 flex gap-2 justify-center">
                                            <!-- Tombol Edit dengan warna biru -->
                                            <a href="{{ route('calon_ketua.edit', $calon->id) }}"
                                                class="btn text-white font-medium bg-transparent bg-sky-200 hover:bg-sky-400 py-2 px-4 rounded-md">Edit</a>

                                            <!-- Tombol Hapus dengan warna merah -->
                                            <form action="{{ route('calon_ketua.destroy', $calon->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn text-white font-medium hover:bg-red-700 py-2 px-4 rounded-md">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
