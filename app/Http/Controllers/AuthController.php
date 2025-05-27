<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt($credentials)) {
        
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function dashboard(){

        $user = Auth::user();
        $userData = User::where('role', '!=', 1)->get();
        return view('dashboard', compact('user', 'userData'));
    }

    public function storeUser(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_role' => 'required|integer|in:2,3',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->user_role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.dashboard')->with('status', 'User created successfully.');
    }
    public function logout(){
        auth()->logout();
        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }
}
