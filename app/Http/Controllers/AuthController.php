<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }   
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt($credentials)) {

            $ip = $request->ip();

            // Update login time and IP
            auth()->user()->update([
                'last_login_at' => now(),
                'last_login_ip' => $ip,
            ]);
        
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(){
        auth()->logout();
        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }
}
