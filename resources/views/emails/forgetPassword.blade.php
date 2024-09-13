@component('mail::message')
    
Hi,{{$user->name}}. Forgot Password?

<p>It happens.</p>

@component('mail::button',['url'=>url('resetPassword/'.$user->remember_token)])
Reset Your Password
@endcomponent

Thanks, <br>
{{config('app.name')}}
@endcomponent