@extends('layouts.app')
@section('content')
    <style>
        .nav-link[data-toggle].collapsed:after {
            content: " ▾";
        }

        .nav-link[data-toggle]:not(.collapsed):after {
            content: " ▴";
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 collapse show d-md-flex bg-light pt-2 pl-0" id="sidebar">
                <ul class="nav flex-column flex-nowrap overflow-hidden">
                    <li class="nav-item">
                        <a class="nav-link collapsed text-truncate" href="#submenu0" data-toggle="collapse"
                           data-target="#submenu0"><i class="fa fa-table"></i> <span
                                class="d-none d-sm-inline">Все категории</span>
                        </a>
                        @foreach ($categories as $category)
                            <div class="collapse" id="submenu0" aria-expanded="false">
                                <ul class="flex-column pl-2 nav">
                                    <a class="nav-link  text-truncate collapsed py-1" href="#"
                                       data-toggle="collapse"
                                       data-target="#submenu{{$category->id}}sub{{$category->id}}"><span>{{$category->name}}</span>
                                    </a>
                                    @if ($category->children->isNotEmpty())
                                        @include('category.children', ['categories' => $category->children, 'parent_id' => $category->id,])
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection()
