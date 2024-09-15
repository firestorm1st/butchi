@extends('master')
@section('content')
    <main>
        <section class="content">
            <div class="welcome-text">
                <h2>Chào mừng bạn đến với<br> "Bút Chì Thấu Cảm"</h2>
                <p>Chỉ vẽ hạnh phúc - Dẫn lối yêu thương</p>
                <button class="start-btn">Bắt đầu ></button>
                <a class="link" href="{{ route('guest.aboutUs') }}">Hướng dẫn</a>
            </div>
            <div class="welcome-image">
                <img src="{{asset('client/image/trang.jpg')}}" alt="Bút Chì Thấu Cảm Image">
            </div>
        </section>
    </main>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url("{{ asset('client/image/bg.png') }}"); /* Path to your image */
            background-size: cover;  /* Makes sure the background image covers the whole page */
            background-position: center center; /* Centers the background image */
            background-repeat: no-repeat; /* Prevents the image from repeating */   
            background-attachment: fixed; /* Keeps the background fixed when scrolling */
        }

        .logo h3{
            margin-left: 10px;
            font-size: 20px;
        }

        .start-btn {
            margin-left: 10px;
            padding: 10px 20px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
        }

        .link{
            font-family: 'true typewriter';
            margin-left: 40px;
            font-weight: bold;
            text-decoration: none;
            font-size: 20px;
        }

        main {
            display: flex;
            align-items: center;
        }

        .content {
            margin: 30px auto;
            display:flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .welcome-text h2 {
            font-size: 40px;
            font-weight: bold;
            line-height: 1.2;
            font-family:'Dancing Script';
        }

        .welcome-text p {
            margin: 10px 0;
            font-size: 18px;
            font-family: 'true typewriter';
        }

        .welcome-text .start-btn {
            margin-top: 10px;
            font-family: 'true typewriter';
        }

        .welcome-image img {
            max-width: 400px;
            border-radius: 20px;
        }
    </style>
@endsection