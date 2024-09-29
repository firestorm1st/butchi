@extends('master')
@section('content')
<!-- Modal hiển thị sau khi gửi cảm xúc -->
<div class="feedback-container">
    <h3>Bạn đánh giá mức độ hiệu quả của hoạt động này như thế nào?</h3>
    <form action="{{ route('client.Feedback') }}" method="POST" id="feedback-form">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <div class="pencil-container">
            <img src="{{ asset('client/image/caybutngang.png') }}" alt="Pencil" class="pencil-background">
            <div class="star"></div>
        </div>

        <div class="levels">
            @for ($level = 0; $level <= 10; $level++)
                <div class="level" data-level="{{ $level }}">{{ $level }}</div>
            @endfor
        </div>

        <div class="questions-container">
            <div class="question">
                <p>Trong một tuần qua, bạn đánh giá như thế nào về việc xác định và chia sẻ cảm xúc của bản thân.</p>
                <textarea name="answer1" id="user-feedback1" placeholder="Nhập vào đây..."></textarea>
            </div>
            <div class="vertical-divider"></div>
            <div class="question">
                <p>Bạn nhận thấy sự thay đổi gì trong việc kết nối giữa mình và cha mẹ như thế nào.</p>
                <textarea name="answer2" id="user-feedback2" placeholder="Nhập vào đây..."></textarea>
            </div>
        </div>

        <input type="hidden" name="rating" id="rating-input" value="0">

        <button type="submit" id="submit-feedback">Gửi</button>
    </form>
</div>
<style>
    .feedback-container {
    max-width: 800px; /* Điều chỉnh chiều rộng để gần với hình ảnh */
    margin: 0 auto;
    padding: 40px; /* Thêm nhiều khoảng trắng */
    background-color: #fdf7e7; /* Màu nền tương tự như màu trong hình */
    border-radius: 20px;
    text-align: center;
}

h3 {
    font-size: 24px;
    margin-bottom: 30px;
    color: #333;
    font-family: 'Dancing Script';
}

.pencil-container {
    position: relative;
    margin-bottom: 40px;
}

.pencil-background {
    width: 100%;
    max-width: 600px; /* Điều chỉnh chiều rộng của hình cây bút */
    margin: 0 auto;
}

.star {
    position: absolute;
    top: -50px; /* Đặt ngôi sao nằm phía trên cây bút */
    margin-top: 50px;
    left: 50%;
    transform: translateX(-50%);
    width: 65px;
    height: 65px;
    background: url('{{ asset('client/image/ngoisao.png') }}') no-repeat center center;
    background-size: contain;
    transition: left 0.6s ease-in-out;
}

.levels {
    display: flex;
    justify-content: space-between;
    max-width: 600px; /* Chiều rộng của thước đo */
    margin: 0 auto;
    padding: 0 15px;
}

.level {
    cursor: pointer;
    font-size: 18px;
    color: #555;
    padding: 5px 10px;
    border-radius: 50%;
    transition: background-color 0.3s;
}

.level:hover, .level.selected {
    background-color: #f39c12;
    color: #fff;
}

.questions-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
}

.question {
    width: 48%; /* Chia đều hai câu hỏi */
    text-align: left;
}

.question p {
    font-family: 'Dancing Script';
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
}

textarea {
    font-family: 'true typewriter';
    width: 100%;
    height: 150px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 16px;
    background-color: #fff8e1;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    resize: none;
}

#submit-feedback {
    padding: 15px 30px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 20px;
    transition: background-color 0.3s;
}

#submit-feedback:hover {
    background-color: #2980b9;
}
.vertical-divider {
    width: 2px;
    background-color: #ccc;
    margin: 0 15px; /* Khoảng cách giữa thanh và các text area */
}


</style>

<!-- JavaScript -->
<script>
    // Modal logic
    document.addEventListener('DOMContentLoaded', function() {
        const completeBtn = document.getElementById('complete-btn');
        const levels = document.querySelectorAll('.level');
        const star = document.querySelector('.star');
        const ratingInput = document.getElementById('rating-input');
        let selectedLevel = null;

        const levelPositions = {
            0: 80,
            1: 145,
            2: 195,
            3: 250,
            4: 300,
            5: 355,
            6: 410,
            7: 460,
            8: 510,
            9: 560,
            10: 620
        };

    // Xử lý sự kiện click trên các level
    levels.forEach((level) => {
        level.addEventListener('click', function() {
            if (selectedLevel) {
                selectedLevel.classList.remove('selected');
            }

            selectedLevel = level;
            level.classList.add('selected');

            const levelValue = level.getAttribute('data-level');
            const newPosition = levelPositions[levelValue];

            // Di chuyển ngôi sao theo level
            star.style.left = `${newPosition}px`; // Chỉ thay đổi left

            // Gán giá trị level vào input hidden
            ratingInput.value = levelValue;
        });
    });
});
</script>
@endsection