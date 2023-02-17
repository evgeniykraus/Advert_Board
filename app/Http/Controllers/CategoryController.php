<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        $adverts = $category->adverts()->where([
            ['approved', '=', 1],
            ['sold', '=', 0],
        ]);

        $childCategories = $category->childrenCategories;
        foreach ($childCategories as $childCategory) {
            $childAdverts = $childCategory->adverts()
                ->where([
                    ['approved', '=', 1],
                    ['sold', '=', 0],
                ]);
            $adverts = $adverts->union($childAdverts);
        }

        $adverts = $adverts->paginate(9);

        return view('advert.index', ['adverts' => $adverts]);
    }
}
