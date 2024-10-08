<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showIdentityForm()
    {
        return view('user.identity');
    }

    public function setIdentity(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'age' => 'required|integer|min:0',
            'role' => 'required|string|in:tourist,resident',
        ]);

        // Store user identity in the session
        Session::put('user_identity', $request->only(['name', 'address', 'gender', 'age', 'role']));

        return redirect()->route('user.dashboard');
    }
}
