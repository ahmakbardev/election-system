<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::all();
        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:sessions,code',
        ]);

        Session::create([
            'name' => $request->name,
            'code' => $request->code,
            'is_open' => true,
        ]);

        return redirect()->route('sessions.index')->with('success', 'Sesi pemilihan berhasil dibuat.');
    }

    public function edit(Session $session)
    {
        return view('sessions.edit', compact('session'));
    }

    public function update(Request $request, Session $session)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:sessions,code,' . $session->id,
        ]);

        $session->update([
            'name' => $request->name,
            'code' => $request->code,
            'is_open' => $request->is_open ? true : false,
        ]);

        return redirect()->route('sessions.index')->with('success', 'Sesi pemilihan berhasil diperbarui.');
    }

    public function destroy(Session $session)
    {
        $session->delete();
        return redirect()->route('sessions.index')->with('success', 'Sesi pemilihan berhasil dihapus.');
    }

    public function indexMulaiSession()
    {
        // Ambil semua sesi yang terbuka (is_open = true)
        $openSessions = Session::where('is_open', true)->get();

        return view('sessions.indexMulai', compact('openSessions'));
    }
}
