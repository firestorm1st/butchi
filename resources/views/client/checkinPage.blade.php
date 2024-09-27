@extends('master')
@section('content')
<div class="container">
    <div class="task-calendar">
        <h1 style="text-align: center;" id="calendar-title"></h1>
        <div class="calendar">
            <!-- Calendar Header -->
            <div class="calendar-header">THỨ <br> 2</div>
            <div class="calendar-header">THỨ <br> 3</div>
            <div class="calendar-header">THỨ <br> 4</div>
            <div class="calendar-header">THỨ <br> 5</div>
            <div class="calendar-header">THỨ <br> 6</div>
            <div class="calendar-header">THỨ <br> 7</div>
            <div class="calendar-header">CHỦ <br> NHẬT</div>

            <!-- Calendar Days will be generated here -->
        </div>
    </div>

    <div class="task">
        <p>Cốc cốc! Mở cửa trái tim</p>
        @if ($existingMission)
            <p>{{ $mission->name }}</p>
            <button id="complete-btn" disabled>Đã hoàn thành</button>
        @elseif($mission)
            <form action="{{ route('client.submitFeedback') }}" method="post" id="feedback-form">
                @csrf
                <input type="hidden" name="mission_id" value="{{ $mission->id }}">
                <input type="hidden" name="completed" id="completed" value="true">
                
                <p>{{ $mission->name }}</p>
                <button type="button" id="complete-btn">Hoàn thành</button> <!-- Đổi type thành button để không submit form -->
            </form>
        @else
            <p>Hôm nay không có hoạt động màu yêu thương rồi, ngày mai bạn quay lại nhé!</p>
        @endif
    </div>
</div>

<div id="rating-popup" class="popup-overlay">
    <div class="popup-content">
        <h3>Bạn đánh giá mức độ hiệu quả của hoạt động này như thế nào?</h3>
        <form action="{{ route('client.submitFeedback') }}" method="POST" id="feedback-form">
            @csrf
            <input type="hidden" name="mission_id" value="{{ $mission->id }}">
            <input type="hidden" name="completed" id="completed" value="false">
        
            <div class="pencil-container">
                <img src="{{ asset('client/image/caybutngang.png') }}" alt="Pencil" class="pencil-background">
                <div class="star"></div>
            </div>
            <div class="levels">
                @for ($level = 0; $level <= 10; $level++)
                    <div class="level" data-level="{{ $level }}">{{ $level }}</div>
                @endfor
            </div>
        
            <textarea name="answer" id="user-feedback" placeholder="Chia sẻ với tụi mình suy nghĩ/cảm nhận của bạn về trải nghiệm trên nha!"></textarea>
            
            <input type="hidden" name="rating" id="rating-input" value="0">
            
            <button type="submit" id="submit-feedback">Gửi</button>
        </form>
    </div>
</div>


    <script>
        // Get the current date
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth(); // 0-indexed month (0 = January)

        // Update the title to show the current month and year
        const monthNames = [
            "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
            "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
        ];
        document.getElementById('calendar-title').textContent = `${monthNames[month]} / ${year}`;

        // Get the number of days in the current month
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Start the month on the first day

        const startDate = new Date(year, month, 1);
        const startDay = (startDate.getDay() + 6) % 7; // Adjust so Monday is 0

        const calendarContainer = document.querySelector('.calendar');
        const checkinDates = @json($checkin);
        // Fill in the empty days before the 1st of the month
        for (let i = 0; i < startDay; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.classList.add('calendar-day', 'empty');
            calendarContainer.appendChild(emptyDiv);
        }

        // Function to handle checking in and adding class
        function handleCheckIn(dayElement) {
            dayElement.classList.add('checked-in');
        }

        // Generate the days for the current month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.classList.add('calendar-day');
            dayDiv.innerHTML = `
        <span>${day}</span>
        <span class="checkmark">&#10003;</span>
        <input type="checkbox" class="check-in-btn" disabled id="day-${day}">
    `;

            const date = new Date();
            date.setDate(day);
            const formattedDate = date.toISOString().split('T')[0]; // Format as 'YYYY-MM-DD'

            // Check if this day is in the checkinDates array
            if (checkinDates.includes(formattedDate)) {
                // If yes, mark the day as checked in
                dayDiv.classList.add('checked-in');
                const checkInButton = dayDiv.querySelector('.check-in-btn');
                checkInButton.checked = true; // Mark checkbox as checked
            }

            // Optionally add an event listener to handle user checking in manually
            const checkInButton = dayDiv.querySelector('.check-in-btn');
            checkInButton.addEventListener('click', () => handleCheckIn(dayDiv));

            calendarContainer.appendChild(dayDiv);
        }

        // Handle check-in completion for today's date
        document.getElementById("complete-btn").addEventListener("click", function() {
            const day = today.getDate();
            const checkbox = document.getElementById(`day-${day}`);

            if (checkbox) {
                checkbox.checked = true;
                handleCheckIn(checkbox.parentElement); // Add checked-in class to the day div
            } else {
                alert("Không có checkbox cho ngày hôm nay.");
            }


        });
        //JS cho popup
    document.addEventListener('DOMContentLoaded', function() {
        const completeBtn = document.getElementById('complete-btn');
        const popup = document.getElementById('rating-popup');
        const levels = document.querySelectorAll('.level');
        const star = document.querySelector('.star');
        const ratingInput = document.getElementById('rating-input');
        const feedbackForm = document.getElementById('feedback-form');
        let selectedLevel = null;

        const levelPositions = {
            0: 0,
            1: 40,
            2: 80,
            3: 120,
            4: 160,
            5: 200,
            6: 240,
            7: 280,
            8: 320,
            9: 360,
            10: 400
        };

    // Hiện popup khi nhấn nút "Hoàn thành"
    completeBtn.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn form checkin submit ngay lập tức
        popup.style.display = 'flex';
    });

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

    // Khi form đánh giá được submit
    feedbackForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn form feedback gửi ngay
        
        const formData = new FormData(feedbackForm);

        // Gửi form feedback bằng AJAX
        fetch(feedbackForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())  // Giả sử server trả JSON
        .then(data => {
            if (data.success) {
                // Sau khi feedback thành công, submit form checkin
                const checkinForm = document.querySelector('form[action*="checkin"]');
                
                if (checkinForm) {
                    checkinForm.submit(); // Tự động submit form checkin sau khi feedback thành công
                }
                
                // Đóng popup sau khi hoàn thành
                popup.style.display = 'none';
            } else {
                // Hiển thị lỗi nếu có
                alert('Gửi đánh giá thất bại, vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
        });
    });
});
    </script>

    <style>
        body {
            font-family: 'true typewriter';
            background-color: #fffaed;
        }

        .container {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    width: 90%; /* Giữ nguyên chiều rộng container */
    max-width: 1400px; /* Tăng chiều rộng tối đa */
    
}
.level.selected {
        color: blue;
        font-weight: bold;
    }
