<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.pengguna.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|in:admin,owner,kasir',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
        ]);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'User created successfully');
    }

    public function edit(User $pengguna)  // Parameter name changed to match route parameter
    {
        return view('admin.pengguna.edit', ['user' => $pengguna]); // Pass user data with specific key
    }

    public function update(Request $request, User $pengguna)  // Parameter name changed to match route parameter
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $pengguna->id,
            'usertype' => 'required|in:admin,owner,kasir',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->usertype = $request->usertype;

        if ($request->filled('password')) {
            $pengguna->password = Hash::make($request->password);
        }

        $pengguna->save();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $pengguna)  // Parameter name changed to match route parameter
    {
        $pengguna->delete();
        return redirect()->route('admin.pengguna.index')
            ->with('success', 'User deleted successfully');
    }
}