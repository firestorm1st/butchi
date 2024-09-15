@extends('master')
@section('content')
    <div class="login-register-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 mx-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav nav-tabs" id="nav-tab" role="tablist">
                                <h4>Đăng nhập</h4>
                            
                        </div>

                        <div class="tab-content">
                            <div id="lg1" class="tab-pane show active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="" method="POST">
                                            @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-ban"></i> Cảnh báo!</h5>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                            </div>
                                            @endif
                                            @if ($message = Session::has('error'))
                                            <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> Cảnh báo!</h5>
                                            {{Session::get('error')}}
                                            </div>
                                            @endif
                                            @if ($message = Session::has('success'))
                                            <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> Chúc mừng!</h5>
                                            {{Session::get('success')}}
                                            </div>
                                            @endif
                                            @csrf
                                            <label>Email<span class="required">*</span></label>
                                            <input type="email" name="email" placeholder="email" value="{{old('email')}}">
                                            <label>Mật khẩu<span class="required">*</span></label>
                                            <input type="password" name="password" placeholder="Password">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <a href="{{route('showRegister')}}">Đăng ký ngay!</a><br>
                                                    <a href="{{route('forget.password')}}">Quên mật khẩu?</a>

                                                    <input id="remember" type="checkbox">
                                                    <label for="remember">Ghi nhớ đăng nhập</label>
                                                </div>
                                                <button type="submit" class="btn btn-dark">
                                                        <span>Đăng nhập</span>
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
            background-size:1600px; /* Ensures the image covers the entire section */
            background-position:center; /* Center the image */
            background-repeat: no-repeat;
        }
    </style>
    <!-- main content end -->
@endsection