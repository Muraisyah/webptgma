<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // show users split by role with separate paginations and optional name search
        $q = $request->query('q');

        $jemaahQuery = User::where('role','Jemaah')->orderBy('nama_lengkap');
        $adminQuery = User::where('role','Admin')->orderBy('nama_lengkap');
        $pimpinanQuery = User::where('role','Pimpinan')->orderBy('nama_lengkap');

        if (!empty($q)) {
            $like = "%{$q}%";
            $jemaahQuery->where('nama_lengkap','like',$like);
            $adminQuery->where('nama_lengkap','like',$like);
            $pimpinanQuery->where('nama_lengkap','like',$like);
        }

        $jemaah = $jemaahQuery->paginate(15, ['*'], 'jemaah_page')->appends(['q'=>$q]);
        $admin = $adminQuery->paginate(15, ['*'], 'admin_page')->appends(['q'=>$q]);
        $pimpinan = $pimpinanQuery->paginate(15, ['*'], 'pimpinan_page')->appends(['q'=>$q]);

        return view('admin.users.index', compact('jemaah','admin','pimpinan','q'));
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
            'no_hp'=>'nullable|string|max:20',
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
            'no_hp'=>'nullable|string|max:20',
            'password'=>'nullable|string|min:6',
            'role'=>'required|in:Jemaah,Admin,Pimpinan',
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']); else unset($data['password']);
        $user->update($data);
        return redirect()->route('admin.users.index')->with('success','User diperbarui');
    }

    // show method removed per UI requirements (no detail page)

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('success','User dihapus');
    }
}
