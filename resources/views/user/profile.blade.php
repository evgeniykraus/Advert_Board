@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        @if($message = session()->get('message', null))
            @include('layouts.alert')
        @endif

        <div class="row">
            <div class="col-md-3">
                <img src="" class="img-fluid rounded-circle" alt="User Photo">
            </div>
            <div class="col-md-9">
                <h3>Имя пользователя</h3>
                <p>Email пользователя</p>
            </div>
        </div>
    </div>

@endsection
