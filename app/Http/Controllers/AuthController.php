<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validatedFields = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:16'],
        ]);


        if (Auth::attempt($validatedFields)) {
            return $this->redirectToProfile();
        }

        return redirect(route('login'))->withErrors(['login' => 'Неверный логин или пароль!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

    private function redirectToProfile()
    {
        return redirect(route('profile'));
    }
}