h1 {
    width: 100%;
    text-align: center;
    margin: 20px 0;
}

.task-calendar, .task {
    width: 70%; /* Mỗi phần chiếm 50% màn hình */
    box-sizing: border-box; /* Đảm bảo padding không làm thay đổi kích thước */
}

.task-calendar {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.calendar {
    display: grid;
    gap: 10px;
    max-width: 400px; /* Giới hạn chiều rộng lịch */
    height: 150px;
    text-align: center;
    font-size: 14px;
    grid-template-columns: repeat(7, 1fr); /* Đặt mỗi ô chiếm 1 phần lưới */
    justify-items: center;
}

.calendar-header {
    font-size: 14px;
    font-weight: bold;
    background-color: #3D30A2;
    color: white;
    border-radius: 10px;
    text-align: center;
    width: 100%; /* Đảm bảo ô tiêu đề vừa với ô lịch */
    height: 65px; /* Độ cao của tiêu đề */
    display: flex;
    justify-content: center;
    align-items: center;
}

.calendar-day {
    width: 50px;
    height: 65px;
    background-color: #F7F7F7;
    border: 1px solid rgb(92, 88, 88);
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-size: 16px; /* Tăng kích thước chữ */
    position: relative;
}

.calendar-day.empty {
    background-color: transparent;
    border: none;
}

.checkmark {
    display: none;
    color: #3D30A2;
    font-size: 20px;
}

.checked-in .checkmark {
    display: inline;
}

.check-in-btn {
    margin-top: 10px;
    transform: scale(1.2); /* Tăng kích thước checkbox */
    pointer-events: none;
}

.checked-in .check-in-btn {
    display: none;
}

/* Phần CSS cho task */
.task {
    font-size: 30px;
    font-family: 'true typewriter';
    padding: 20px;
    background: url('{{ asset('client/image/note.png') }}') no-repeat center center;
    background-size: cover;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    min-height: 550px; /* Chiều cao tối thiểu để hiển thị tốt */
    box-sizing: border-box;
}

#complete-btn {
    float: bottom;
    margin-top: 10px;
    background-color: #563D7C;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

input[type="checkbox"] {
    pointer-events: none;
}
.popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none; /* Mặc định ẩn */
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .popup-content {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        position: relative;
        width: 500px;
    }

    .levels {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }

    .level {
        cursor: pointer;
    }

    .pencil-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .pencil-background {
        width: 100%;
        height: 50px;
    }

    .star {
        margin-top: 15px;
        position: absolute;
        width: 40px;
        height: 40px;
        background: url('{{ asset('client/image/ngoisao.png') }}') no-repeat center;
        background-size: contain;
        left: 0;
        top: -10px;
        transition: left 0.3s ease, top 0.3s ease; /* Thêm transition cho left và top */
    }

    textarea {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        height: 100px;
        resize: none;
    }

    #submit-feedback {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #3D30A2;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        float: right;
    }
</style>
@endsection
