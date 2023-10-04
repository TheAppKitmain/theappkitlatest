@component('mail::message')
Hi,

Sorry, we can't deliver to this area {{$send_mail->postcode}}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
