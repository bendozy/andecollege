<nav class="navbar navbar-static">
    <div class="container">
        <a class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="glyphicon glyphicon-chevron-down"></span>
        </a>

        <div class="nav-collapse collase">
            <ul class="nav navbar-nav">
                <li><a href="{{route('index')}}">Home</a></li>
            </ul>
            <ul class="nav navbar-right navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>
                        <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        @if (Auth::check())
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Edit Profile</a></li>
                            <li><a href="{{route('resource.create')}}">Add Resource</a></li>
                            <li><a href="{{route('resource.user')}}">My Resources</a></li>
                            <li><a href="{{url(route('logout'))}}">Logout</a></li>
                        @else
                            <li><a href="{{route('getLogin')}}">Login</a></li>
                            <li><a href="{{url(route('getRegister'))}}">Register</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

@if (session('status'))
    <div class="container alert alert-success">
        {{ session('status') }}
    </div>
@endif