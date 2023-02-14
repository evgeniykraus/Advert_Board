@extends('layouts.app')
@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($adverts as $advert)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <p class="card-tex"><b>{{Illuminate\Support\Str::limit(strip_tags($advert->title),25)}}</b></p>
                                <p class="card-tex">Цена: {{$advert->price}} ₽</p>
                                <p class="card-text">
                                    Описание: {{Illuminate\Support\Str::limit(strip_tags($advert->description),100)}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{route('advert', $advert->id)}}" type="button"
                                           class="btn btn-sm btn-outline-secondary">Посмотреть</a>
                                    </div>
                                    <small
                                        class="text-muted">Дата публикации:</small>
                                    <small
                                        class="text-muted">{{ date_format($advert->created_at, 'd.m.Y')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
