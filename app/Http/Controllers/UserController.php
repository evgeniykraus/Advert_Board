<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = User::find(Auth::user()->id);

        $userData = [
            'name' => $user->name,
            'surname' => $user->surname,
            'phone' => $user->phone,
            'email' => $user->email,
            'registerDate' => date_format($user->created_at, 'd.m.Y'),
        ];

        $adverts = $this->getUserAdverts($user);

        return view('user.profile', [
            'user' => $userData,
            'adverts' => $adverts,
        ]);
    }

    protected function getUserAdverts(User $user)
    {
        switch ($_GET["status"] ?? false) {
            case 2:
                $adverts = $user->advert()->where('sold', 1)->get();
                break;
            case 3:
                $adverts = $user->advert()->where('approved', 0)->get();
                break;
            default:
                $adverts = $user->advert()->where([['sold', 0], ['approved', 1],])->get();
        }

        return $adverts;
    }
}
