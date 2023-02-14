@extends('layouts.app')
@section('content')

    <table class="table table-bordered">

        @if($adverts->isEmpty())
            <a href="#" class="list-group-item disabled list-group-item-action"><b>Список пуст</b></a>
        @else
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Описание</th>
                <th scope="col">Ссылка</th>
                <th scope="col">Подтвердить</th>
                <th scope="col">Отклонить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($adverts as $advert)
                <tr>
                    <th scope="row">{{$advert->id}}</th>
                    <td>{{$advert->title}}</td>
                    <td>{{Illuminate\Support\Str::limit(strip_tags($advert->description),200)}}</td>
                    <td><a href="{{route('advert', $advert->id)}}"> Ссылка</a></td>
                    <td>
                        <a href="{{route('admin_panel', [$advert->id, 1])}}">
                            <button type="button" class="btn btn-outline-success">Подтвердить</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{route('admin_panel', [$advert->id, 2])}}">
                            <button type="button" class="btn btn-outline-danger">Отклонить</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
    </table>
@endsection
