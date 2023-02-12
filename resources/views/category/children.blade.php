@foreach ($categories as $category)
    <div class="collapse" id="submenu{{$parent_id}}sub{{$parent_id}}" aria-expanded="false">
        <ul class="flex-column nav pl-4">

            @if($category->children->isNotEmpty())
                <div class="collapse" id="submenu0" aria-expanded="false">
                    <ul class="flex-column pl-2 nav">
                        <a class="nav-link  text-truncate collapsed py-1" href="category/{{$category->id}}"
                           data-toggle="collapse"
                           data-target="#submenu{{$category->id}}sub{{$category->id}}"><span>{{$category->name}}</span>
                        </a>
                        @if ($category->children->isNotEmpty())
                            @include('category.children', ['categories' => $category->children, 'parent_id' => $category->id,])
                        @endif
                    </ul>
                </div>
            @else
                <li class="nav-item">
                    <a class="nav-link p-1 text-truncate" href="category/{{$category->id}}">
                        <i class="fa fa-fw fa-clock-o"></i> {{$category->name}}
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endforeach
