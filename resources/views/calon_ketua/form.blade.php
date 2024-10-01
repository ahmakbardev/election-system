@extends('layouts.layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="col-span-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-gray-700 text-xl font-bold mb-5">{{ isset($calon_ketua) ? 'Edit' : 'Tambah' }} Calon
                        Ketua</h4>
                    <form
                        action="{{ isset($calon_ketua) ? route('calon_ketua.update', $calon_ketua->id) : route('calon_ketua.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($calon_ketua))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Input Nama -->
                            <div>
                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-700"
                                    value="{{ old('nama', $calon_ketua->nama ?? '') }}">
                            </div>

                            <!-- Input Visi -->
                            <div>
                                <label for="visi" class="block mb-2 text-sm font-medium text-gray-700">Visi</label>
                                <textarea name="visi" id="visi" rows="5"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-700">{{ old('visi', $calon_ketua->visi ?? '') }}</textarea>
                            </div>

                            <!-- Input Misi -->
                            <div>
                                <label for="misi" class="block mb-2 text-sm font-medium text-gray-700">Misi</label>
                                <textarea name="misi" id="misi" rows="5"
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-700">{{ old('misi', $calon_ketua->misi ?? '') }}</textarea>
                            </div>

                            <!-- Input Foto -->
                            <div>
                                <label for="foto" class="block mb-2 text-sm font-medium text-gray-700">Foto
                                    (Opsional)</label>
                                <input type="file" name="foto" id="foto"
                                    class="w-full px-4 py-2 border rounded-md">
                                @if (isset($calon_ketua) && $calon_ketua->foto)
                                    <img src="{{ asset('storage/foto_calon/' . $calon_ketua->foto) }}" alt="Foto Calon"
                                        class="mt-4 h-20 w-20 object-cover rounded-md">
                                @endif
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit"
                                class="btn hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                                {{ isset($calon_ketua) ? 'Update' : 'Tambah' }} Calon Ketua
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- CKEditor Script -->
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script>
        // Basic CKEditor for Visi field
        ClassicEditor
            .create(document.querySelector('#visi'))
            .catch(error => {
                console.error(error);
            });

        // Basic CKEditor for Misi field
        ClassicEditor
            .create(document.querySelector('#misi'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
