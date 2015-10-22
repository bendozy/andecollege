<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body class="">
@include('includes.nav')

{{--Content--}}
@yield('content')

@include('includes.scripts')
</body>
</html>