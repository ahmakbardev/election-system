<?php

namespace App\Http\Controllers;

use App\Models\CalonKetua;
use App\Models\Pemilih;
use App\Models\PilihanSiswa;
use Illuminate\Http\Request;

class PemilihanController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('pemilihan.login');
    }

    // Process login
    public function processLogin(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        // Assume the 'text' is something like '01XDKV' (no_absen, tingkat, kelas)
        $email = $request->input('text');

        // Find the corresponding Pemilih data
        $pemilih = Pemilih::whereRaw("CONCAT(LPAD(no_absen, 2, '0'), tingkat, kelas) = ?", [$email])
            ->first();

        if ($pemilih) {
            // Check if the pemilih has already voted
            $alreadyVoted = PilihanSiswa::where('pemilih_id', $pemilih->id)->exists();

            if ($alreadyVoted) {
                // Redirect to login with a toast message saying the user has already voted
                return redirect()->route('pemilihan.login')->with('error', 'Anda sudah memilih calon ketua sebelumnya.');
            }

            // Store pemilih data in session
            session(['pemilih' => $pemilih]);

            // Redirect to vote page
            return redirect()->route('pemilihan.vote');
        } else {
            // Return back with error message if not found
            return back()->withErrors(['email' => 'Kode tidak ditemukan, periksa kembali.']);
        }
    }

    // Show vote form
    public function showVoteForm()
    {
        // Fetch all candidates
        $calon_ketuas = CalonKetua::all();

        // Fetch pemilih data from session
        $pemilih = session('pemilih');

        // Check if pemilih exists in session, if not, redirect to login
        if (!$pemilih) {
            return redirect()->route('pemilihan.login')->withErrors(['message' => 'Silakan login terlebih dahulu.']);
        }

        // Return view with candidate data and pemilih info
        return view('pemilihan.vote', compact('calon_ketuas', 'pemilih'));
    }

    public function submitVote(Request $request)
    {
        $request->validate([
            'calon_id' => 'required|exists:calon_ketuas,id',
        ]);

        // Get pemilih from session
        $pemilih = session('pemilih');

        // Cek apakah pemilih sudah memilih sebelumnya
        $alreadyVoted = PilihanSiswa::where('pemilih_id', $pemilih->id)->exists();

        if ($alreadyVoted) {
            return redirect()->route('pemilihan.login')->with('error', 'Anda sudah memilih.');
        }

        // Simpan pilihan ke tabel pilihan_siswa
        PilihanSiswa::create([
            'calon_ketua_id' => $request->calon_id,
            'pemilih_id' => $pemilih->id,
        ]);

        // Update vote count di tabel calon_ketuas
        $calonKetua = CalonKetua::find($request->calon_id);
        $calonKetua->increment('vote_count');

        // Clear pemilih data from session
        session()->forget('pemilih');

        // Redirect to login with success message
        return redirect()->route('pemilihan.login')->with('success', 'Selamat! Anda telah memilih Ketua OSIS!');
    }
}
