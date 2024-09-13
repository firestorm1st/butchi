
<!DOCTYPE html>
<html lang="en">
<!-- head start -->

@include('guest.partials.head')
<!-- head end -->

<body>
    @include('guest.partials.header')

    @yield('content')

    @include('guest.partials.link')

</body>

</html>

