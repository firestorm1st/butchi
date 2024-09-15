@extends('master')
@section('content')

    <form method="post" action="{{ route('client.account', ['id' => $id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="container_account">
                <div class="left-column">
                    <label>Tên người dùng</label>
                    <br />
                    <label>Nhập mật khẩu mới</label>
                    <br />
                    <label>Xác nhận mật khẩu</label>
                    <br />
                    <label>Tài khoản này là: </label>
                    <br />
                    <label>Avatar</label>
                </div>

                <div class="right-column">
                    <input type="text" class="custom-input" placeholder="Nhập tên người dùng" name="username"
                        value="{{ old('username', $user->username) }}">

                    <input type="password" class="custom-input" placeholder="Nhập mật khẩu" name="password">

                    <input style="font-family: 'true typewriter'" type="password" class="custom-input"
                        placeholder="Nhập lại mật khẩu" name="password_confirmation">

                    @if (Auth::check())
                        <select style="font-family: 'true typewriter'" class="custom-input" name="role">
                            <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Học sinh</option>
                            <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>Phụ huynh</option>

                            <!-- Nếu là admin, thêm tùy chọn admin -->
                            @if (Auth::user()->role == 3)
                                <option value="3" {{ old('role', $user->role) == 3 ? 'selected' : '' }}>Admin</option>
                            @endif
                        </select>
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input custom-input" id="customImage"
                            value="{{ old('avatar') }}" name="avatar" accept="image/jpg,image/png,image/bmp,image/jpeg" />
                        @if ($user->avatar)
                            <img src="{{ asset('uploads/' . $user->avatar) }}" alt="Hình đại diện người dùng" width='100px'
                                height='100px'>
                        @else
                            <img src="{{ asset('client/image/avatar.png') }}" alt="Avatar" width='100px' height='100px'>
                        @endif
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary button" style="font-family: 'true typewriter';">Cập nhật thông
                tin</button>
        </div>
    </form>


    <style>
        body {
            background-image: url("{{ asset('client/image/bg.png') }}");
            /* Path to your image */
            background-size: 1765px;
            /* Ensures the image covers the entire section */
            background-position: center;
            /* Center the image */
            background-repeat: no-repeat;
        }

        .left-column img {
            width: 100px;
            height: 100px;
        }

        .container_account {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            /* align-items: center; */
            margin: 50px auto;
            width: 70%;

        }

        .container{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* align-items: center; */
            margin: 50px auto;
            width: 100%;

        }

        .button{
            width: 30%;
            margin: auto;
        }

        .left-column {
            width: 40%;

            /* Điều chỉnh độ rộng theo ý muốn */

            /* Điều chỉnh độ cao theo ý muốn */

            /* Màu nền */
            border-radius: 10px;
            /* Làm tròn góc */
            /* box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3); */
            /* Thêm bóng */
            padding: 10px 0 10px 100px;
            text-align: left;
            margin-right: 15px;
        }

        label {
            width: 100%;
            /* Đảm bảo input chiếm toàn bộ chiều ngang của form group */
            height: 40px;
            /* Đặt chiều cao nhất quán */
            font-family: 'Dancing Script';
            /* Font cho các input */
            font-size: 20px;
            /* Đặt kích thước chữ */
            padding: 10px;
            margin-top: 10px;
            /* Khoảng cách bên trong */
            box-sizing: border-box;
            /* Đảm bảo padding không thay đổi kích thước tổng thể */
        }

       

        .custom-input {
            width: 100%;
            /* Đảm bảo input chiếm toàn bộ chiều ngang của form group */
            height: 40px;
            /* Đặt chiều cao nhất quán */
            font-family: 'true typewriter';
            /* Font cho các input */
            font-size: 16px;
            /* Đặt kích thước chữ */
            padding: 10px;
            margin-top: 12px;
            /* Khoảng cách bên trong */
            box-sizing: border-box;
            border-radius: 10px;
            /* Đảm bảo padding không thay đổi kích thước tổng thể */
        }

        .center {
            text-align: center;
            margin-bottom: 30px;
        }

        .right-column {
            width: 60%;
            /* Điều chỉnh độ rộng theo ý muốn */

            /* Điều chỉnh độ cao theo ý muốn */
            border: none;
            /* Màu nền */

            /* Làm tròn góc */
            /* box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3); */
            /* Thêm bóng */
            padding: 10px;
            text-align: right;
            margin-right: 15px;
        }

        .icon-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .icon-container img {
            width: auto;
            height: 30px;
            margin-bottom: 15px;
        }

        .left-column p {
            style="font-family: 'true typewriter';"
        }
    </style>
@endsection
