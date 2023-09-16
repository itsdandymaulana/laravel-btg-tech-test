<!DOCTYPE html>
<html lang="en">
@include('layout.partial.head')
<body>
    @include('layout.partial.navbar')

    <div class="container-fluid m-5">
        @yield('content')
    </div>

    @include('layout.partial.foot')
</body>
</html>
