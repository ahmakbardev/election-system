<?php

namespace App\Http\Controllers;

use App\Models\Pemilih;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show form to create a new user
    public function create()
    {
        return view('users.create');
    }

    // Store the newly created user in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User successfully created');
    }

    // Show form to edit an existing user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the user's information
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User successfully updated');
    }

    // Delete a user from the database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User successfully deleted');
    }

    public function showSesiForm()
    {
        return view('users.sesi-form');
    }

    public function joinSesi(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:sessions,code',
        ]);

        $session = Session::where('code', $request->code)->first();

        // Cek jika sesi masih terbuka
        if (!$session->is_open) {
            return redirect()->back()->withErrors('Sesi ini sudah tertutup.');
        }

        // Redirect ke halaman pemilihan calon ketua
        return redirect()->route('user.vote.form', $session->code);
    }
}
