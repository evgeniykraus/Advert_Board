@extends('layouts.app')

@section('content')

    <form action="{{ route('login') }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
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
                        @error('login')
                        <div class="alert alert-danger" role="alert"> {{$message}} </div>
                        @enderror
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </form>
@endsection
