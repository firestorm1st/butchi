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
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="icon fas fa-ban"></i> Cảnh báo!</h5>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
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
                                            <label style="color: red">Email<span class="required">*</span></label>
                                            <input class="input" type="email" name="email" placeholder="email" value="{{old('email')}}">
                                            <label style="color: red">Mật khẩu<span class="required">*</span></label>
                                            <input class="input" type="password" name="password" placeholder="Password">
                                            <label style="color: red">Xác nhận mật khẩu<span class="required">*</span></label>
                                            <input class="input" type="password" class="form-control" placeholder="Enter password" name="password_confirmation">
                                            <label style="color: red">Username<span class="required">*</span></label>
                                            <input class="input" name="username" placeholder="user_name" value="{{old('username')}}">
                                            <div class="checkbox-class">
                                                <input type="checkbox" id="is_online" name="is_online" value="1" {{ old('is_online') == '1' ? 'checked' : '' }}>
                                                <label for="is_online">Trực tiếp</label>
                                            </div>
                        
                                            <!-- Thêm radio button cho role -->
                                            <label style="color: red">Vai trò<span class="required">*</span></label>
                                            <div class="role-selection">
                                                <label for="student">Học sinh</label>
                                                <input class="radio" type="radio" id="student" name="role" value="1" {{ old('role') == '1' ? 'checked' : '' }}>
                                                <label for="parent">Phụ huynh</label>
                                                <input class="radio" type="radio" id="parent" name="role" value="2" {{ old('role') == '2' ? 'checked' : '' }}>
                                            </div>
                        
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
        
    .radio {
        transform: scale(1.5);
        margin-right: 5px;
    }

    /* Đặt Học sinh và Phụ huynh ngang hàng */
    .role-selection {
        display: flex;
        align-items: center;
        gap: 20px; /* Khoảng cách giữa các radio button và label */
    }

    /* Căn chỉnh label ngang với radio */
    .role-selection div {
        display: flex;
        align-items: center;
    }

    /* Tinh chỉnh thêm khoảng cách và căn giữa text với radio button */
    .role-selection label {
        margin: 0;
        display: flex;
        font-size: 20px;
    }

    body{
        background-color: #fffaed;
    }
    </style>
    <!-- main content end -->
@endsection