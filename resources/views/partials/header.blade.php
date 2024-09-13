<header>
    <nav>
        <div class="logo">
            <img src="{{asset('client/image/logo.png')}}" style="width:60px;height:60px;margin-left: 30px;">
            <div class="h6"><p><b>Bút chì thấu cảm</b></p></div>
        </div>
        <ul class="navbar">
            <li><a href="{{route('guest.index')}}">Trang chủ</a></li>
            <li><a href="#">Hoạt động</a></li>
            <li><a href="{{route('guest.aboutUs')}}">Giới thiệu</a></li>
            <li><a href="#">Liên hệ</a></li>
            <li>
            <p class="p_navbar">
            @php
                if(Auth::check()==true)
                {
                    echo Auth::user()->username;
                }else {
                    echo 'Guest';
                }
            @endphp 
            </p>
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
        <button class="start-btn">Bắt đầu</button>
    </nav>
</header>

<style>
    header {
        background: transparent; /* Ensures header is transparent so background is visible */
        font-family: 'true typewriter';
    }

    .logo h6{
        margin-right: auto;
        font-size: 18px;
    }

    nav {
        display: flex;
        align-items: center; /* Ensure both logo and navbar items are vertically centered */
        justify-content: space-between; /* Space between the logo and the navbar */
        padding: 10px 20px;
    }

    .navbar {
        list-style: none;
        display: flex;
        gap: 20px; /* Space between links */
        margin-left: auto; /* Pushes the nav links to the far right */
    }

    .navbar li {
        margin: 0;
    }

    .navbar a {
        text-decoration: none;
        color: #000;
        font-size: 18px;
    }

    .p_navbar{
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