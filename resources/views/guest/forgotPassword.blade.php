@extends('master')
@section('content')
{{-- <nav class="breadcrumb-section breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="bread-crumb-title">Quên mật khẩu</h2>
                <ol class="breadcrumb bg-transparent m-0 p-0 justify-content-center align-items-center">
                    <li class="breadcrumb-item"><a href="{{route('guest.index')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quên mật khẩu</li>
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
                            {{-- <a class="active" data-bs-toggle="tab"> --}}
                                <h4>Thiết lập lại mật khẩu</h4>
                            {{-- </a> --}}
                        </div>

                        <div class="tab-content">
                            <div id="lg1" class="tab-pane show active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <p>Chúng tôi sẽ gửi link kích hoạt lại mật khẩu vào email của bạn, bạn hãy sử dụng link này để thiết lập lại mật khẩu mới</p>
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
                                            <h5><i class="icon fas fa-check"></i> Thông báo!</h5>
                                            {{Session::get('success')}}
                                        </div>
                                        @endif
                                            @csrf
                                            <label>Nhập Email<span class="required">*</span></label>
                                            <input type="email" name="email" placeholder="email" value="{{old('email')}}">
                                            <div class="button-box">
                                            <button type="submit" class="btn btn-dark">
                                                    <span>Gửi thông tin</span>
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