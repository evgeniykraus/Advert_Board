@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-7 col-lg-7">
            <form action="{{route('add_advert')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="Title">Заголовок</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    @error('title')
                    <div class="alert alert-danger" role="alert"> {{$message}} </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Price">Цена</label>
                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                    @error('price')
                    <div class="alert alert-danger" role="alert"> {{$message}} </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Category">Категория</label>
                    <select class="form-control" name="category_id">
                        @include('advert.categories')
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger" role="alert"> {{$message}} </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="Description">Описание</label>
                    <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="alert alert-danger" role="alert"> {{$message}} </div>
                    @enderror
                </div>
                <input hidden name="creator_id" value="{{$creator_id}}">
                <div>
                    <button type="submit" class="btn btn-primary mb-1">Опубликовать</button>
                </div>
            </form>
        </div>
    </div>
@endsection
