<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertController extends Controller
{
    public function advertsToCheck(Request $request)
    {
        if (Auth::user()->admin) {

            $this->approve($request);

            return view('advert.need-check', ['adverts' => Advert::where('approved', 0)->get()]);

        } else {
            return response()
                ->view('layouts.403')
                ->setStatusCode(403);
        }

    }

    public function index()
    {
        $adverts = Advert::query()
            ->select(['id', 'title', 'description', 'price', 'created_at'])
            ->simplePaginate(9);
        return view('category.show', ['adverts' => $adverts]);
    }


    public function create()
    {
        return view('advert.add', ['creator_id' => Auth::id()]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $this->validateAdvertData($request);

        $advert = Advert::create($validatedData);

        if ($advert) {
            return redirect()->route('profile')
                ->with('message', 'Объявление создано!');
        }

        return redirect()->back()
            ->withErrors(['formError' => 'При создании объявления произошла ошибка']);
    }

    public function show($id)
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

    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        //
    }

    private function validateAdvertData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string', 'min:2', 'max:4000'],
            'category_id' => ['required', 'Integer', 'min:1'],
            'creator_id' => ['required', 'Integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0', 'max:100000000000'],
        ]);
    }
}
