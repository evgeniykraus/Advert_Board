@foreach ($categories as $category)
    @if ($category->children->isNotEmpty())
        <optgroup label="{{$category->name}}">
            @include('advert.categories', ['categories' => $category->children])
        </optgroup>
    @else
        <option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif>
            {{$category->name}}
        </option>
    @endif
@endforeach

