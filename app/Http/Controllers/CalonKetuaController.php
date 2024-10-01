<?php

namespace App\Http\Controllers;

use App\Models\CalonKetua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CalonKetuaController extends Controller
{
    public function index()
    {
        $calon_ketua = CalonKetua::all();
        return view('calon_ketua.index', compact('calon_ketua'));
    }

    public function create()
    {
        return view('calon_ketua.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'foto' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        $fileNameToStore = 'noimage.jpg';
        if ($request->hasFile('foto')) {
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('foto')->storeAs('public/foto_calon', $fileNameToStore);
        }

        // Create Calon
        CalonKetua::create([
            'nama' => $request->nama,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'foto' => $fileNameToStore
        ]);

        return redirect()->route('calon_ketua.index')->with('success', 'Calon Ketua Berhasil Ditambahkan');
    }

    public function edit(CalonKetua $calon_ketua)
    {
        return view('calon_ketua.form', compact('calon_ketua'));
    }

    public function update(Request $request, CalonKetua $calon_ketua)
    {
        $request->validate([
            'nama' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'foto' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        $fileNameToStore = $calon_ketua->foto;
        if ($request->hasFile('foto')) {
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('foto')->storeAs('public/foto_calon', $fileNameToStore);
        }

        $calon_ketua->update([
            'nama' => $request->nama,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'foto' => $fileNameToStore
        ]);

        return redirect()->route('calon_ketua.index')->with('success', 'Calon Ketua Berhasil Diperbarui');
    }

    public function destroy(CalonKetua $calon_ketua)
    {
        if ($calon_ketua->foto != 'noimage.jpg') {
            Storage::delete('public/foto_calon/' . $calon_ketua->foto);
        }

        $calon_ketua->delete();
        return redirect()->route('calon_ketua.index')->with('success', 'Calon Ketua Berhasil Dihapus');
    }
}
