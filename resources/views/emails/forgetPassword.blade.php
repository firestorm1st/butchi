@component('mail::message')
    
Xin chào,{{$user->name}}. Bạn quên mật khẩu?

<p>Vui lòng làm theo hướng dẫn</p>

@component('mail::button',['url'=>url('resetPassword/'.$user->remember_token)])
Kích hoạt lại mật khẩu của bằng link sau:
@endcomponent

Cảm ơn, <br>
{{config('app.name')}}
@endcomponent