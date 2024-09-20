@extends('master')
@section('title','Dach sách')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách thành viên</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <form action="{{ route('client.logoutRoom') }}" method="POST" onsubmit="return confirmLogout()">
            @csrf
            <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Tên người dùng</th>
                        <th style="width: 150px; " >Hình đại diện</th>
                        <th>Tài khoản</th>
                        <th>Nhiệm vụ</th>
                        <th>Trang cá nhân</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $users = App\Models\User::where('room_id', $id)->get();
                        
                    @endphp

                    @foreach ($users as $user)
                        <tr >
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
                                <span>
                                    {{ $user->role == 1 ? 'Học sinh' : ($user->role == 2 ? 'Phụ huynh' : 'Admin') }}
                                </span>
                            </td>
                            <td>
                                <span>
                                    {{ $user->is_offline == 1 ? 'Trực tiếp' : 'Trực tuyến' }}
                                </span>
                            </td>
                            <td><a href="{{ route('client.showAccount', ['id' => $user->id]) }}">Cảm xúc</a></td>
                        </tr>
                    @endforeach

                </tbody>
   
            </table>
        </div>
    </div>
    <style>
        body {
            background-color: #fffaed;
        }

        .card{
            
            border: none;
            background-color: #fffaed;
            color: black;
        }
        
        .card-header {
            font-family: 'true typewriter';
            width: 100%;
            background-color: #fffaed;
            border: none;
        }

        tr{
            font-family: 'true typewriter';
            font-size: 20px;
            text-align: center;
        }

        a{
            color:blue;
        }
 
    </style>
    <script>
        function confirmLogout() {
            return confirm('Bạn có chắc chắn muốn đăng xuất khỏi phòng này không?');
        }
    </script>
@endsection
