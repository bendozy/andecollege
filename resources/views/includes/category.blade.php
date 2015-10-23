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
        <li><a href="#">All</a></li>
        <li><a href="#">Link</a></li>
    </ul>
</div>