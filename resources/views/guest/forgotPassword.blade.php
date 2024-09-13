@extends('master')
@section('content')
<nav class="breadcrumb-section breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="bread-crumb-title">Forgot Password</h2>
                <ol class="breadcrumb bg-transparent m-0 p-0 justify-content-center align-items-center">
                    <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
    <!-- main content start -->
    <div class="login-register-area section-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 mx-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="active" data-bs-toggle="tab">
                                <h4>Reset Password</h4>
                            </a>
                        </div>

                        <div class="tab-content">
                            <div id="lg1" class="tab-pane show active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <p>We will send a link to your email, use that link to reset your password</p>
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
                                            @if ($message = Session::has('error'))
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                                {{Session::get('error')}}
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
                                            <label>Enter Email<span class="required">*</span></label>
                                            <input type="email" name="email" placeholder="email" value="{{old('email')}}">
                                            <div class="button-box">
                                            <button type="submit" class="btn btn-dark">
                                                    <span>submit</span>
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

    <!-- main content end -->
@endsection