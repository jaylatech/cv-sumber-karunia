<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SuperAdminController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('sp.index', compact('users'));
    }

    public function tambahUserView(Request $request)
    {
        $roles = Role::all();
        return view('sp.create', compact('roles'));
    }

    public function tambahUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
        ]);

        $user->roles()->attach($request->role);

        Alert::success('info', 'User berhasil ditambahkan');
        return redirect()->route('sp.users');
    }

    public function userDetail(Request $request, $id)
    {
        $user = User::with('roles')->find($id);


        return view('sp.show', compact('user'));
    }

    public function userDetailEdit()
    {
    }

    public function editUser()
    {
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        $user->roles()->detach();

        Alert::success('info', 'User berhasil dihapus');
        
        return redirect()->route('sp.users');
    }
}
