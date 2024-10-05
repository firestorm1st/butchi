@extends('master')
@section('title','Cảm xúc')
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
            <!-- Combo box chọn user -->
            <form action="{{ route('client.filterByUser', ['id' => $roomid]) }}" method="GET" class="form-inline">
                <div class="form-group mb-2">
                    <label for="user_id" class="mr-2">Chọn người dùng</label>
                    <select name="user_id" id="user_id" class="form-control custom-select">
                        <option value="" style="font-family: 'true typewriter';">-- Chọn người dùng --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" 
                                {{ request('user_id') == $user->id ? 'selected' : '' }} 
                                style="font-family: 'true typewriter';">
                                {{ $user->username }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary custom-button ml-2 mb-2">Lọc</button>
            </form>

            <!-- Bảng danh sách cảm xúc -->
            <table id="example1" class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên người dùng</th>
                        <th>Cảm xúc</th>
                        <th>Mức độ</th>
                        <th>chia sẻ cảm xúc/tâm tư</th>
                        <th>Ngày chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emotions as $emotionDaily)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $emotionDaily->user->username }}</td>
                            <td>{{ $emotionDaily->emotion->name }}</td>
                            <td>{{ $emotionDaily->level->name }}</td>
                            <td>{{ $emotionDaily->answer }}</td>
                            <td>{{ $emotionDaily->date }}</td>
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

        /* Căn chỉnh form-inline */
        .form-inline .form-group {
            display: inline-block;
            margin-right: 10px;
        }

        /* Tùy chỉnh combobox */
        .custom-select {
            width: 250px;
            padding: 6px;
        }

        /* Tùy chỉnh nút lọc */
        .custom-button {
            margin-top: 20px;
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            font-size: 14px;
            padding: 10px 15px;
            border-radius: 15px;
            transition: background-color 0.3s ease;
        }

        .custom-button:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        /* Căn chỉnh form-inline nằm ngang */
        .form-inline {
            display: flex;
            align-items: center;
        }
    </style>
@endsection
