<di class="container">
    @foreach ($categories as $category)
        <a href="{{ route('restaurants.index', ['category' => $category->id]) }}">{{ $category->name }}</a></label>
    @endforeach
<div>