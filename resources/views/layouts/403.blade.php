@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <div class="container py-5">
        <div class="row">
            <div class="col-md-2 text-center">
                <p><i class="fa fa-exclamation-triangle fa-5x"></i><br/>Status Code: 403</p>
            </div>
            <div class="col-md-10">
                <h3>УПС!!!! Простите...</h3>
                <p>Отказано в доступе.<br/>Вернитесь на предыдущую страницу, чтобы продолжить просмотр.</p>
                <a class="btn btn-danger" href="javascript:history.back()">Назад</a>
            </div>
        </div>
    </div>
@endsection
