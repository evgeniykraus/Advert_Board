@extends('layouts.app')
@section('content')

    <div class="album py-5 bg-light">
        <nav class="navbar navbar-light bg-light">
            <form class="form-inline" method="post" action="{{route('search')}}">
                @csrf
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Поиск" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
            </form>
        </nav>
        @if($adverts->isEmpty())
            <h1>Список пуст</h1>
        @else
            <div class="container">
                <div class="row">
                    @foreach($adverts as $advert)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <p class="card-text">
                                        <b>{{ Illuminate\Support\Str::limit(strip_tags($advert->title), 25) }}</b>
                                    </p>
                                    <p class="card-text">Цена: {{ $advert->price }} ₽</p>
                                    <p class="card-text">
                                        Описание: {{ Illuminate\Support\Str::limit(strip_tags($advert->description), 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('advert', $advert->id) }}" type="button"
                                               class="btn btn-sm btn-outline-secondary">Посмотреть</a>
                                        </div>
                                        <small class="text-muted">Дата публикации:</small>
                                        <small
                                            class="text-muted">{{ date_format($advert->created_at, 'd.m.Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $adverts->links() }}
        @endif
    </div>
@endsection
