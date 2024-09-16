@extends('master')
@section('content')
    <h1>CHỌN PHÒNG</h1>
    <div class="create-room">
        <button class="create-room-btn" onclick="openModalcreate()">TẠO PHÒNG +</button>
    </div>
    <div class="rooms-container">
        <div class="room">
            <div class="room-image">
                <img src="{{ asset('client/image/phong.png') }}" alt="Room 1">
                <div class="room-info">Phòng ph</div>
            </div>
            <button class="enter-btn" onclick="openModal()">Vào</button>
        </div>

        <div class="room">
            <div class="room-image">
                <img src="{{ asset('client/image/phong.png') }}" alt="Room 2">
                <div class="room-info">Phòng 2</div>
            </div>
            <button class="enter-btn" onclick="openModal()">Vào</button>
        </div>

        <div class="room">
            <div class="room-image">
                <img src="{{ asset('client/image/phong.png') }}" alt="Room 2">
                <div class="room-info">Phòng 2</div>
            </div>
            <button class="enter-btn" onclick="openModal()">Vào</button>
        </div>

        <div class="room">
            <div class="room-image">
                <img src="{{ asset('client/image/phong.png') }}" alt="Room 2">
                <div class="room-info">Phòng 2</div>
            </div>
            <button class="enter-btn" onclick="openModal()">Vào</button>
        </div>
        <div class="room">
            <div class="room-image">
                <img src="{{ asset('client/image/phong.png') }}" alt="Room 2">
                <div class="room-info">Phòng 2</div>
            </div>
            <button class="enter-btn" onclick="openModal()">Vào</button>
        </div>
        <div class="room">
            <div class="room-image">
                <img src="{{ asset('client/image/phong.png') }}" alt="Room 2">
                <div class="room-info">Phòng 2</div>
            </div>
            <button class="enter-btn" onclick="openModal()">Vào</button>
        </div>

        <div class="room">
            <div class="room-image">
                <img src="{{ asset('client/image/phong.png') }}" alt="Room 2">
                <div class="room-info">Phòng 3</div>
            </div>
            <button class="enter-btn" onclick="openModal()">Vào</button>
        </div>
    </div>
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Nhập mật khẩu</h2>
            <input type="password" id="roomPassword" placeholder="Nhập mật khẩu...">
            <div>
                <button class="submit-btn">Xác nhận</button>
            </div>
        </div>
    </div>

    <div id="passwordModalcreate" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModalcreate()">&times;</span>
            <h2>Nhập tên phòng</h2>
            <input type="text" id="roomName" placeholder="Nhập tên phòng...">
            <h2>Nhập mật khẩu</h2>
            <input type="password" id="roomPassword" placeholder="Nhập mật khẩu...">
            <div>
                <button class="submit-btn">Xác nhận</button>
            </div>
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
            /* Four rooms per row */
            margin-bottom: 40px;
            text-align: center;
        }

        .room-image {
            position: relative;
        }

        .room img {
            width: 150px;
            height: auto;
        }

        .room-info {
            position: absolute;
            top: 37%;
            /* Adjust to fit the board on the door */
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 16px;
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
            /* Black with opacity */
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
        // Function to open the modal
        function openModal() {
            document.getElementById("passwordModal").style.display = "flex";
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById("passwordModal").style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            let modal = document.getElementById("passwordModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Function to open the modal
        function openModalcreate() {
            document.getElementById("passwordModalcreate").style.display = "flex";
        }

        // Function to close the modal
        function closeModalcreate() {
            document.getElementById("passwordModalcreate").style.display = "none";
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            let modal = document.getElementById("passwordModalcreate");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
