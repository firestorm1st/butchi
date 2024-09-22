@extends('master')
@section('content')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fffaed;
            ;
            /* Màu nền giống trong hình */
            color: #333;
        }

        p {
            font-family: 'true typewriter';
        }

        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fffaed;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            border-radius: 8px;
            /* Bo góc cho container */
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 30px 0;
            background-color: #F2F2F2;
        }

        .header h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .header p {
            color: black;
            /* Màu tím cho tiêu đề phụ */
            font-size: 20px;
            font-style: italic;
            margin-bottom: 20px;

        }

        hr {
            border: 0;
            height: 1px;
            background: #ccc;
            /* Màu của thẻ hr */
            margin: 40px 0;
            /* Khoảng cách của dòng kẻ */
        }

        /* Styling cho phần thông điệp */
        .message {
            margin-top: 30px;
        }

        .message h2 {
            color: #f39c12;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: left;
            font-weight: bold;
        }

        .message-content {
            display: flex;
            gap: 20px;
            /* Khoảng cách giữa các cột */
            margin-bottom: 30px;
        }

        .q {
            float: left;
            /* Căn trái */
            width: 50%;
            /* Chiếm 50% chiều rộng */
        }

        .column {
            flex: 1;
            /* Mỗi cột chiếm không gian đều nhau */
        }

        .message p {
            text-align: justify;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 20px;
        }


        .highlight1 {
            color: #BD37E5;
            /* Màu đỏ để làm nổi bật các bước */
            font-weight: bold;
        }

        .highlight2 {
            color: #FC549B;
            /* Màu đỏ để làm nổi bật các bước */
            font-weight: bold;
        }

        .highlight3 {
            color: #4834C3;
            /* Màu đỏ để làm nổi bật các bước */
            font-weight: bold;
        }

        .content {
            width: 60%;
            margin: 30px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .welcome-text h2 {
            font-size: 40px;
            font-weight: bold;
            line-height: 1.2;
            font-family: 'Dancing Script';
        }

        .welcome-text p {
            margin: 10px 0;
            font-size: 18px;
            font-family: 'true typewriter';
        }

        .welcome-text .start-btn {
            margin-top: 10px;
            font-family: 'true typewriter';
        }

        .welcome-image img {
            max-width: 400px;
            border-radius: 20px;
        }

        .tamtu p {
            font-size: 18px;
            align-content: justify;
            margin-bottom: 0;
        }

        hr {
            margin: 20px auto;
            width: 80%;
            border-top: 2px solid #8B3DFF;
        }
    </style>
    <section class="content">
        <div class="welcome-text">
            <h2><b> Giới thiệu về </b><br><b>"Bút Chì Thấu Cảm"</b> </h2>
            <p>Chì vẽ hạnh phúc - Dẫn lối yêu thương</p>
        </div>
        <div class="welcome-image">
            <img src="{{ asset('client/image/yeuthuong.png') }}" alt="Bút Chì Thấu Cảm">
        </div>
    </section>
    <div class="container">
        <!-- Phần đầu -->
        <div class="header">
            <p>Bút Chì Thấu Cảm - cầu nối để giúp các gia đình <br>
                diễn đạt tình yêu thương theo một cách rất riêng <br>
                - tôn trọng, tin tưởng, hạnh phúc.</p>
        </div>

        <!-- Phần thông điệp -->
        <div class="message">
            <h2>Thông điệp</h2>
            <div class="message-content">
                <div class="column">
                    <p style="font-size: 18px;">
                        “Bút chì” - cây bút đầu tiên bắt đầu cho mọi nét chữ của con. Và gia đình luôn là nơi quan trọng,
                        nền tảng cho sự trưởng thành.
                        Trong hành trình lớn khôn ấy, “Bút chì con cái” luôn phải tự gọt giũa mình để thoát khỏi thân phận
                        đứa trẻ nhưng vẫn cân bằng mối quan hệ với cha mẹ.
                        Nhiều nghiên cứu cho thấy vị thành niên chưa phát triển hoàn thiện các chức năng điều hành (theo
                        E.Jensen và Nutt) nên rất cần sự dẫn dắt, hỗ trợ và chấp nhận từ phía “Bút chì cha mẹ”.
                    </p>
                </div>
                <div class="column">
                    <p style="font-size: 18px;">
                        “Bút Chì Thấu Cảm” mong muốn hướng tới việc xây dựng cầu nối đúng đắn, khoa học giữa cha mẹ và con
                        cái - nơi tình yêu thương và sự thấu cảm có thể giúp cha mẹ trở thành người bạn đồng hành,
                        dẫn dắt con em mình trong giai đoạn chuyển tiếp đầy thách thức của lứa tuổi vị thành niên.
                    </p>
                </div>
            </div>
        </div>

        <!-- Dòng kẻ ngang phân cách -->
        <hr>
        <div style="display:flex; flex-direction: row; width: 100%">
            <div class="left-column" style="display:flex; flex-direction: column; width: 80%; margin: auto">
                <h1 style="font-weight: bolder; font-family: Dancing Script">Hướng dẫn sử dụng</h1>
                <h2><i style="font-weight: bolder; color: #4834C3; font-family: Dancing Script">“Vẽ tâm tư”</i></h2>
                <div style="width: 80%" class="tamtu">
                    <div>
                        <p><span class="highlight1"><i>Bước 1:</i></span> Chọn một cảm xúc chủ đạo trong ngày.</p>
                        <p><span class="highlight1"><i>Bước 2:</i></span> Đánh giá mức độ của cảm xúc đó bằng cách ấn vào
                            thang đo bên cạnh thân bút chì.</p>
                        <p><span class="highlight1"><i>Bước 3:</i></span> Chia sẻ thêm về cảm xúc ngày hôm nay thông qua
                            phần giấy ghi chú. (Điều gì/việc gì đã mang đến cảm xúc đó? Bạn xử lý cảm xúc đó như thế
                            nào?...)</p>
                        <p><span class="highlight1"><i>Bước 4:</i></span> Nhấn nút gửi để cảm xúc được hiển thị cho các
                            thành viên khác trong phòng, và sẽ được lưu trữ tại phần “biểu đồ cảm xúc”.</p>
                        <hr>
                    </div>
                    <div>
                        <p>Mỗi tuần sẽ có một phần đánh giá để “Bút Chì Thấu Cảm” có thể khảo sát ý kiến người dùng về hoạt
                            động này.</p>
                        <br>


                        <p><span class="highlight2"><i>Bước 1:</i></span> Đánh giá mức độ hiệu quả của hoạt động này bằng
                            cách nhấn vào con số từ 0-10 dưới thân bút chì.</p>
                        <p><span class="highlight2"><i>Bước 2:</i></span> Chia sẻ thêm suy nghĩ/trải nghiệm thông qua phần
                            câu hỏi trên giấy ghi chú bên dưới.</p>
                        <p><span class="highlight2"><i>Bước 3:</i></span> Nhấn nút gửi để hoàn thành.</p>
                    </div>
                </div>


            </div>
            <div class="right-column">
                <img src="{{ asset('client/image/trang.png') }}" alt="Illustration"
                    style="height: 300px; weight: 300px; margin-top: 200px">
            </div>
        </div>
        <hr>
        <div style="display:flex; flex-direction: row; width: 100%; margin-top: 10px">
            <div class="left-column" style="display:flex; flex-direction: column; width: 80%; margin: auto">
                <h2><i style="font-weight: bolder; color: #F39816; font-family: Dancing Script">“Màu yêu thương”</i></h2>
                <div style="width: 80%" class="tamtu">
                    <div>
                        <p><span class="highlight3"><i>Bước 1:</i></span> Chọn một cảm xúc chủ đạo trong ngày.</p>
                        <p><span class="highlight3"><i>Bước 2:</i></span> Đánh giá mức độ của cảm xúc đó bằng cách ấn vào
                            thang đo bên cạnh thân bút chì.</p>
                        <p><span class="highlight3"><i>Bước 3:</i></span> Chia sẻ thêm về cảm xúc ngày hôm nay thông qua
                            phần giấy ghi chú. (Điều gì/việc gì đã mang đến cảm xúc đó? Bạn xử lý cảm xúc đó như thế
                            nào?...)</p>
                        <p><span class="highlight3"><i>Bước 4:</i></span> Nhấn nút gửi để cảm xúc được hiển thị cho các
                            thành viên khác trong phòng, và sẽ được lưu trữ tại phần “biểu đồ cảm xúc”.</p>
                    </div>

                </div>


            </div>
            <div class="right-column">
                <img src="{{ asset('client/image/yeuthuong.png') }}" alt="Illustration"
                    style="height: 300px; weight: 300px">
            </div>
        </div>
        <!-- Phần hướng dẫn sử dụng -->







    </div>
@endsection
