<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap'=>'required|string|max:35',
            'email'=>'required|email|unique:user,email',
            'username'=>'required|string|unique:user,username',
            'password'=>'required|string|min:6',
            'role'=>'required|in:Jemaah,Admin,Pimpinan',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('admin.users.index')->with('success','User dibuat');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'nama_lengkap'=>'required|string|max:35',
            'email'=>'required|email|unique:user,email,'.$user->id_user.',id_user',
            'username'=>'required|string|unique:user,username,'.$user->id_user.',id_user',
            'password'=>'nullable|string|min:6',
            'role'=>'required|in:Jemaah,Admin,Pimpinan',
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']); else unset($data['password']);
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success','User diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('success','User dihapus');
    }
}
