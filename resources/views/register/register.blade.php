@extends('layouts.app')

@section('content')

    <form action="{{ route('register') }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="Name">Имя</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Surname">Фамилия</label>
                            <input type="text" class="form-control" name="surname" value="{{ old('surname') }}">
                            @error('surname')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Phone">Телефон</label>
                            <input type="number" class="form-control" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @error('email')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Password">Пароль</label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Password_confirmation">Подтвердить пароль</label>
                            <input type="password" class="form-control" name="password_confirmation">
                            @error('password_confirmation')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </form>

@endsection
