<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
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

    public function login(LoginAuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->on_black_list) {
            return redirect()->back()->withErrors(['login' => 'Ваш аккаунт был заблокирован!']);
        }

        if (Auth::attempt($request->validated())) {
            return redirect()->route('profile')->with([
                'message' => Auth::user()->name . ', добро пожаловать :)',
            ]);
        }

        return redirect()->back()->withErrors(['login' => 'Неверный логин или пароль!']);
    }

    public function register(RegisterAuthRequest $request)
    {
        $validatedData = $request->validated();

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
}
