@extends('master')
@section('content')
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
                                        <p>Chúng tôi sẽ gửi link kích hoạt lại mật khẩu vào email của bạn, bạn hãy sử dụng
                                            link này để thiết lập lại mật khẩu mới</p>
                                        <form action="" method="POST">
                                            @if ($message = Session::has('success'))
                                                <div class="alert alert-success alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">×</button>
                                                    <h5><i class="icon fas fa-check"></i> Thông báo!</h5>
                                                    {{ Session::get('success') }}
                                                </div>
                                            @endif
                                            @csrf
                                            <label style="font-family: 'Dancing Script'">Nhập Email<span class="required">*</span></label>
                                            <input class="input" type="email" name="email" placeholder="email"
                                                value="{{ old('email') }}">
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
            background-color: #fffaed;
        }
    </style>
    <!-- main content end -->
@endsection
