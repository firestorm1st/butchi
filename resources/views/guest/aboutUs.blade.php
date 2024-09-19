@extends('master')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #fffaed;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
        }

        .image-section img {
            width: 350px;
            height: auto;
            border-radius: 15px;
        }

        .text-section {
            max-width: 500px;
        }

        .text-section h1 {
            font-family: 'Dancing Script';
            font-size: 36px;
            font-weight: bold;
        }

        .text-section p {
            font-family: 'true typewriter';
            margin-top: 20px;
            font-size: 18px;
            color: gray;
        }

        /* Bottom Section */
        .quote-section {
            background-color: #f1f1f1;
            padding: 30px;
            text-align: center;
            margin: 50px 0;
            border-radius: 10px;
        }

        .quote-section blockquote {
            font-size: 24px;
            font-style: italic;
            margin-bottom: 20px;
        }

        .quote-section .source {
            font-size: 16px;
            color: gray;
        }

        .message-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .message-section h2 {
            font-size: 36px;
        }

        .columns {
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .column {
            flex-basis: 30%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .column h3 {
            font-family: 'Dancing Script';
            font-size: 24px;
            margin-bottom: 20px;
        }


        .custom-text {
            font-family: 'true typewriter';
            font-size: 16px;
            font-style: italic;
            margin-top: 10px;
            color: gray;
        }
    </style>
    <!-- Top Section -->
    <div class="container">
        <!-- Left Section: Image -->
        <div class="image-section">
            <img src="{{ asset('client/image/yeuthuong.png') }}" alt="Bút Chì Thấu Cảm Image" style="width: 300px;height:auto">
        </div>

        <!-- Right Section: Text and Button -->
        <div class="text-section">
            <h1>Giới thiệu về<br> “Bút Chì Thấu Cảm”</h1>
            <p>Chì vẽ hạnh phúc - Dẫn lối yêu thương</p>
        </div>
    </div>

    <!-- Separator -->
    <hr>

    <!-- Bottom Section -->
    <div class="quote-section">
        <blockquote>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore, vero nobis?"</blockquote>
        <p class="source">Nguồn gốc: “Bút Chì Thấu Cảm”</p>
    </div>

    <!-- Columns Section -->
    <div class="columns">
        <!-- Column 1 -->
        <div class="column">
            <h3>Why?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est dolorem tempore odio!</p>
        </div>

        <!-- Column 2 -->
        <div class="column">
            <h3>How?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est dolorem tempore odio!</p>
        </div>

        <!-- Column 3 -->
        <div class="column">
            <h3>What?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est dolorem tempore odio!</p>
        </div>
    </div>
@endsection
