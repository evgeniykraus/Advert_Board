@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        @if($message = session()->get('message', null))
            @include('layouts.alert')
        @endif

        <div class="row" style="margin-bottom: 30px">
            <div class="col-md-3">
                <img src="/img/avatar.png" class="img-fluid rounded-circle" alt="User Photo">
            </div>
            <div class="col-md-4">
                <h3>{{$user->name .' '. $user->surname}}</h3>
                <ul class="list-group">
                    <li class="list-group-item"><b>Email:</b> {{$user->email}} </li>
                    <li class="list-group-item"><b>Телефон:</b> {{$user->phone}} </li>
                    <li class="list-group-item"><b>Дата регистрации:</b> {{ date_format($user->created_at, 'd.m.Y')}} </li>
                    @if($user->admin === 1)
                        <a href="{{route('admin_panel')}}" class="btn btn-primary btn-lg active" role="button"
                           aria-pressed="true">Админка</a>
                    @endif
                </ul>
            </div>
        </div>
        @include('user.adverts')
    </div>

    <script>
        $('#myList a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection
