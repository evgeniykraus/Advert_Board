<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('profile');
        }

        return view('register.register');
    }

    public function login(Request $request)
    {
        $validatedData = $this->validateLogin($request);

        if (!Auth::attempt($validatedData)) {
            return redirect()->back()->withErrors(['login' => 'Неверный логин или пароль!']);
        }

        return redirect()->route('profile')->with([
            'message' => Auth::user()->name . ', добро пожаловать :)',
        ]);
    }

    public function register(Request $request)
    {
        $validatedData = $this->validateUserData($request);

        $user = User::create($validatedData);

        if ($user) {
            Auth::login($user);
            return redirect()->route('profile')
                ->with('message', $validatedData['name'] . ', вы успешно зарегистрировались!');
        }

        return redirect()->back()
            ->withErrors(['formError' => 'При создании пользователя произошла ошибка']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    private function validateLogin(Request $request)
    {
        return $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:16'],
        ]);
    }

    private function validateUserData(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:64'],
            'surname' => ['required', 'string', 'min:2', 'max:64'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            'password_confirmation' => ['required', 'min:6', 'max:255'],
        ]);
    }
}
