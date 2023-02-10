<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {
        if (Auth::check()) {
            return redirect(route('profile'));
        }

        return view('register.register');
    }

    public function store(Request $request)
    {
        $validatedFields = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:64'],
            'surname' => ['required', 'string', 'min:2', 'max:64'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:255',],
            'password-confirm' => ['required', 'string', 'min:6', 'max:255'],
        ]);

        $user = User::create($validatedFields);

        if ($user) {
            Auth::login($user);
            return redirect(route('profile'))
                ->with('message', $validatedFields['name'] . ', вы успешно зарегистрировались!');
        }

        return redirect(route('login'))
            ->withErrors([
                'formError' => 'При создании пользователя произошла ошибка'
            ]);
    }
}
