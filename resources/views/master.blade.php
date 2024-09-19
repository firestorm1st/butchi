<!DOCTYPE html>
<html lang="en">
<!-- head start -->

<head>

    <!-- Required meta tags -->
    @include('partials.head')
    <title>@yield('title')</title>

</head>
<!-- head end -->

<body>
    <!-- header section start -->
    @include('partials.header')

    @yield('content')

    @include('partials.link')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

</body>

</html>
