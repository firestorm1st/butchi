@extends('admin.master')

@section('module', 'Mission')
@section('action', 'Edit')

@section('content')
<form method="post" action="{{ route('admin.mission.update') }}">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa nhiệm vụ</h3>

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
                        <label>Tên nhiệm vụ</label>
                        <textarea class="form-control" placeholder="Nhập mô tả nhiệm vụ" name="name" value="{{ old('name') }}"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Ngày áp dụng</label>
                        <input type="text" class="form-control" placeholder="Nhập ngày áp dụng" name="day" value="{{ old('day') }}">
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
