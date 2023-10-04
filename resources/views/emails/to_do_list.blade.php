@component('mail::message')
@php 

@endphp
Hello {{$bugstatus['business_name']}},

@component('mail::panel')
<p><strong>{!! $bugstatus['message'] !!}</strong></p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent