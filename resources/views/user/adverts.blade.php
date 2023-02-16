<h1>Объявления</h1>
<nav class="nav">
    <a class="nav-link active" href="{{route('profile', 'status=1')}}">Активные</a>
    <a class="nav-link" href="{{route('profile', 'status=2')}}">Проданные</a>
    <a class="nav-link" href="{{route('profile', 'status=3')}}">На проверке</a>
</nav>
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
        </tr>
        </thead>
        <tbody>
        @foreach($adverts as $advert)
            <tr>
                <th scope="row">{{$advert->id}}</th>
                <td>{{ Illuminate\Support\Str::limit(strip_tags($advert->title), 25) }}</td>
                <td>{{ Illuminate\Support\Str::limit(strip_tags($advert->description), 50) }}</td>
                <td><a href="{{route('advert', $advert->id)}}"> Ссылка</a></td>
                @if(!$advert->sold && $advert->approved)
                    <td>
                        <form action="{{route('sell')}}" method="post">
                            @csrf
                            <label>
                                <input hidden="" value="{{$advert->id}}" name="id">
                                <input hidden="" value="1" name="sold">
                                <button type="submit" class="btn btn-outline-success">Отметить как проданное</button>
                            </label>
                        </form>
                    </td>
                @endif
        @endforeach
        @endif
        </tbody>
</table>
{{ $adverts->appends(['status' => request()->status])->links() }}



