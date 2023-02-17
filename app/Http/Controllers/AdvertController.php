<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveAdvertRequest;
use App\Http\Requests\SellAdvertRequest;
use App\Http\Requests\StoreAdvertRequest;
use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdvertController extends Controller
{
    public function search(Request $request)
    {
        $request->validate(
            [
                'search' => 'required'
            ]);

        $query = Advert::query()
            ->where('approved', 1)
            ->where('sold', 0)
            ->where(function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });

        $adverts = $query->paginate(9);

        return view('advert.index', compact('adverts'));
    }

    public function advertsToCheck()
    {
        return view('admin.adverts-to-check', ['adverts' => Advert::where('approved', 0)->paginate(5)]);
    }

    public function index()
    {

        $adverts = Advert::query()
            ->select(['id', 'title', 'description', 'price', 'created_at'])
            ->where('approved', 1)
            ->paginate(9);
        return view('advert.index', ['adverts' => $adverts]);
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
            'category' => $advert->category,
            'viewer' => Auth::id() ?? false,
        ]);
    }

    public function approve(ApproveAdvertRequest $request)
    {
        $advert = Advert::findOrFail($request->id);

        $advert->update([
            'approved' => $request->approved,
            'verifier_id' => Auth::id(),
        ]);

        return $this->advertsToCheck();
    }

    public function sell(SellAdvertRequest $request)
    {
        $advert = Advert::findOrFail($request->id);

        $advert->update([
            'sold' => $request->sold,
        ]);

        return redirect()->route('profile')
            ->with('message', 'Объявление снято с публикации!');
    }

    private function canViewUnapproved(Advert $advert): bool
    {
        $user = Auth::user();
        return $user && ($user->admin || $user->id === $advert->creator_id);
    }
}
