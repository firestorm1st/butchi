{{-- @extends('master')
@section('content') --}}
{{-- <div class="container">
        <div class="calendar">
            <div class="week">
                <!-- Display weekdays -->
                <div class="day">Thứ 2</div>
                <div class="day">Thứ 3</div>
                <div class="day">Thứ 4</div>
                <div class="day">Thứ 5</div>
                <div class="day">Thứ 6</div>
                <div class="day">Thứ 7</div>
                <div class="day">Chủ Nhật</div>
            </div>
            <div class="dates">
                <!-- Create a checkbox for each date -->
                <div><input type="checkbox" id="day-16"><label for="day-16">16</label></div>
                <div><input type="checkbox" id="day-17"><label for="day-17">17</label></div>
                <div><input type="checkbox" id="day-18"><label for="day-18">18</label></div>
                <div><input type="checkbox" id="day-19"><label for="day-19">19</label></div>
                <div><input type="checkbox" id="day-20"><label for="day-20">20</label></div>
                <div><input type="checkbox" id="day-21"><label for="day-21">21</label></div>
                <div><input type="checkbox" id="day-22"><label for="day-22">22</label></div>
            </div>
        </div>

        <div class="task">
            <p>Cốc cốc! Mở cửa trái tim</p>
            <p>Hôm nay, bạn hãy nói “Con yêu cha/mẹ” trước khi đi ngủ</p>
            <button id="complete-btn">Hoàn thành</button>
        </div>
    </div>

    <script>
        document.getElementById("complete-btn").addEventListener("click", function() {
            // Get today's date
            const today = new Date();
            const day = today.getDate();

            // Find the checkbox corresponding to today's date
            const checkbox = document.getElementById(`day-${day}`);

            if (checkbox) {
                // Check the checkbox if it exists
                checkbox.checked = true;
            } else {
                alert("Không có checkbox cho ngày hôm nay.");
            }
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f9f9f9;
        }

        .container {
            display: flex;
            align-items: flex-start;
            /* Align items at the top */
            gap: 20px;
            /* Space between the calendar and task */
        }

        .calendar {
            display: flex;
            flex-direction: column;
        }

        .week {
            display: flex;
        }

        .day {
            flex: 1;
            text-align: center;
            background-color: #563D7C;
            color: white;
            padding: 10px;
            font-weight: bold;
        }

        .dates {
            display: flex;
            justify-content: space-between;
            padding-top: 10px;
        }

        .dates div {
            width: 14%;
            text-align: center;
        }

        input[type="checkbox"] {
            transform: scale(1.5);
            pointer-events: none;
            /* Disable manual checking */
        }

        
        }
    </style> --}}
{{-- @endsection --}}

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
                <form action="{{ route('client.checkin', ['id' => $mission->id]) }}" method="post">
                    @csrf
                    <p>{{ $mission->name }}</p>
                    <button id="complete-btn">Hoàn thành</button>
                </form>
            @else
                <p>Hôm nay không có hoạt động màu yêu thương rồi, ngày mai bạn quay lại nhé!</p>
            @endif
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
    </script>

    <style>
        body {
            font-family: 'true typewriter';
            background-color: #fffaed;
        }

        .container {
            display: flex;
            align-items: flex-start;
            /* Align items at the top */
            gap: 20px;

            /* Space between the calendar and task */
        }

        h1 {
            width: 70%;
            margin: 30px auto;
        }

        .task-calendar {
            width: 60%;
        }

        .calendar {
            display: grid;
            /* grid-template-columns: repeat(7, 1fr); */
            gap: 10px;
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            font-size: 15px;
            grid-template-columns: 70px 70px 70px 70px 70px 70px 70px;


        }

        .calendar-header {
            font-size: 15px;
            font-weight: bold;
            background-color: #3D30A2;
            /* width: 50px; */
            /* margin: 15px auto; */
            padding: 20px 0;
            height: 100px;
            border: 1px solid;
            color: white;
            border-radius: 10px;
            text-align: center;
        }

        .calendar-day {
            position: relative;
            padding: 20px;
            background-color: #F7F7F7;
            border: 1px solid rgb(92, 88, 88);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 17px;
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
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            background-color: #f0f0f0;
            transition: background-color 0.3s ease;
        }

        .check-in-btn:hover {
            background-color: #d0d0d0;
        }

        .checked-in .check-in-btn {
            display: none;
        }

        .task {
            padding: 20px;
            background-color: #FCE9E6;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        #complete-btn {
            margin-top: 10px;
            background-color: #563D7C;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="checkbox"] {
            transform: scale(1.5);
            pointer-events: none;
            /* Disable manual checking */
        }
    </style>
@endsection
