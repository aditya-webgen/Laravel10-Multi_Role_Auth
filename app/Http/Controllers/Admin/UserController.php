<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
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

    public function deleteUser($id)
    {
        $encid = decrypt($id);
        $user = User::findOrFail($encid);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('status', 'User deleted successfully.');
    }
}
