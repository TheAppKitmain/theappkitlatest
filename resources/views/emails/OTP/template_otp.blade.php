@component('mail::message')
Hi 

Your OTP is {{$otp->code}} and valid for only 2 mintues.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
