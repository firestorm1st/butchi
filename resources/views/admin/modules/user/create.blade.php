@extends('admin.master')

@section('module', 'Người dùng')
@section('action', 'Tạo mới')

@section('content')
<form method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tạo người dùng mới</h3>

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
                        <input type="text" class="form-control" placeholder="Nhập email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="text" class="form-control" placeholder="Nhập mật khẩu" name="password">
                    </div>
                    {{-- <div class="form-group">
                        <label>Avatar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customImage" value="{{ old('avatar') }}" name="avatar" accept="image/jpg,image/png,image/bmp,image/jpeg"/>
                            <label class="custom-file-label" for="customImage">Choose file</label>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label>Avatar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customImage" value="{{ old('image') }}" name="avatar" accept="image/jpg,image/png,image/bmp,image/jpeg"/>
                            <label class="custom-file-label" for="customImage">Choose file</label>
                        </div>
                    </div>
                    
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tên người dùng</label>
                        <input type="text" class="form-control" placeholder="Nhập tên người dùng" name="username" value="{{ old('username') }}">
                    </div>

                    <div class="form-group">
                        <label>Xác nhận mật khẩu</label>
                        <input type="text" class="form-control" placeholder="Nhập mật khẩu" name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <label>Tài khoản này là: </label>
                        <select class="form-control" name="role">
                            <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Học sinh</option>
                            <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Phụ huynh</option>
                            <option value="3" {{ old('role') == 3 ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button onclick="return confirmEmail ()" type="submit" class="btn btn-primary">Tạo mới</button>
        </div>
    </div>
    <!-- /.card -->
</form>

<script>
    function confirmEmail() {
        if (confirm("Please check your email carefully before registering, because your email is the only thing that cannot be edited.")) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection
