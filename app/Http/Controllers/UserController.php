<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function adminPanel()
    {
        return view('admin.admin-panel');
    }

    public function usersList()
    {
        return view('admin.users-list', ['users' => User::paginate(5)]);
    }

    public function edit(Request $request)
    {
        $user = User::find($request->id);

        return view('admin.edit-user', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::findOrFail($request->id);

        $user->fill(array_filter($request->only([
            'name', 'surname', 'email', 'phone', 'password', 'admin'
        ]), fn($value) => $value !== null));

        $user->save();

        return redirect()->route('users')->with([
            'message' => 'Данные были обновлены!'
        ]);
    }


    public function blockUser(Request $request)
    {
        $user = User::findOrFail($request->id);

        $user->update([
            'on_black_list' => $request->value,
        ]);

        return redirect()->route('users')->with([
            'message' => 'Данные были обновлены!'
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
