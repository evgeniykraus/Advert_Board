@extends('layouts.app')

@section('content')
    <form action="{{ route('update') }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="Name">Имя</label>
                            <input type="text" class="form-control" name="name"
                                   value="{{ old('name') ?? $user->name }}">
                            @error('name')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="Surname">Фамилия</label>
                            <input type="text" class="form-control" name="surname"
                                   value="{{ old('surname') ?? $user->surname }}">
                            @error('surname')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Phone">Телефон</label>
                            <input type="text" class="form-control" name="phone"
                                   value="{{ old('phone') ?? $user->phone }}">
                            @error('phone')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="email"
                                   value="{{ old('email') ?? $user->email }}">
                            </label>
                            @error('email')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Password">Пароль</label>
                            <input type="text" class="form-control" name="password">
                            @error('password')
                            <div class="alert alert-danger" role="alert"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="admin" value="0">
                            <input id="adminCheckbox" name="admin" type="checkbox" class="custom-control-input"
                                   value="1"
                                {{ $user->admin ? 'checked' : '' }}>
                            <label class="custom-control-label" for="adminCheckbox">Админ</label>
                        </div>
                        <input hidden="" value="{{ $user->id }}" name="id">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>
    </form>

@endsection
