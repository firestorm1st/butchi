@extends('admin.master')

@section('module', 'admin')
@section('action', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- Visit 'codeastro' for more projects -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('guest.index') }}">
                <h1 class="h3 mb-0 text-gray-800" style="font-family: 'Dancing Script';">Trang chủ</h1>
            </a>
        </div>
        <p style="font-family:'true typewriter';font-size:30px">Chào mừng bạn đến với Admin Dashboard</p>
@endsection
