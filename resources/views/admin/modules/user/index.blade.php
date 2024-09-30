@extends('admin.master')

@section('module', 'Người dùng')
@section('action', 'Danh sách')

@push('css')
    <link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('administrator/plugins/datatables-responsive/css/responsive.bootstrap4.min.css ') }}">
    <link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-buttons/css/buttons.bootstrap4.min.css ') }}">
@endpush

@push('js')
    <script src="{{ asset('administrator/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endpush

@push('hanldejs')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        function confirmDelete() {
            return confirm('Bạn có chắc muốn xóa mục này không?');
        }
    </script>
@endpush
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách người dùng</h3>

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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Tên người dùng</th>
                        <th style="width: 50px; height: 50px;">Hình đại diện</th>
                        <th>Tài khoản</th>
                        <th>Nhiệm vụ</th>
                        <th>Ngày tạo</th>
                        <th>Trang cá nhân</th>
                        <th>Phòng</th>
                        <th>Chỉnh sửa</th>
                        <!--<th>Xóa</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>

                            <td>
                                @if ($user->avatar)
                                    <img src="{{ asset('uploads/' . $user->avatar) }}" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('client/image/logo.png') }}" style="width: 50px; height: 50px;">
                                @endif
                            </td>

                            <td>
                                <span
                                    class="right badge badge-{{ $user->role == 1 ? 'success' : ($user->role == 2 ? 'info' : 'primary') }}">
                                    {{ $user->role == 1 ? 'Học sinh' : ($user->role == 2 ? 'Phụ huynh' : 'Admin') }}
                                </span>
                            </td>

                            <td>
                                <span
                                    class="right badge badge-{{ $user->is_offline == 1 ? 'success' : 'info'}}">
                                    {{ $user->is_offline == 1 ? 'Trực tiếp' : 'Trực tuyến'}}
                                </span>
                            </td>

                            <td>{{ $user->created_at }}</td>
                            <td><a href="{{ route('client.showAccount', ['id' => $user->id]) }}">Xem</a></td>
                            <td>
    @php
        $room = App\Models\Room::where('id', $user->room_id)->first();
    @endphp
    {{ $room ? $room->name : 'Chưa có phòng' }}
</td>

                            
                            <td><a href="{{ route('admin.user.edit', ['id' => $user->id]) }}">Chỉnh sửa</a></td>
                            <!--<td><a onclick="return confirmDelete ()"-->
                            <!--        href="{{ route('admin.user.destroy', ['id' => $user->id]) }}">Xóa</a></td>-->
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Tên người dùng</th>
                        <th style="width: 50px; height: 50px;">Hình đại diện</th>
                        <th>Tài khoản</th>
                        <th>Nhiệm vụ</th>
                        <th>Ngày tạo</th>
                        <th>Trang cá nhân</th>
                        <th>Phòng</th>
                        <th>Chỉnh sửa</th>
                        <!--<th>Xóa</th>-->
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card -->


@endsection
