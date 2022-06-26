<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'exist:users'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->roles[0]->name === 'Admin') {
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('dashboard.admin');
            }
            if ($user->roles[0]->name === 'Super Admin') {
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('sp.users');
            }
            if ($user->roles[0]->name === 'Customer') {
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('customer.dashboard');
            }
            if ($user->roles[0]->name === 'Gudang') {
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('gudang.dashboard');
            }
        }

        Alert::error('error', 'Cek Email dan Password');
        return redirect('login');
    }

    public function index()
    {
        return view('user.profil');
    }

    public function uploadPhoto(Request $request)
    {
        $filePath = Storage::disk('local')->put('images', $request->image);

        $user = User::find($request->id);

        $fileName = explode('/', $filePath)[1];

        $user->update([
            'photo' => $fileName
        ]);

        Alert::success('Info', 'Upload Foto Berhasil');
        return redirect()->back();
    }

    public function updateProfil(Request $request)
    {
        
        $user = User::find($request->id);

        if ($request->password === null) {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'telepon' => $request->telepon,
                'jenis_kelamin' => $request->gender
            ]);

            Alert::success('Info', "Profil berhasil diupdate");

            return redirect()->back();
        }

        $passwordValid = Hash::check($request->password_lama, $user->password);

        if (!$passwordValid) {
            Alert::error('Info', "Password lama salah");

            return redirect()->back();
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password_baru),
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'telepon' => $request->telepon,
            'jenis_kelamin' => $request->gender
        ]);

        Alert::success('Info', "Profil berhasil diupdate");

        return redirect()->back();
    }
}
