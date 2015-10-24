<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.head')
    </head>
    <body class="">
    @include('includes.nav')
    <div class="page_content">
        {{--Content--}}
        @yield('content')
    </div>

    @include('includes.footer')
    @include('includes.scripts')
    </body>
</html>