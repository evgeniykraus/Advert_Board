<style>
    button {
        border: 0;
        background: none;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }

    .dropdown-submenu > a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover > a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left > .dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }
</style>

<div class="container">
    <div class="row">
        <hr>
        <div class="dropdown">
            <button class="nav-link" type="button" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="false" aria-expanded="false">
                Категории
            </button>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu1">
                @foreach ($categories as $category)
                    <li class="dropdown-submenu">
                        <a class="dropdown-item" tabindex="-1"
                           href="{{route('category', $category->id)}}">{{$category->name}}</a>
                        @if ($category->childrenCategories->isNotEmpty())
                            @include('category.children', ['categories' => $category->childrenCategories])
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
