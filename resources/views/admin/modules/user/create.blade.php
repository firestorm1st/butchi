@extends('admin.master')

@section('module', 'User')
@section('action', 'Create')

@section('content')
<form method="post" action="{{ route('admin.user.store') }}">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User create</h3>

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
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="Enter email" name="email">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" placeholder="Enter password" name="password">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Show</option>
                            <option value="2">Hidden</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="text" class="form-control" placeholder="Enter password" name="confirmation_password">
                    </div>

                    <div class="form-group">
                        <label>Level</label>
                        <select class="form-control" name="level">
                            <option value="1">Admin</option>
                            <option value="2">Member</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Fullname</label>
                <input type="text" class="form-control" placeholder="Enter fullname" name="full_name">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" placeholder="Enter phone" name="phone">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
    <!-- /.card -->
</form>
@endsection
