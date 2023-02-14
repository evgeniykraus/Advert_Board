<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Category;

class LoadCategoriesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $categories = Category::all();

        $categories->transform(function ($category) use ($categories) {
            $category->children = $categories->where('parent_id', $category->id);
            return $category;
        });

        $categories = $categories->reject(function ($category) {
            return $category->parent_id !== null;
        });

        view()->share('categories', $categories);

        return $next($request);
    }
}
