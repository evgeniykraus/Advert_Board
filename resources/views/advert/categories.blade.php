@foreach ($categories as $category)

    <option value="none" selected disabled hidden>Выберите категорию товара</option>

    @if ($category->children->isNotEmpty())
        <option disabled >--{{$category->name}}--</option>
        @include('advert.categories', ['categories' => $category->children])
    @else
        <option value="{{$category->id}}">{{$category->name}}</option>}}
    @endif

@endforeach

