<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertRequest;
use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdvertController extends Controller
{
    public function advertsToCheck(Request $request)
    {
        $this->approve($request);

        return view('advert.need-check', ['adverts' => Advert::where('approved', 0)->get()]);
    }

    public function index()
    {
        $adverts = Advert::query()
            ->select(['id', 'title', 'description', 'price', 'created_at'])
            ->where('approved', 1)
            ->simplePaginate(9);
        return view('category.show', ['adverts' => $adverts]);
    }


    public function create()
    {
        return view('advert.add', ['creator_id' => Auth::id()]);
    }

    public function store(StoreAdvertRequest $request): RedirectResponse
    {
        Advert::create($request->validated());

        return redirect()->route('profile')
            ->with('message', 'Объявление создано!');
    }

    public function show(int $id)
    {
        $advert = Advert::find($id);

        if (!$advert) {
            abort(404);
        }

        $user = Auth::user();
        $userId = $user->id ?? false;
        $isAdmin = $user->admin ?? false;
        $isCreator = $userId == $advert->creator_id;

        if (!$advert->approved && !$isAdmin && !$isCreator) {
            return response()
                ->view('layouts.403')
                ->setStatusCode(403);
        }

        return view('advert.show', [
            'advert' => $advert,
            'seller' => $advert->creator,
        ]);
    }

    private function approve(Request $request)
    {
        if (isset($request->id) && isset($request->approve)) {

            $advert = Advert::where([
                ['id', $request->id],
                ['approved', 0],
            ]);

            if ($advert && $request->approve < 3) {
                $advert->update([
                    'approved' => $request->approve,
                    'verifier_id' => Auth::user()->id,
                ]);
            }
        }
    }
}
