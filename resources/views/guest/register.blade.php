@extends('master')
@section('content')
    <!-- main content start -->
    <div class="login-register-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 mx-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav nav-tabs" id="nav-tab" role="tablist">
                            <a>
                                <h4 style="color: red">Đăng ký</h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane show active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="" method="POST">
                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">×</button>
                                                    <h5><i class="icon fas fa-ban"></i> Cảnh báo!</h5>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </div>
                                            @endif
                                            @if ($message = Session::has('success'))
                                                <div class="alert alert-success alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">×</button>
                                                    <h5><i class="icon fas fa-check"></i> Chúc mừng!</h5>
                                                    {{ Session::get('success') }}
                                                </div>
                                            @endif
                                            @csrf
                                            <label style="color: red">Email<span class="required">*</span></label>
                                            <input style="border: 1px solid #000;" type="email" name="email" placeholder="email" value="{{old('email')}}">
                                            <label style="color: red">Mật khẩu<span class="required">*</span></label>
                                            <input style="border: 1px solid #000;" type="password" name="password" placeholder="Password">
                                            <label style="color: red">Xác nhận mật khẩu<span class="required">*</span></label>
                                            <input style="border: 1px solid #000;" type="password" class="form-control" placeholder="Enter password" name="password_confirmation">
                                            <label style="color: red">Username<span class="required">*</span></label>
                                            <input style="border: 1px solid #000;" name="username" placeholder="user_name" value="{{old('username')}}">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <a href="{{ route('showLogin') }}" class="text-center">Tôi đã là thành
                                                        viên</a>
                                                </div>
                                                <button type="submit" class="btn btn-dark">
                                                    <span>Đăng ký</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        body{
            background-image: url("{{ asset('client/image/bg.png') }}"); /* Path to your image */
            background-size: cover;  /* Makes sure the background image covers the whole page */
    background-position: center center; /* Centers the background image */
    background-repeat: no-repeat; /* Prevents the image from repeating */
    background-attachment: fixed; /* Keeps the background fixed when scrolling */
        }
    </style>
    <!-- main content end -->
@endsection
