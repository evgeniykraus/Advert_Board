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
        $categories = Category::whereNull('parent_id')
            ->with('childrenCategories')
            ->get();

        view()->share('categories', $categories);

        return $next($request);
    }
}
