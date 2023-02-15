<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = User::query()
            ->select(['name', 'surname', 'phone', 'email', 'created_at',])
            ->where('id', Auth::user()->id)
            ->first();

        $adverts = $this->getUserAdverts();

        return view('user.profile', [
            'user' => $user,
            'adverts' => $adverts,
        ]);
    }

    protected function getUserAdverts()
    {
        switch ($_GET["status"] ?? false) {
            case 2:
                $adverts = Auth::user()->advert()->where('sold', 1)->paginate(5);
                break;
            case 3:
                $adverts = Auth::user()->advert()->where('approved', 0)->paginate(5);
                break;
            default:
                $adverts = Auth::user()->advert()->where([['sold', 0], ['approved', 1],])->paginate(5);
        }

        return $adverts;
    }
}
