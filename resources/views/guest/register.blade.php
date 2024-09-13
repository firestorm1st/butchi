@extends('master')
@section('content')
{{-- <nav class="breadcrumb-section breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="bread-crumb-title">Register</h2>
                <ol class="breadcrumb bg-transparent m-0 p-0 justify-content-center align-items-center">
                    <li class="breadcrumb-item"><a href="{{route('guest.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                </ol>
            </div>
        </div>
    </div>
</nav> --}}
    <!-- main content start -->
    <div class="login-register-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 mx-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav nav-tabs" id="nav-tab" role="tablist">
                            {{-- <a data-bs-toggle="tab" href="#lg1"> --}}
                                <h2>Đăng ký</h2>
                            {{-- </a> --}}
                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane show active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="" method="POST">
                                            @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                            </div>
                                            @endif
                                            @if ($message = Session::has('success'))
                                            <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                            {{Session::get('success')}}
                                            </div>
                                            @endif
                                            @csrf
                                            <label>Email<span class="required">*</span></label>
                                            <input type="email" name="email" placeholder="email" value="{{old('email')}}">
                                            <label>Mật khẩu<span class="required">*</span></label>
                                            <input type="password" name="password" placeholder="Password">
                                            <label>Xác nhận mật khẩu<span class="required">*</span></label>
                                            <input type="password" class="form-control" placeholder="Enter password" name="password_confirmation">
                                            <label>Username<span class="required">*</span></label>
                                            <input name="username" placeholder="user_name" value="{{old('username')}}">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <a href="{{route('showLogin')}}" class="text-center">Tôi đã là thành viên</a>
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
            background-size: cover; /* Ensures the image covers the entire section */
            background-position:center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
        }
        h4{
            margin-top: 50px;
        }
    </style>
    <!-- main content end -->
@endsection