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
                                            @csrf
                                            <input type="hidden" value="{{ $token }}" name="token">
                                            <input type="text" disabled value="{{ $email }}" name="email">
                                            </br>
                                            <label>Mật khẩu mới<span class="required">*</span></label>
                                            <input class="input" type="password" name="password" placeholder="Enter New Password">
                                            <label>Xác nhận<span class="required">*</span></label>
                                            <input class="input" type="password" class="form-control" placeholder="Confirm New password"
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
        body{
            background-color: #fffaed;
        }
    </style>
    <!-- main content end -->
@endsection
