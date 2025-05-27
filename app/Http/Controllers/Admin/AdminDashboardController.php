<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $userData = User::where('role', '!=', 1)->get();
        return view('dashboard', compact('user', 'userData'));
    }
}
