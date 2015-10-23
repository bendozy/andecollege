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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                class="glyphicon glyphicon-search"></i></a>
                    <ul class="dropdown-menu" style="padding:12px;">
                        <form class="form-inline">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i
                                                class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>
                        <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        @if (Auth::check())
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Edit Profile</a></li>
                            <li><a href="{{route('resource.create')}}">Add Resource</a></li>
                            <li><a href="#">My Resources</a></li>
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