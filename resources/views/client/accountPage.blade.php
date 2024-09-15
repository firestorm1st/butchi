@extends('master')
@section('content')
    <div class="container_account">

        <div class="left-column">
            <div class="center">
                <h2 style="font-family:'Dancing Script'; font-size: 36px;">{{ $user->username }}</h2>
                @if ($user->avatar)
                    <img src="{{ asset('uploads/' . $user->avatar) }}" alt="Hình đại diện người dùng" width='200px'
                        height='200px'>
                @else
                    <img src="{{ asset('client/image/avatar.png') }}" alt="Avatar">
                @endif
                {{-- <p style="font-family: 'true typewriter';">Thay đổi hình đại diện</p> --}}
            </div>
            <div style="font-size: 18px">
                <b style="display: inline-block; ">Giao diện: </b>

                @if ($user->role == 1)
                    <p style="display: inline-block;">Học sinh</p>
                @elseif ($user->role == 2)
                    <p style="display: inline-block;">Phụ huynh</p>
                @elseif ($user->role == 3)
                    <p style="display: inline-block;">Admin</p>
                @endif
            </div>

            <div style="font-size: 18px">
                <b style="display: inline-block; ">Email: </b>
                <p style="display: inline-block;">{{ $user->email }}</p>
            </div>

            <div style="font-size: 18px">
                <b style="display: inline-block; ">Nhiệm vụ: </b>
                @if ($user->is_offline == 1)
                    <p style="display: inline-block;">Trực tiếp</p>
                @elseif ($user->is_offline == 2)
                    <p style="display: inline-block;">Trực tuyến</p>
                @endif
            </div>

            <a style="margin-top: 10px" href="{{ route('client.changeAccount', ['id' => $user->id]) }}" class="btn btn-primary"
                style="font-family: 'true typewriter';">Cập nhật thông tin</a>
            {{-- <a  href="#">Đổi mật khẩu</a> --}}
        </div>

        <div class="right-column">
            <div class="icon-container">
                <img src="{{ asset('client/image/giandu.png') }}" alt="Avatar">
                <img src="{{ asset('client/image/mongdoi.png') }}" alt="Avatar">
                <img src="{{ asset('client/image/vuive.png') }}" alt="Avatar">
                <img src="{{ asset('client/image/tintuong.png') }}" alt="Avatar">
                <img src="{{ asset('client/image/sohai.png') }}" alt="Avatar">
                <img src="{{ asset('client/image/batngo.png') }}" alt="Avatar">
                <img src="{{ asset('client/image/buonba.png') }}" alt="Avatar">
                <img src="{{ asset('client/image/changhet.png') }}" alt="Avatar">
            </div>
        </div>
    </div>
    <style>
        body {
            background-image: url("{{ asset('client/image/bg.png') }}");
            background-size: cover;
            /* Makes sure the background image covers the whole page */
            background-position: center center;
            /* Centers the background image */
            background-repeat: no-repeat;
            /* Prevents the image from repeating */
            background-attachment: fixed;
            /* Keeps the background fixed when scrolling */
        }

        .left-column img {
            width: 100px;
            height: 100px;
        }

        .container_account {
            display: flex;
            align-items: center;
            margin-top: 50px;
            margin-left: 270px;
        }

        .left-column {
            width: 300px;
            /* Điều chỉnh độ rộng theo ý muốn */
            height: 350px;
            /* Điều chỉnh độ cao theo ý muốn */
            background-color: #9a901e6c;
            /* Màu nền */
            border-radius: 10px;
            /* Làm tròn góc */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
            /* Thêm bóng */
            padding: 10px;
            text-align: left;
            margin-right: 15px;
        }

        .center {
            text-align: center;
            margin-bottom: 30px;
        }

        .right-column {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .icon-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .icon-container img {
            width: auto;
            height: 30px;
            margin-bottom: 15px;
        }

        .left-column p {
            style="font-family: 'true typewriter';"
        }
    </style>
@endsection
