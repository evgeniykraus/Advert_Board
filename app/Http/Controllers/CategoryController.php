<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $categories->transform(function ($category) use ($categories) {
            $category->children = $categories->where('parent_id', $category->id);
            return $category;
        });

        $categories = $categories->reject(function ($category) {
            return $category->parent_id !== null;
        });

        return view('category.index', ['categories' => $categories]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        $adverts = $category->adverts()->where('approved', 1)->simplePaginate(9);

        /*
         * Не получается добавить пагинацию, поэтому пока закомментировал!
                $childCategories = $category->children;
                foreach ($childCategories as $childCategory) {
                    $childAdverts = $childCategory->adverts()->where('approved', 1)->get();
                    $adverts = $adverts->concat($childAdverts);
                }
         */

        return view('category.show', ['adverts' => $adverts]);
    }
}
