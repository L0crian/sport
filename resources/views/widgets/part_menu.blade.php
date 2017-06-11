<li>
    <a href="">
        {{$category['title']}}
    </a>
    @if(isset($category['childs']))
        <ul class="list-group">
            {!!  \App\Widgets\Menu::getMenuHtml($category['childs']) !!}
        </ul>
    @else
        <ul>
            @foreach($category['articles'] as $article)
                <li list-group-item><a href="{{route('books.show', ['id' => $article['id']])}}">{{$article['title']}}</a></li>
            @endforeach
        </ul>
    @endif

</li>


