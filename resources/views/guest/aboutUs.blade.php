@extends('master')
@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fdf7e2; /* Màu nền giống trong hình */
        color: #333;
    }

    .container {
        width: 80%;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px; /* Bo góc cho container */
        position: relative;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h1 {
        color: #333;
        font-size: 32px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .header p {
        color: #8e44ad; /* Màu tím cho tiêu đề phụ */
        font-size: 20px;
        font-style: italic;
        margin-bottom: 20px;
    }

    hr {
        border: 0;
        height: 1px;
        background: #ccc; /* Màu của thẻ hr */
        margin: 40px 0; /* Khoảng cách của dòng kẻ */
    }

    /* Styling cho phần thông điệp */
    .message {
        margin-top: 30px;
    }

    .message h2 {
        color: #f39c12;
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
    }

    .message-content {
        display: flex;
        gap: 20px; /* Khoảng cách giữa các cột */
        margin-bottom: 30px;
    }
    .q{
        float: left; /* Căn trái */
    width: 50%; /* Chiếm 50% chiều rộng */
    }

    .column {
        flex: 1; /* Mỗi cột chiếm không gian đều nhau */
    }

    .message p {
        text-align: justify;
        font-size: 16px;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    /* Styling cho phần hướng dẫn */
    .steps, .evaluation {
        margin-bottom: 20px;
        float: left; /* Căn trái */
    width: 50%; /* Chiếm 50% chiều rộng */
    }

    .steps p, .evaluation p {
        font-size: 13px;
        line-height: 1.6;
        margin: 10px 0;
        
    }

    .highlight {
        color: #e74c3c; /* Màu đỏ để làm nổi bật các bước */
        font-weight: bold;
    }

    .illustration {
        display: block;
        margin: 0 auto; /* Canh giữa hình minh họa */
        width: 300px; /* Kích thước hình ảnh */
        height: auto;
        margin-top: 30px;
    }
</style>
<div class="container">
    <!-- Phần đầu -->
    <div class="header">
        <h1>Bút Chì Thấu Cảm</h1>
        <p>Bút Chì Thấu Cảm - cầu nối để giúp các gia đình <br> 
        diễn đạt tình yêu thương theo một cách rất riêng <br> 
        - tôn trọng, tin tưởng, hạnh phúc.</p>
    </div>
    
    <!-- Phần thông điệp -->
    <div class="message">
        <h2>Thông điệp</h2>
        <div class="message-content">
            <div class="column">
                <p>
                    “Bút chì” - cây bút đầu tiên bắt đầu cho mọi nét chữ của con. Và gia đình luôn là nơi quan trọng, nền tảng cho sự trưởng thành.
                    Trong hành trình lớn khôn ấy, “Bút chì con cái” luôn phải tự gọt giữa mình để thoát khỏi thân phận đứa trẻ nhưng vẫn cân bằng mối quan hệ với cha mẹ.
                    Nhiều nghiên cứu cho thấy vị thành niên chưa phát triển hoàn thiện các chức năng điều hành (theo E.Jensen và Nutt) nên rất cần sự dẫn dắt, hỗ trợ và chấp nhận từ phía “Bút chì cha mẹ”.
                </p>
            </div>
            <div class="column">
                <p>
                    “Bút Chì Thấu Cảm” mong muốn hướng tới việc xây dựng cầu nối đúng đắn, khoa học giữa cha mẹ và con cái - nơi tình yêu thương và sự thấu cảm có thể giúp cha mẹ trở thành người bạn đồng hành,
                    dẫn dắt con em mình trong giai đoạn chuyển tiếp đầy thách thức của lứa tuổi vị thành niên.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Dòng kẻ ngang phân cách -->
    <hr>

    <!-- Phần hướng dẫn sử dụng -->
    <div class="header">
        <h1>Hướng dẫn sử dụng</h1>
        <h2>“Vẽ tâm tư”</h2>
    </div>
    <div class="q">
        <div class="steps">
            <p><span class="highlight">Bước 1:</span> Chọn một cảm xúc chủ đạo trong ngày.</p>
            <p><span class="highlight">Bước 2:</span> Đánh giá mức độ của cảm xúc đó bằng cách ấn vào thang đo bên cạnh thân bút chì.</p>
            <p><span class="highlight">Bước 3:</span> Chia sẻ thêm về cảm xúc ngày hôm nay thông qua phần giấy ghi chú. (Điều gì/việc gì đã mang đến cảm xúc đó? Bạn xử lý cảm xúc đó như thế nào?...)</p>
            <p><span class="highlight">Bước 4:</span> Nhấn nút gửi để cảm xúc được hiển thị cho các thành viên khác trong phòng, và sẽ được lưu trữ tại phần “biểu đồ cảm xúc”.</p>
            <p>Mỗi tuần sẽ có một phần đánh giá để “Bút Chì Thấu Cảm” có thể khảo sát ý kiến người dùng về hoạt động này.</p>
        </div>
        <div class="evaluation">
            <p><span class="highlight">Bước 1:</span> Đánh giá mức độ hiệu quả của hoạt động này bằng cách nhấn vào con số từ 0-10 dưới thân bút chì.</p>
            <p><span class="highlight">Bước 2:</span> Chia sẻ thêm suy nghĩ/trải nghiệm thông qua phần câu hỏi trên giấy ghi chú bên dưới.</p>
            <p><span class="highlight">Bước 3:</span> Nhấn nút gửi để hoàn thành.</p>
        </div>
    </div>

    <img src="{{asset('client/image/trang.jpg')}}" alt="Illustration" class="illustration">
</div>
@endsection
