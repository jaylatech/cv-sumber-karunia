<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if (!$user) return view('welcome.home');
        
        if ($user->roles[0]->name === 'Admin') {
            return redirect()->route('dashboard.admin');
        }
        if ($user->roles[0]->name === 'Super Admin') {
            return redirect()->route('sp.users');
        }
        if ($user->roles[0]->name === 'Customer') {
            return redirect()->route('customer.dashboard');
        }
        if ($user->roles[0]->name === 'Gudang') {
            return redirect()->route('gudang.dashboard');
        };
    }
}
