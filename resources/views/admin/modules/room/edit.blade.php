@extends('admin.master')

@section('module', 'Phòng')
@section('action', 'Chỉnh sửa')

@section('content')
    <form method="post" action="{{ route('admin.room.update', ['id' => $room->id]) }}">
        @csrf
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chỉnh sửa phòng</h3>

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
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Người tạo phòng</label>
                            <input class="form-control"
                                value="{{ old('email', $email) }}" readonly>
                               
                        </div>
                        <div class="form-group">
                            <label>Tên phòng</label>
                            <textarea class="form-control" name="name">{{ old('name', $room->name) }}</textarea>
                        </div>


                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
                        </div>

                        <div class="form-group">
                            <label>Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu"
                                name="password_confirmation">
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
