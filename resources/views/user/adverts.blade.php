<h1>Объявления</h1>
<nav class="nav">
    <a class="nav-link active" href="home?status=1">Активные</a>
    <a class="nav-link" href="home?status=2">Проданные</a>
    <a class="nav-link" href="home?status=3">На проверке</a>
</nav>
<div class="list-group">
    @if($adverts->isEmpty())
        <a href="#" class="list-group-item disabled list-group-item-action" ><b>Список пуст</b></a>
    @else
        @foreach($adverts as $advert)
            <a href="{{route('advert', $advert->id)}}" class="list-group-item list-group-item-action">{{$advert->title}}</a>
        @endforeach
    @endif
</div>
