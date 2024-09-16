@extends('admin.master')

@section('module', 'Người dùng')
@section('action', 'Chỉnh sửa')

@section('content')
    <form method="post" action="{{ route('admin.user.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
        @csrf
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa thông tin người dùng</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email"
                                value="{{ old('email', $user->email) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
                        </div>

                        <div class="form-group">
                            <label>Tài khoản này là: </label>
                            <select class="form-control" name="role">
                                <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Học sinh
                                </option>
                                <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Phụ huynh
                                </option>
                                <option value="3" {{ old('role', $user->role) == 3 ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Làm nhiệm vụ:</label>
                            <select class="form-control" name="is_offline">
                                <option value="1" {{ old('is_offline', $user->is_offline) == 1 ? 'selected' : '' }}>Trực tiếp</option>
                                <option value="2" {{ old('is_offline', $user->is_offline) == 2 ? 'selected' : '' }}>Trực tuyến</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tên người dùng</label>
                            <input type="text" class="form-control" placeholder="Nhập tên người dùng" name="username"
                                value="{{ old('username', $user->username) }}">
                        </div>

                        <div class="form-group">
                            <label>Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu"
                                name="password_confirmation">
                        </div>

                        <div class="form-group">
                            <label>Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customImage" value="{{ old('avatar') }}"
                                    name="avatar" accept="image/jpg,image/png,image/bmp,image/jpeg" />
                                <label class="custom-file-label" for="customImage">Choose file</label>
                            </div>
                            @if ($user->avatar)
                                <img src="{{ asset('uploads/' . $user->avatar) }}" alt="Hình đại diện" width='200px'
                                    height='200px'>
                            @endif
                        </div>

                    </div>


                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
            </div>
        </div>
        <!-- /.card -->
    </form>
@endsection
