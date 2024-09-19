@extends('master')
@section('content')
    <div class="container_account">

        <div class="left-column">
            <div class="center">
                <h2 style="font-family:'Dancing Script'; font-size: 36px;">{{ $user->username }}</h2>
                @if ($user->avatar)
                    <img src="{{ asset('uploads/' . $user->avatar) }}" alt="Hình đại diện người dùng" width='200px'
                        height='200px'>
                @else
                    <img src="{{ asset('client/image/avatar.png') }}" alt="Avatar">
                @endif
                {{-- <p style="font-family: 'true typewriter';">Thay đổi hình đại diện</p> --}}
            </div>
            <div style="font-size: 15px">
                <b style="display: inline-block; ">Giao diện: </b>

                @if ($user->role == 1)
                    <p style="display: inline-block;">Học sinh</p>
                @elseif ($user->role == 2)
                    <p style="display: inline-block;">Phụ huynh</p>
                @elseif ($user->role == 3)
                    <p style="display: inline-block;">Admin</p>
                @endif
            </div>

            <div style="font-size: 15px">
                <b style="display: inline-block; ">Email: </b>
                <p style="display: inline-block;">{{ $user->email }}</p>
            </div>

            <div style="font-size: 15px">
                <b style="display: inline-block; ">Nhiệm vụ: </b>
                @if ($user->is_offline == 1)
                    <p style="display: inline-block;">Trực tiếp</p>
                @elseif ($user->is_offline == 2)
                    <p style="display: inline-block;">Trực tuyến</p>
                @endif
            </div>

            @if (Auth::check())
                @if (Auth::user()->id == $user->id)
                    <a style="margin-top: 10px" href="{{ route('client.changeAccount', ['id' => $user->id]) }}"
                        class="btn btn-primary" style="font-family: 'true typewriter';">Cập nhật thông tin</a>
                @endif
            @endif
        </div>

        <div class="right-column">
            <div class="icon-container ">
                @foreach ($emotions as $emo)
                    <img src="{{ asset('client/image/' . $emo->image) }}" alt="Avatar">
                @endforeach


            </div>
            <canvas id="myLineChart" style="font-size: 40px"></canvas>

        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dataFromLaravel = @json($data);

            // Tạo mảng label từ các giá trị ngày
            const labels = dataFromLaravel.map(item => {
                const date = new Date(item.date);
                return `${date.getDate()}/${date.getMonth() + 1}`; // Định dạng ngày thành dd/mm
            });

            // Tạo mảng data từ các giá trị emo_id (hoặc giá trị khác bạn muốn hiển thị)
            const emoData = dataFromLaravel.map(item => item.emo_id);



            // Khởi tạo biểu đồ
            var ctx = document.getElementById('myLineChart').getContext('2d');
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels, // Gán các nhãn ngày
                    datasets: [{
                        label: 'Cảm xúc 7 ngày',
                        data: emoData, // Các giá trị (1 đến 8) cho trục Y
                        backgroundColor: [
                            'rgba(105, 0, 132, .2)',
                        ],
                        fill: true,
                        borderColor: [
                            'rgba(255, 99, 132, 0.8)',
                        ],
                        borderWidth: 2,

                        pointBackgroundColor: 'rgba(255, 99, 132, 0.8)', // Màu nền của các điểm
                        pointBorderColor: '#fff', // Màu viền của các điểm
                        pointRadius: 5, // Kích thước của các điểm
                        pointHoverRadius: 7, // Kích thước của các điểm khi hover
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 1, // Giá trị tối thiểu trên trục Y
                            max: 8, // Giá trị tối đa trên trục Y
                            ticks: {
                                stepSize: 1, // Các giá trị cách nhau 1 đơn vị
                                callback: function(value) {
                                    return ""; // Hiển thị số trên trục Y
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    // Tùy chỉnh văn bản trong tooltip dựa trên giá trị
                                    let text;
                                    switch (context.raw) {
                                        case 1:
                                            text = "Bất ngờ";
                                            break;
                                        case 2:
                                            text = "Buồn bã";
                                            break;
                                        case 3:
                                            text = "Giận dữ";
                                            break;
                                        case 4:
                                            text = "Mong đợi";
                                            break;
                                        case 5:
                                            text = "Sợ hãi";
                                            break;
                                        case 6:
                                            text = "Tin tưởng";
                                            break;
                                        case 7:
                                            text = "Vui vẻ";
                                            break;
                                        case 8:
                                            text = "Chán ghét";
                                            break;
                                        default:
                                            text = "Không xác định";
                                    }
                                    return 'Cảm xúc: ' + text;
                                }
                            }
                        },
                        legend: {
                            display: true
                        }
                    }
                }
            });


        });
    </script>
    <style>
        body {
            background-color: #fffaed;

        }

        .left-column img {
            width: 100px;
            height: 100px;
        }

        .container_account {
            display: flex;
            align-items: center;
            width: 90%;
            margin: 50px auto;

        }

        .left-column {
            /* width: 40%px; */
            /* Điều chỉnh độ rộng theo ý muốn */
            height: 100%;
            /* Điều chỉnh độ cao theo ý muốn */
            background-color: #9a901e6c;
            /* Màu nền */
            border-radius: 10px;
            /* Làm tròn góc */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
            /* Thêm bóng */
            padding: 10px;
            text-align: left;
            margin-right: 30px;
            margin-left: 80px;
        }

        .center {
            text-align: center;
            margin-bottom: 30px;
        }

        .right-column {

            display: flex;
            flex-direction: row;
            align-items: center;

        }

        .icon-container {
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        .icon-container img {
            width: 33px;
            height: 33px;
            margin-top: 21px;
        }

        .left-column p {
            style="font-family: 'true typewriter';"
        }

        #myLineChart {
            /* position: relative; */
            height: 400px;
            width: 200%;

        }

        .left-column img {
            border-radius: 100%
        }
    </style>
@endsection
