<div id="sidebar">
    <ul class="nav nav-stacked">
        <li>
            <h3 class="highlight">Categories
                @if(Auth::check())
                    <a href="{{route('category.create')}}">
                        <i class="glyphicon glyphicon-plus pull-right"></i>
                    </a>
                @else
                    <i class="glyphicon glyphicon-dashboard pull-right"></i>
                @endif
            </h3>
        </li>
        <li><a href="{{url('/')}}">All</a></li>
        @foreach($categories as $category)
            <li><a href="#">{{$category->name}}</a></li>
        @endforeach
    </ul>
</div>