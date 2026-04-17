<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\password;

class UserController extends Controller
{

    public function index()
    {
        return view("login");
    }

    public function register()
    {
        return view('register');
    }

    public function create_user(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        session(['user_id' => $user->id, 'username' => $user->username, 'email' => $user->email, 'role' => $user->role]);
        Auth::login($user);

        return redirect()->route('login');
    }

    public function validate(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('homepage');
        } else {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                session(['user_id' => $user->id, 'username' => $user->username, 'email' => $user->email, 'role' => $user->role]);
                Auth::login($user);

                if ($user->role == 'admin') {
                    return redirect()->route('admin_dashboard')->with('success', 'You have successfully logged in.');
                } else {
                    return redirect()->route('homepage')->with('success', 'You have successfully logged in.');
                }
            } else {
                return redirect()->route('login')->with('error', 'Invalid credentials');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
