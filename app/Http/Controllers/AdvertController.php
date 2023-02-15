<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveAdvertRequest;
use App\Http\Requests\StoreAdvertRequest;
use App\Models\Advert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdvertController extends Controller
{
    public function advertsToCheck()
    {
        return view('advert.need-check', ['adverts' => Advert::where('approved', 0)->paginate(5)]);
    }

    public function index()
    {
        $adverts = Advert::query()
            ->select(['id', 'title', 'description', 'price', 'created_at'])
            ->where('approved', 1)
            ->paginate(9);
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
        $advert = Advert::findOrFail($id);

        if (!$advert->approved && !$this->canViewUnapproved($advert)) {

            return response()->view('layouts.403')->setStatusCode(403);
        }

        return view('advert.show', [
            'advert' => $advert,
            'seller' => $advert->creator,
        ]);
    }

    public function approve(ApproveAdvertRequest $request)
    {
        $advert = Advert::where('id', $request->id)
            ->where('approved', 0)
            ->firstOrFail();

        $advert->update([
            'approved' => $request->approved,
            'verifier_id' => Auth::id(),
        ]);

        return $this->advertsToCheck();
    }

    private function canViewUnapproved(Advert $advert): bool
    {
        $user = Auth::user();
        return $user && ($user->admin || $user->id === $advert->creator_id);
    }
}
