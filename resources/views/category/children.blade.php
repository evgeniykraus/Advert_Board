<ul class="dropdown-menu">
    @foreach ($categories as $category)
        @if ($category->childrenCategories->isNotEmpty())
            <li class="dropdown-submenu">
                <a class="dropdown-item" tabindex="-1"
                   href="{{route('category', $category->id)}}">{{$category->name}}</a>
                @include('category.children', ['categories' => $category->childrenCategories])
            </li>
        @else
            <li class="dropdown-item">
                <a href="{{route('category', $category->id)}}">{{$category->name}}</a>
            </li>
        @endif
    @endforeach
</ul>
