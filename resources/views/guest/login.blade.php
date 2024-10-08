@extends('master')
@section('title','Đăng nhập')
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
                                            @csrf
                                            <label>Email<span class="required">*</span></label>
                                            <input class="input" type="email" name="email" placeholder="email" value="{{old('email')}}">
                                            <label>Mật khẩu<span class="required">*</span></label>
                                            <input class="input" type="password" name="password" placeholder="Password">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <a href="{{ route('showRegister') }}">Đăng ký ngay!</a><br>
                                                    <a href="{{ route('forget.password') }}">Quên mật khẩu?</a>

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
        .input{
            width: 100%;
        }
        body{
            background-color: #fffaed;
        }
    </style>
    <!-- main content end -->
@endsection
