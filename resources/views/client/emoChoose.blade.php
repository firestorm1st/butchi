@extends('master')
@section('content')
<div class="container">
    <h1>Hôm nay bạn cảm thấy thế nào?</h1>
    @if($emotionToday)
        <!-- Nếu đã chọn cảm xúc hôm nay, hiển thị icon và level đã chọn -->
        <div class="emotion-icons">
            @foreach($emotions as $emotion)
                <div class="icon" data-emotion="{{ $emotion->id }}" style="pointer-events: none;">
                    <img src="{{ asset('client/image/' . $emotion->image) }}" alt="{{ $emotion->name }}">
                    <div class="label">{{ $emotion->name }}</div>
                </div>
            @endforeach
        </div>
        <div class="main-content">
            <div class="emotion-jar">
                <img src="{{ asset('client/image/jar.jpg') }}" alt="Emotion Jar">
                <div class="icon-in-jar">
                    <img src="{{ asset('client/image/'.$emotionToday->emotion->image) }}" alt="{{ $emotionToday->emotion->name }}" class="icon-in-jar-style">
                    <div class="label">{{ $emotionToday->emotion->name }}</div>
                </div>
            </div>
    
            <!-- Disable level selection -->
            <div class="levels">
                @foreach($levels as $level)
                    <div class="level {{ $emotionToday->level_id == $level->id ? 'selected' : '' }}" data-level="{{ $level->id }}" style="pointer-events: none;">
                        {{ $level->name }}
                        <input type="hidden" name="level_id" value="{{ $level->id }}">
                    </div>
                @endforeach
            </div>
    
            <div class="pencil-container">
                <img src="{{ asset('client/image/caybutdoc.png') }}" alt="Pencil">
                <div class="star selected"></div>
            </div>
            <div class="text-block">
                <div class="emotion-text">
                    <h3>Mình dành vài phút để kể <br> về cảm xúc hôm nay nhé.</h3>
                    <textarea name="answer" class="text-content" disabled placeholder="{{ $emotionToday->answer }}"></textarea>
                    <div class="button-container">
                        <button type="submit" class="custom-button" disabled>Gửi ></button>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- If no emotion for today, show the form -->
        <form action="{{ route('client.emotion.store', ['id' => $room->id]) }}" method="POST">
            @csrf
            <input type="hidden" id="emotion_id" name="emotion_id" value="">
            <input type="hidden" id="level_id" name="level_id" value="">
            <div class="emotion-icons">
                @foreach($emotions as $emotion)
                    <div class="icon" data-emotion="{{ $emotion->id }}">
                        <img src="{{ asset('client/image/' . $emotion->image) }}" alt="{{ $emotion->name }}">
                        <div class="label">{{ $emotion->name }}</div>
                    </div>
                @endforeach
            </div>
            <div class="main-content">
                <div class="emotion-jar">
                    <img src="{{ asset('client/image/jar.jpg') }}" alt="Emotion Jar">
                    <div class="icon-in-jar"></div>
                </div>
                <!-- Show levels to choose from -->
                <div class="levels">
                    @foreach($levels as $level)
                        <div class="level" data-level="{{ $level->id }}">
                            {{ $level->name }}
                        </div>
                    @endforeach
                </div>
                <div class="pencil-container">
                    <img src="{{ asset('client/image/caybutdoc.png') }}" alt="Pencil">
                    <div class="star"></div>
                </div>
                <div class="text-block">
                    <div class="emotion-text">
                        <h3>Mình dành vài phút để kể <br> về cảm xúc hôm nay nhé.</h3>
                        <textarea name="answer" class="text-content" placeholder="Viết vào đây..."></textarea>
                        <div class="button-container">
                            <button type="submit" class="custom-button">Gửi ></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>

