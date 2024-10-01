<?php

namespace App\Http\Controllers;

use App\Models\Pemilih;
use Illuminate\Http\Request;

class PemilihController extends Controller
{
    public function index()
    {
        $pemilih = Pemilih::all();
        return view('pemilih.index', compact('pemilih'));
    }

    public function create()
    {
        return view('pemilih.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_absen' => 'required|integer',
            'tingkat' => 'required|integer',
            'kelas' => 'required'
        ]);

        Pemilih::create([
            'nama' => $request->nama,
            'no_absen' => $request->no_absen,
            'tingkat' => $request->tingkat,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('pemilih.index')->with('success', 'Pemilih berhasil ditambahkan.');
    }

    public function edit(Pemilih $pemilih)
    {
        return view('pemilih.form', compact('pemilih'));
    }

    public function update(Request $request, Pemilih $pemilih)
    {
        $request->validate([
            'nama' => 'required',
            'no_absen' => 'required|integer',
            'tingkat' => 'required|integer',
            'kelas' => 'required'
        ]);

        $pemilih->update([
            'nama' => $request->nama,
            'no_absen' => $request->no_absen,
            'tingkat' => $request->tingkat,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('pemilih.index')->with('success', 'Data pemilih berhasil diperbarui.');
    }

    public function destroy(Pemilih $pemilih)
    {
        $pemilih->delete();
        return redirect()->route('pemilih.index')->with('success', 'Pemilih berhasil dihapus.');
    }

    public function importCsv(Request $request)
    {
        $file = $request->file('csv_file');

        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($row) == 4) {
                Pemilih::create([
                    'no_absen' => $row[0],
                    'nama' => $row[1],
                    'tingkat' => $row[2],
                    'kelas' => $row[3],
                ]);
            }
        }

        return redirect()->route('pemilih.index')->with('success', 'Data CSV berhasil diimport.');
    }
}
