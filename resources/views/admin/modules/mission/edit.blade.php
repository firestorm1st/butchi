@extends('admin.master')

@section('module', 'Nhiệm vụ')
@section('action', 'Chỉnh sửa')

@section('content')
    <form method="post" action="{{ route('admin.mission.update', ['id' => $id]) }}">
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
                            <textarea class="form-control" placeholder="Nhập mô tả nhiệm vụ" name="name">{{ old('name', $mission->name) }}</textarea>
                        </div>


                        <div class="form-group">
                            <label>Ngày áp dụng</label>
                            <input type="date" class="form-control" placeholder="Nhập ngày áp dụng" name="day"
                                value="{{ old('day', $mission->day) }}">
                        </div>
                        <div class="form-group">
                            <label>Nhiệm vụ: </label>
                            <select class="form-control" name="is_offline">
                                <option value="1" {{ old('is_offline', $mission->is_offline) == 1 ? 'selected' : '' }}>Trực tiếp</option>
                                <option value="2" {{ old('is_offline', $mission->is_offline) == 2 ? 'selected' : '' }}>Trực tuyến</option>
                            </select>
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
