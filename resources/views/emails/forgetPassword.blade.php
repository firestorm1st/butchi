@component('mail::message')
    Xin chào,{{ $user->name }}. Bạn quên mật khẩu sao?

    <p>Nếu chuyện đó xảy ra.</p>

    @component('mail::button', ['url' => url('resetPassword/' . $user->remember_token)])
        Đặt lại mật khẩu
    @endcomponent

    Chúng tôi xin cảm ơn, <br>
    {{ config('app.name') }}
@endcomponent
