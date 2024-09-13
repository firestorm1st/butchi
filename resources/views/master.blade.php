
<!DOCTYPE html>
<html lang="en">
<!-- head start -->

<head>

    <!-- Required meta tags -->
    @include('partials.head')

</head>
<!-- head end -->

<body>
    <!-- header section start -->
    @include('partials.header')

    @yield('content')

    @include('partials.link')

</body>

</html>

