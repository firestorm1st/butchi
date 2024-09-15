@extends('master')
@section('content')
    <div class="login-register-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 mx-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="active" data-bs-toggle="tab">
                                <h4>Lấy lại mật khẩu</h4>
                            </a>
                        </div>

                        <div class="tab-content">
                            <div id="lg1" class="tab-pane show active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('reset.password.post') }}" method="POST">
                                            @if ($errors->any())
                                                <div class="alert alert-danger alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">×</button>
                                                    <h5><i class="icon fas fa-ban"></i> Cảnh báo!</h5>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                    @if ($message = Session::has('error'))
                                                        <div class="alert alert-error alert-dismissible">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                aria-hidden="true">×</button>
                                                            <h5><i class="icon fas fa-check"></i> Cảnh báo!</h5>
                                                            {{ Session::get('error') }}
                                                        </div>
                                                    @endif
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
                                            <input type="text" hidden value="{{ $token }}" name="token">
                                            <input type="text" disabled value="{{ $email }}" name="email">
                                            <label>Mật khẩu mới<span class="required">*</span></label>
                                            <input type="password" name="password" placeholder="Enter New Password">
                                            <label>Xác nhận<span class="required">*</span></label>
                                            <input type="password" class="form-control" placeholder="Confirm New password"
                                                name="password_confirmation">
                                            <div class="button-box">
                                                <button type="submit" class="btn btn-dark">
                                                    <span>Tạo lại</span>
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
        body {
            background-image: url("{{ asset('client/image/bg.png') }}");
            /* Path to your image */
            background-size: cover;
            /* Makes sure the background image covers the whole page */
            background-position: center center;
            /* Centers the background image */
            background-repeat: no-repeat;
            /* Prevents the image from repeating */
            background-attachment: fixed;
            /* Keeps the background fixed when scrolling */
        }
    </style>
    <!-- main content end -->
@endsection
