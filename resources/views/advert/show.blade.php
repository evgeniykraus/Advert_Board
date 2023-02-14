@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-start">
        <div class="col-md-7 col-lg-7">
            <div class="card border-primary mx-5">
                <H1 class="card-title">{{$advert->title}}</H1>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/img/img.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/img/img.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="/img/img.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Цена:</h4>
                    <p class="card-text">{{$advert->price}} руб.</p>
                    <h4 class="card-title">Описание:</h4>
                    <p class="card-text">{{$advert->description}}</p>
                </div>
            </div>
        </div>
        <div class="col-8 col-md-6 col-lg-4">
            <div class="card-body">
                <h4 class="card-title">Дата публикации:</h4>
                <p class="card-text">{{date_format($advert->created_at, 'd.m.Y')}}</p>

                <h4 class="card-title">Продавец:</h4>
                <p class="card-text">{{$seller->name . ' ' . $seller->surname }}</p>
                <h4 class="card-title">Контакты:</h4>
                <h6 class="card-title">Телефон:</h6>
                <p class="card-text">{{$seller->phone}}</p>
                <h6 class="card-title">Email:</h6>
                <p class="card-text">{{$seller->email}}</p>
            </div>
        </div>

@endsection
