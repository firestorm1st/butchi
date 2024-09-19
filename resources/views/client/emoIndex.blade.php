@extends('master')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách bảng cảm xúc</h3>

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
                        <th>Id</th>
                        <th>Tên phòng</th>
                        <th>Tên người dùng</th>
                        <th>Cảm xúc</th>
                        <th>Mức độ</th>
                        <th>Lý do chọn cảm xúc</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emotions as $emotionDaily)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rooms->name }}</td>
                            <td>{{ $emotionDaily->user->username }}</td>
                            <td>{{ $emotionDaily->emotion->name }}</td>
                            <td>{{ $emotionDaily->level->name }}</td>
                            <td>{{ $emotionDaily->answer }}</td>
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

        .card {
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

        tr {
            font-family: 'true typewriter';
            font-size: 20px;
            text-align: center;
        }

        a {
            color: blue;
        }
    </style>
@endsection
