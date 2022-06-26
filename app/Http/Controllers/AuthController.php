<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use RegistersUsers;

    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:dns', 'min:3', 'unique:users'],
            'username' => ['required', 'min:5', 'unique:users'],
            'password' => ['required', 'min:5']
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->roles()->attach(3);

        auth()->login($user);

        Alert::success('info', 'Registrasi Berhasil');
        return redirect()->route('customer.dashboard')->with('pesan', 'berhasil register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'min:5']
        ]);

        $cekEmail = User::where('email', $validated['email'])->get();

        if (count($cekEmail->all()) > 0 == false) {
            Alert::error('error', 'Email tidak ditemukan');
            return redirect()->route('user.login.view');
        }

        $passwordValid = Hash::check($request->password, $cekEmail[0]['password']);
        if (!$passwordValid) {
            Alert::error('error', 'Password salah');
            return redirect()->route('user.login.view');
        }
        


        if (Auth::attempt($validated)) {
            $user = Auth::user();
            if ($user->roles[0]->name === 'Admin') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('dashboard.admin');
            }
            if ($user->roles[0]->name === 'Super Admin') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('sp.users');
            }
            if ($user->roles[0]->name === 'Customer') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('customer.dashboard');
            }
            if ($user->roles[0]->name === 'Gudang') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('gudang.dashboard');
            }
            if ($user->roles[0]->name === 'Pemilik') {
                $request->session()->regenerate();
                Alert::success('info', 'Login Berhasil');
                return redirect()->route('dashboard.pemilik');
            }
        }

        Alert::success('error', 'Cek Email dan Password');
        return redirect()->route('user.login.view');
    }
}
