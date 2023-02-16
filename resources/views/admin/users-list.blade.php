@extends('layouts.app')
@section('content')

        @if($message = session()->get('message', null))
            @include('layouts.alert')
        @endif
    @include('admin.admin-nav-bar')
    <table class="table table-bordered">

        @if($users->isEmpty())
            <a href="#" class="list-group-item disabled list-group-item-action"><b>Список пуст</b></a>
        @else
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Имя</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Email</th>
                <th scope="col">Телефон</th>
                <th scope="col">Редактировать</th>
                <th scope="col">Заблокировать</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>
                        <form class="form-inline" method="get" action="{{route('edit')}}">
                            @csrf
                            <label>
                                <input hidden="" name="id" value="{{$user->id}}">
                            </label>
                            <button type="submit" class="btn btn-outline-success">Редактировать</button>
                        </form>
                    </td>
                    <td>
                        @if($user->on_black_list)
                            <form action="{{route('users')}}" method="post">
                                @csrf
                                <label>
                                    <input hidden="" name="id" value="{{$user->id}}">
                                    <input hidden="" value="0" name="value">
                                </label>
                                <button type="submit" class="btn btn-outline-success">Разблокировать</button>
                            </form>
                        @else
                            <form action="{{route('users')}}" method="post">
                                @csrf
                                <label>
                                    <input hidden="" value="{{$user->id}}" name="id">
                                    <input hidden="" value="1" name="value">
                                    <button type="submit" class="btn btn-outline-danger">Заблокировать</button>
                                </label>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
    </table>
    {{ $users->links() }}
@endsection
