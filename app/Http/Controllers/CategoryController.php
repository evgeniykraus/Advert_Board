<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        $adverts = $category->adverts()->where('approved', 1)->get();

        $childCategories = $category->children;
        foreach ($childCategories as $childCategory) {
            $childAdverts = $childCategory->adverts()->where('approved', 1)->get();
            $adverts = $adverts->concat($childAdverts);
        }

        return view('category.show', ['adverts' => $adverts]);
    }

}
