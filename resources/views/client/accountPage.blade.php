@extends('master')
@section('content')
    <div class="container_account">
        <div class="left-column">
            <div class="center">
                <h2 style="font-family:'Dancing Script'; font-size: 36px;">Thư Đình</h2>
                <img src="{{asset('client/image/avatar.png')}}" alt="Avatar">
                <p style="font-family: 'true typewriter';">Thay đổi hình đại diện</p>
            </div>
            <p>Giao diện: Học sinh</p>
            <p>Mật khẩu: matkhauabcd</p>
            <a style="font-family: 'true typewriter';" href="#">Đổi mật khẩu</a>
        </div>
        <div class="right-column">
            <div class="icon-container">
                <img src="{{asset('client/image/giandu.png')}}" alt="Avatar">
                <img src="{{asset('client/image/mongdoi.png')}}" alt="Avatar">
                <img src="{{asset('client/image/vuive.png')}}" alt="Avatar">
                <img src="{{asset('client/image/tintuong.png')}}" alt="Avatar">
                <img src="{{asset('client/image/sohai.png')}}" alt="Avatar">
                <img src="{{asset('client/image/batngo.png')}}" alt="Avatar">
                <img src="{{asset('client/image/buonba.png')}}" alt="Avatar">
                <img src="{{asset('client/image/changhet.png')}}" alt="Avatar">
            </div>
        </div>
    </div> 
    <style>
    body {
        background-image: url("{{ asset('client/image/bg.png') }}"); /* Path to your image */
        background-size:1765px; /* Ensures the image covers the entire section */
        background-position:center; /* Center the image */
        background-repeat: no-repeat;
    }

    .left-column img{
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
        width: 300px; /* Điều chỉnh độ rộng theo ý muốn */
        height: 350px; /* Điều chỉnh độ cao theo ý muốn */
        background-color: #9a901e6c; /* Màu nền */
        border-radius: 10px; /* Làm tròn góc */
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3); /* Thêm bóng */
        padding: 10px;
        text-align: left;
        margin-right: 15px;
    }

    .center{
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
    .left-column p{
        style="font-family: 'true typewriter';"
    }
    </style>
@endsection