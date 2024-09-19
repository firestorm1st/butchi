<header>
    <nav>
        <a href="{{ route('guest.index') }}">
            <div class="logo">
                <img src="{{ asset('client/image/logo.png') }}" style="width:80px;height:80px;margin-left:10px;">
                <div class="h6" style="color: black">
                    <p><b>Bút chì thấu cảm</b></p>
                </div>
            </div>
        </a>
        <ul class="navbar">
            @if (Auth::check())
            <li class="main-menu-item">
                <a href="{{route('client.showAccount',['id'=>Auth::user()->id])}}" class="main-menu-link">Tài khoản</a>
                <!-- sub menu start -->
                <ul class="sub-menu">
                    @if (Auth::user()->room_id!=null)
                    <li class="sub-menu-item"><a class="sub-menu-link" href="{{route('client.index',['id'=>Auth::user()->room_id])}}">Xem thành viên</a></li>
                    <li class="sub-menu-item"><a class="sub-menu-link" href="{{route('client.emotion.form',['id'=>Auth::user()->room_id])}}">Chọn cảm xúc</a></li>
                    <li class="sub-menu-item"><a class="sub-menu-link" href="{{route('client.emotion.full',['id'=>Auth::user()->room_id])}}">Xem cảm xúc</a></li>
                    @endif
                </ul>
                <!-- sub menu end -->
            </li>
            @endif
            <li><a href="{{ route('guest.aboutUs') }}">Giới thiệu</a></li>
            <li><a href="{{ route('guest.contactUs') }}">Liên hệ</a></li>
            <li>
                <p class="p_navbar">
                    {{-- @php
                if(Auth::check()==true)
                {
                    <a href="{{ route('admin.index')}}"> echo Auth::user()->username; </a>
                    
                }else {
                    echo 'Guest';
                }
            @endphp  --}}
                    @if (Auth::check())
                        <a href="{{route('client.showAccount',['id'=>Auth::user()->id])}}">{{ Auth::user()->username }}</a>
                    @else
                        Guest
                    @endif
                </p>
            </li>
            @if (Auth::check())
                @if (Auth::user()->role == 3)
                    <li><a href="{{ route('admin.index') }}">Admin</a></li>
                @endif
                {{-- <li><a href="{{route('client.account',['id'=>Auth::user()->id])}}">My account</a></li> --}}
                <li><a href="{{ route('logout') }}">Log out</a></li>
            @else
                <li><a href="{{ route('showLogin') }}">Login</a></li>
                <li><a href="{{ route('showRegister') }}">Đăng ký</a></li>
            @endif
        </ul>
        @auth
            @if(Auth::user()->room_id == null)
                <!-- Điều hướng đến danh sách phòng để chọn -->
                <button class="start-btn"><a href="{{ route('client.rooms.show') }}">Bắt đầu</a></button>
            @else
                <!-- Điều hướng đến trang client.index -->
                <button class="start-btn"><a href="{{ route('client.emotion.form',['id' => Auth::User()->room_id]) }}">Bắt đầu</a></button>
            @endif
        @endauth
        @guest
            <button class="start-btn"><a href="{{ route('showLogin') }}">Bắt đầu</a></button>
        @endguest
    </nav>
</header>

<style>
    header {
        background: transparent;
        /* Ensures header is transparent so background is visible */
        font-family: 'true typewriter';
    }

    .logo h6 {
        margin-right: auto;
        font-size: 20px;
    }

    nav {
        display: flex;
        align-items: center;
        /* Ensure both logo and navbar items are vertically centered */
        justify-content: space-between;
        /* Space between the logo and the navbar */
        padding: 0px 20px;
    }

    .navbar {
        list-style: none;
        display: flex;
        gap: 20px;
        /* Space between links */
        margin-left: auto;
        /* Pushes the nav links to the far right */
    }

    .navbar li {
        margin: 0;
    }

    .navbar a {
        text-decoration: none;
        color: #000;
        font-size: 18px;
    }

    .p_navbar {
        color: #000;
        font-size: 18px;
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
</style>
