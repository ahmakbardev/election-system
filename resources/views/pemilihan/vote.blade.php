@extends('layouts.layout')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 relative">
        <!-- Informasi Pemilih -->
        <div id="pemilihInfo"
            class="fixed bottom-4 right-4 bg-white p-6 shadow-lg rounded-lg border-l-4 border-blue-600 max-w-md z-10">
            <button id="closePemilihInfo" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 class="text-sm font-semibold mb-4 flex items-center gap-2">
                <i class="ti ti-user text-blue-600"></i> Informasi Pemilih
            </h2>
            <div class="text-xs">
                <p class="mb-2"><strong>Nama:</strong> {{ $pemilih->nama }}</p>
                <p class="mb-2"><strong>No Absen:</strong> {{ str_pad($pemilih->no_absen, 2, '0', STR_PAD_LEFT) }}</p>
                <p class="mb-2"><strong>Tingkat:</strong> {{ $pemilih->tingkat }}</p>
                <p class="mb-2"><strong>Kelas:</strong> {{ $pemilih->kelas }}</p>
            </div>
        </div>

        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold mb-6 text-center">Pilih Calon Ketua</h1>

        <!-- Daftar Calon Ketua -->
        <form method="POST" action="{{ route('pemilihan.vote.submit') }}" class="py-10" id="voteForm">
            @csrf
            <div class="grid grid-cols-2 sm:grid-cols-2 mx-10 gap-6">
                @foreach ($calon_ketuas as $calon)
                    <div class="bg-white p-6 rounded-lg shadow-md calon-card cursor-pointer transition-all hover:shadow-lg"
                        data-calon-id="{{ $calon->id }}">
                        <div class="flex gap-5">
                            <img src="{{ asset('storage/foto_calon/' . $calon->foto) }}" alt="{{ $calon->nama }}"
                                class="w-60 max-h-60 object-cover object-center rounded-lg mb-4">
                            <div class="flex flex-col">
                                <h2 class="text-lg font-bold">{{ $calon->nama }}</h2>

                                <!-- Apply class text-sm to the paragraphs -->
                                @php
                                    $visiWithClass = str_replace('<p>', '<p class="text-sm">', $calon->visi);
                                    $misiWithClass = str_replace('<p>', '<p class="text-sm">', $calon->misi);
                                @endphp

                                <p class="text-sm text-gray-600"><strong>Visi:</strong> {!! $visiWithClass !!}</p>
                                <p class="text-sm text-gray-600"><strong>Misi:</strong> {!! $misiWithClass !!}</p>
                            </div>
                        </div>
                        <div class="mt-4 hidden">
                            <input type="radio" name="calon_id" value="{{ $calon->id }}" required>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Submit -->
            <div class="mt-6 px-10">
                <button type="button" id="submitVote"
                    class="btn bg-blue-600 w-full hover:bg-blue-700 py-2 text-white font-medium">
                    Submit Pilihan
                </button>
            </div>
        </form>

        <!-- Modal untuk Reminder -->
        <div id="reminderModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">Konfirmasi Pilihan</h2>
                <p class="text-gray-600">Apakah Anda yakin ingin memilih calon ini?</p>
                <div class="mt-4 flex justify-end space-x-4">
                    <button class="btn bg-gray-400 hover:bg-gray-500 text-white py-2 px-4" id="closeModal">Batal</button>
                    <button class="btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4" id="confirmVote">Pilih</button>
                </div>
            </div>
        </div>

        <!-- Script untuk Interaksi -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.calon-card');
                const submitButton = document.getElementById('submitVote');
                const modal = document.getElementById('reminderModal');
                const closeModal = document.getElementById('closeModal');
                const confirmVote = document.getElementById('confirmVote');
                const pemilihInfo = document.getElementById('pemilihInfo');
                const closePemilihInfo = document.getElementById('closePemilihInfo');
                let selectedCard = null;
                let selectedCalonId = null;

                // Event untuk memilih card dan memberikan border
                cards.forEach(card => {
                    card.addEventListener('click', function() {
                        if (selectedCard) {
                            selectedCard.classList.remove('border-blue-600', 'border-4');
                        }
                        this.classList.add('border-blue-600', 'border-4');
                        selectedCard = this;
                        selectedCalonId = this.dataset.calonId;
                        this.querySelector('input[type="radio"]').checked = true;
                    });
                });

                // Tampilkan modal ketika submit ditekan
                submitButton.addEventListener('click', function() {
                    if (selectedCalonId) {
                        modal.classList.remove('hidden');
                    } else {
                        alert('Silakan pilih salah satu calon terlebih dahulu.');
                    }
                });

                // Tutup modal
                closeModal.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });

                // Konfirmasi pemilihan
                confirmVote.addEventListener('click', function() {
                    document.getElementById('voteForm').submit();
                });

                // Tutup informasi pemilih
                closePemilihInfo.addEventListener('click', function() {
                    pemilihInfo.classList.add('hidden');
                });
            });
        </script>
    </div>
@endsection
