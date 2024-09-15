@extends('master')
@section('content')  
    <div class="container">
        <div class="content-wrapper">
            <div class="contact-info">
                <h2>Bức thư trao đi</h2>
                <p>&nbsp;&nbsp;&nbsp;Nếu có bất kỳ thắc mắc hay nguyện vọng nào, bạn có thể gửi đến “Bút Chì Thầu Cảm” ngay tại đây.</br>&nbsp;&nbsp;&nbsp;Chúng mình vô cùng cảm kích và biết ơn với sự đóng góp của bạn.</p>
            </div>
            <form action="/submit" method="POST" class="contact-form">
                <div class="form-group">
                    <label style="color: red" for="name">Họ và tên</label>
                    <input type="text" id="name" name="name" placeholder="Xin nhập tên..." required>
                </div>
                <div class="form-group">
                    <label style="color: red" for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="hello@example.com" required>
                </div>
                <div class="form-group">
                    <label style="color: red" for="message">Nhắn gửi:</label>
                    <textarea id="message" name="message" placeholder="Nhập vào đây..." required></textarea>
                </div>
                <button type="submit" class="submit-btn">Gửi</button>
            </form>
        </div>
    </div>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-image: url("{{ asset('client/image/bg.png') }}"); /* Path to your image */
            background-size:1560px; /* Ensures the image covers the entire section */
            background-position:center; /* Center the image */
            background-repeat: no-repeat;
}

.container {
    max-width: 1000px;
    margin: 0px auto;
    padding: 20px;
    text-align: center;
}

.content-wrapper {
    display: flex;
    justify-content: center;
    align-items: stretch;
    gap: 50px;
    text-align: left; /* Ensures left alignment inside content sections */
}

.contact-info {
    background: white;
    background-size: contain;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    width: 45%;
}

.contact-info h2 {
    font-family:'Dancing Script';
    margin-top: 125px;
    font-size: 45px;
    margin-bottom: 10px;
    font-size: bold;
}

.contact-info p {
    font-family: 'true typewriter';
    font-size: 20px;
    margin-bottom: 10px;

}

.contact-form {
    width: 45%;
    display: flex;
    flex-direction: column;
    gap: 15px;
    text-align: left; /* Aligns form labels and inputs left */
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-family:'Dancing Script';
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 16px;
}

.form-group input,
.form-group select,
.form-group textarea {
    font-family: 'true typewriter';
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

textarea {
    height: 100px;
    resize: none;
}

.submit-btn {
    background-color: black;
    color: white;
    padding: 10px 20px;
    font-size: 1.2rem;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    width: 100px;
    margin: 0 0;
}

.submit-btn:hover {
    background-color: #555;
}
</style>
@endsection
