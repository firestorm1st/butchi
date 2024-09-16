<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart with Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 80%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="chart-container">
       
        <canvas id="myLineChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        
        var ctx = document.getElementById('myLineChart').getContext('2d');

        // Gọi API lấy dữ liệu cho 7 ngày gần nhất
        // fetch('data/{id}')
        // .then(response => response.json())
        // .then(data => {
        //     // Tạo mảng label từ các giá trị ngày
        //     const labels = data.map(item => {
        //         const date = new Date(item.date);
        //         return `${date.getDate()}/${date.getMonth() + 1}`; // Định dạng ngày thành dd/mm
        //     });

        //     // Tạo mảng dữ liệu từ các giá trị icon_value (1 đến 8)
        //     const yValues = data.map(item => item.emo_id);

        var dataFromLaravel = @json($data);
        
        // Tạo mảng label từ các giá trị ngày
        const labels = dataFromLaravel.map(item => {
            const date = new Date(item.date);
            return `${date.getDate()}/${date.getMonth() + 1}`; // Định dạng ngày thành dd/mm
        });

        // Tạo mảng data từ các giá trị emo_id (hoặc giá trị khác bạn muốn hiển thị)
        const emoData = dataFromLaravel.map(item => item.emo_id);


            // Khởi tạo biểu đồ
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels, // Gán các nhãn ngày
                    datasets: [{
                        label: 'Icon Values',
                        data: emoData, // Các giá trị (1 đến 8) cho trục Y
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Màu nền của các điểm
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
                                    return value; // Hiển thị số trên trục Y
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
                                    switch(context.raw) {
                                        case 1: 
                                            text = "Hơi giận dữ";
                                            break;
                                        case 2: 
                                            text = "Hơi thất vọng";
                                            break;
                                        case 3: 
                                            text = "Tạm ổn";
                                            break;
                                        case 4: 
                                            text = "Khá tốt";
                                            break;
                                        case 5: 
                                            text = "Rất tốt";
                                            break;
                                        case 6: 
                                            text = "Tuyệt vời";
                                            break;
                                        case 7: 
                                            text = "Xuất sắc";
                                            break;
                                        case 8: 
                                            text = "Hoàn hảo";
                                            break;
                                        default:
                                            text = "Không xác định";
                                    }
                                    return 'Cảm xúc: ' +  text;
                                }
                            }
                        },
                        legend: {
                            display: true
                        }
                    }
                }
            });
        // .catch(error => console.error('Error fetching data:', error));
    });
    </script>
</body>
</html>