<!-- Modal hiển thị sau khi gửi cảm xúc -->
<div id="ModalRating" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModalcreate()">&times;</span>
        <h2>Bạn đánh giá mức độ hiệu quả của hoạt động này như thế nào</h2>
        <form id="createRoomForm" action="{{ route('client.rooms.store') }}" method="POST">
            @csrf
            <input type="text" id="roomName" name="name" placeholder="Nhập tên phòng..." required>
            <h2>Nhập mật khẩu</h2>
            <input type="password" id="roomPassword" name="password" placeholder="Nhập mật khẩu..." required>
            <input type="password" id="roomPasswordConfirm" name="password_confirmation" placeholder="Xác nhận mật khẩu..." required>
            <div>
                <button type="submit" class="submit-btn">Xác nhận</button>
            </div>
        </form>
    </div>
</div>

<!-- CSS -->
<style>
    /* Các thiết lập cho giao diện chính */
    body {
        background-color: #fffaed;
    }

    .container {
        text-align: center;
    }

    h1 {
        margin-bottom: 20px;
        font-size: 40px;
        font-family: 'Dancing Script';
    }

    /* Thiết lập cho các biểu tượng cảm xúc */
    .emotion-icons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .icon {
        position: relative;
        display: inline-block;
        text-align: center;
        cursor: pointer;
    }

    .icon img {
        width: 60px;
        height: 60px;
        transition: transform 0.2s;
    }

    .icon:hover img {
        transform: scale(1.1);
    }

    .label {
        margin-top: 0px;
        font-size: 16px;
        color: #F1C40F;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .icon:hover .label {
        opacity: 1;
    }

    /* Main Content: Emotion Jar, Levels, và các phần khác */
    .main-content {
        justify-content: center;
        display: flex;
        align-items: center;
        gap: 30px;
        margin-top: 30px;
    }

    .emotion-jar {
        position: relative;
        width: 250px;
        height: auto;
        display: block;
        background-size: contain;
    }

    .icon.disabled,
    .level.disabled {
        pointer-events: none;
        opacity: 0.5;
    }

    /* Disabled textarea */
    .text-block textarea[disabled] {
        background-color: #f0f0f0;
        color: #999;
        cursor: not-allowed;
    }

    /* Disabled button */
    .custom-button[disabled] {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .icon-in-jar {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-in-jar-style {
        max-width: 60px;
        max-height: 60px;
        position: absolute;
        transform: translate(0px, -70px);
        transition: transform 0.3s ease;
    }

    .levels {
        font-family: 'Dancing Script';
        display: flex;
        flex-direction: column;
        gap: 12px;
        font-size: 16px;
        cursor: pointer;
        justify-content: center;
    }

    .level.selected {
        color: blue;
        font-weight: bold;
    }

    .pencil-container {
        position: relative;
        justify-content: center;
    }

    .pencil-container img {
        height: 230px;
        width: auto;
    }

    .star {
        position: absolute;
        top: 0;
        left: 53%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        background: url('{{ asset('client/image/ngoisao.png') }}') no-repeat center center;
        background-size: contain;
        transition: top 0.5s ease;
    }

    .text-block {
        width: 230px;
        display: flex;
        align-items: flex-start;
        background: url('{{ asset('client/image/note.png') }}') no-repeat center center;
        background-size: cover;
    }

    .text-block h3 {
        margin-left: 20px;
        margin-top: 30px;
        font-size: 18px;
        font-family: 'Dancing Script';
    }

    .text-block textarea {
        margin-left: 15px;
        width: 200px;
        height: 100px;
        resize: none;
        font-family: 'true typewriter';
    }

    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .custom-button {
        padding: 10px 20px;
        background-color: #2ecc71;
        border: none;
        border-radius: 5px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    /* Modal CSS */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const icons = document.querySelectorAll(".icon");
        const jar = document.querySelector(".icon-in-jar");

        let previouslySelectedIcon = null;

        icons.forEach(icon => {
            if (icon.classList.contains("disabled")) {
                icon.style.opacity = "0.5";
                icon.style.pointerEvents = "none";
                previouslySelectedIcon = icon;
                return;
            }

            icon.addEventListener("click", function() {
                if (icon.classList.contains("disabled")) return;

                jar.innerHTML = "";

                const clonedIcon = icon.querySelector("img").cloneNode(true);
                clonedIcon.classList.add("icon-in-jar-style");
                jar.appendChild(clonedIcon);

                if (previouslySelectedIcon) {
                    previouslySelectedIcon.classList.remove("disabled");
                    previouslySelectedIcon.style.opacity = "1";
                    previouslySelectedIcon.style.pointerEvents = "auto";
                }

                icon.classList.add("disabled");
                icon.style.opacity = "0.5";
                icon.style.pointerEvents = "none";

                previouslySelectedIcon = icon;
            });
        });
    });
document.addEventListener('DOMContentLoaded', function() {
    const levels = document.querySelectorAll('.level');
    const star = document.querySelector('.star');
    let selectedLevel = null;

    // Vertical positions for each level (adjust these based on your design)
    const levelPositions = {
        1: 10, // Bottom of the pencil for level 1
        2: 45, // Level 2
        3: 90, // Level 3
        4: 130,  // Level 4
        5: 173  // Top of the pencil for level 5
    };

    const preSelectedLevel = document.querySelector('.level.selected');
    if (preSelectedLevel) {
        const levelValue = preSelectedLevel.getAttribute('data-level');
        const newPosition = levelPositions[levelValue];
        star.style.top = `${newPosition}px`;
    }

    // Handle click events on the levels
    levels.forEach((level) => {
        level.addEventListener('click', function() {
            // Remove 'selected' class from the previously selected level, if any
            if (selectedLevel) {
                selectedLevel.classList.remove('selected');
            }

            // Mark the clicked level as selected
            selectedLevel = level;
            level.classList.add('selected');

            // Get the level value from the data-level attribute
            const levelValue = level.getAttribute('data-level');

            // Move the star vertically based on the clicked level
            const newPosition = levelPositions[levelValue];
            star.style.top = `${newPosition}px`;
        });
    });
});
document.addEventListener("DOMContentLoaded", function() {
        const icons = document.querySelectorAll(".icon");
        const levels = document.querySelectorAll(".level");
        const jar = document.querySelector(".icon-in-jar");
        const star = document.querySelector(".star");
        const emotionInput = document.getElementById("emotion_id");
        const levelInput = document.getElementById("level_id");

        let selectedEmotionId = null;
        let selectedLevelId = null;

        icons.forEach(icon => {
            icon.addEventListener("click", function() {
                const emotionId = icon.getAttribute("data-emotion");
                selectedEmotionId = emotionId;
                
                emotionInput.value = emotionId;  // Cập nhật giá trị emotion_id

                jar.innerHTML = ""; // Clear previous icon

                const clonedIcon = icon.querySelector("img").cloneNode(true);
                clonedIcon.classList.add("icon-in-jar-style");
                jar.appendChild(clonedIcon);

                icons.forEach(i => i.classList.remove("selected"));
                icon.classList.add("selected");
            });
        });

        levels.forEach(level => {
            level.addEventListener("click", function() {
                const levelId = level.getAttribute("data-level");
                selectedLevelId = levelId;

                levelInput.value = levelId;  // Cập nhật giá trị level_id

                levels.forEach(lvl => lvl.classList.remove("selected"));
                level.classList.add("selected");

                const starPosition = 50 + (20 * (levelId - 1));
                star.style.top = starPosition + "px";
            });
        });
    });
    document.querySelector('form').addEventListener('submit', function(event) {
    if (!selectedEmotionId || !selectedLevelId) {
        event.preventDefault(); // Ngăn form gửi nếu chưa chọn cảm xúc và mức độ
        alert('Vui lòng chọn cảm xúc và mức độ trước khi gửi.');
    }
});
    // Modal logic
    function closeModalcreate() {
        document.getElementById('ModalRating').style.display = 'none';
    }
</script>
@endsection