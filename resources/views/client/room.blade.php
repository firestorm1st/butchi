@extends('master')
@section('title','Phòng')
@section('content')
    <h1>CHỌN PHÒNG</h1>
    @if(Auth::User()->role==2)
    <div class="create-room">
        <button class="create-room-btn" onclick="openModalcreate()">TẠO PHÒNG +</button>
    </div>
    @endif
    <div class="rooms-container">
        @if ($rooms->isEmpty())
        <p style="font-size: 45px;font-family: 'Dancing Script';margin-left:475px;margin-top:150px;">Hiện tại chưa có phòng nào cả</p>
        @else
            @foreach($rooms as $room)
                    <div class="room">
                        <div class="room-image">
                            <img src="{{ asset('client/image/phong.png') }}" alt="Room {{ $room->name }}">
                            <div class="room-info">{{ $room->name }}</div>
                        </div>
                        <button class="enter-btn" onclick="openModal({{ $room->id }})">Vào</button>
                    </div>
                @endforeach
        @endif
    </div>

    {{-- Modal nhập mật khẩu --}}
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Nhập mật khẩu</h2>
            <form action="{{ route('client.rooms.enter') }}" method="POST" id="enterRoomForm">
                @csrf
                <input type="hidden" id="roomId" name="room_id">
                <input type="password" name="password" placeholder="Nhập mật khẩu..." required>
                <div>
                    <button class="submit-btn" type="submit">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal tạo phòng --}}
    <div id="passwordModalcreate" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalcreate()">&times;</span>
            <h2>Nhập tên phòng</h2>
            <form action="{{ route('client.rooms.store') }}" method="POST" id="createRoomForm">
                @csrf
                <input type="text" id="roomName" name="name" placeholder="Nhập tên phòng..." required>
                <h2>Nhập mật khẩu</h2>
                <input type="password" id="roomPassword" name="password" placeholder="Nhập mật khẩu..." required>
                <input type="password" id="roomPasswordConfirm" name="password_confirmation" placeholder="Xác nhận mật khẩu..." required>
                <div>
                    <button type="submit" class="submit-btn">Xác nhận</button>
                </div>
            </form>
            <div id="createRoomError" style="color: red; display: none;"></div>
        </div>
    </div>

    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: #fffaed;
        }

        .room-selection-container {
            padding: 50px;
        }

        h1 {
            font-family: 'Dancing Script';
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .rooms-container {
            font-family: 'true typewriter';
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            padding: 20px;
        }

        .room {
            position: relative;
            width: calc(20% - 30px);
            margin-bottom: 40px;
            text-align: center;
        }

        .room-image {
            position: relative;
        }

        .room img {
            width: 200px;
            height: 200px;
            height: auto;
        }

        .room-info {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .enter-btn {
            margin-bottom: 20px;
            background-color: #000;
            color: #fff;
            border: none;
            padding: 5px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .enter-btn:hover {
            background-color: #444;
        }

        .create-room {
            margin-top: 20px;
        }

        .create-room-btn {
            background-color: #000;
            color: white;
            padding: 10px 20px;
            margin-left: 1300px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
        }

        .create-room-btn:hover {
            background-color: #27ae60;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            font-family: 'true typewriter';
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .close {
            color: #aaa;
            display: flex;
            margin-left: 240px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .submit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #008CBA;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 8px;
        }

        .submit-btn:hover {
            background-color: #005f73;
        }

        input {
            width: auto;
            height: auto;
            margin-bottom: 10px;
        }
    </style>

    <script>
        function openModal(roomId) {
            document.getElementById('passwordModal').style.display = 'flex';
            document.getElementById('roomId').value = roomId;
            console.log(roomId);
            
        }

        function closeModal() {
            document.getElementById('passwordModal').style.display = 'none';
        }   

        window.onclick = function(event) {
            let modal = document.getElementById("passwordModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function openModalcreate() {
            document.getElementById("passwordModalcreate").style.display = "flex";
        }

        function closeModalcreate() {
            document.getElementById("passwordModalcreate").style.display = "none";
        }

        window.onclick = function(event) {
            let modal = document.getElementById("passwordModalcreate");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
