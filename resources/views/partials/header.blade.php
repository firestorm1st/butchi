<header>
    <div class="logo">
        <img src="{{asset('client/image/logo.png')}}" style="width:60px;height:60px;margin-left: 30px;">
        <div class="h3"><p><b>Bút chì thấu cảm</b></p></div>
    </div>
    <nav>
        <ul>
            <li><a href="{{route('guest.index')}}">Trang chủ</a></li>
            <li><a href="#">Hoạt động</a></li>
            <li><a href="{{route('guest.introduce')}}">Giới thiệu</a></li>
            <li><a href="#">Liên hệ</a></li>
            <li>
            <a>
            @php
                if(Auth::check()==true)
                {
                    echo Auth::user()->username;
                }else {
                    echo 'Guest';
                }
            @endphp 
            </a>
            </li>
            @if(Auth::check())
            @if (Auth::user()->role==3)
                <li><a href="{{route('admin.modules.contact.index')}}">Admin</a></li>
            @endif
                {{-- <li><a href="{{route('client.account',['id'=>Auth::user()->id])}}">My account</a></li> --}}
                <li><a href="{{route('logout')}}">Log out</a></li>
            @else
                <li><a href="{{route('showLogin')}}">Log in</a></li>
                <li><a href="{{route('showRegister')}}">Register</a></li>
            @endif
        </ul>
    </nav>
    <button class="start-btn">Bắt đầu</button>
</header>

<style>
    header {
        background: transparent; /* Ensures header is transparent so background is visible */
        display: flex;
        align-items: center;
        padding: 0px 10px;
        font-family: 'true typewriter';
    }

    .logo h3{
        margin-left: 10px;
        font-size: 20px;
        margin-right: 0px;
    }

    nav {
        margin-left: 725px;
    }

    nav ul {
        list-style: none;
        display: flex;
        gap: 20px;
    }

    nav a {
        text-decoration: none;
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