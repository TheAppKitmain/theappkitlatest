@component('mail::message')
@php 

@endphp
Hello {{$order->app_user->name}},

@component('mail::panel')
<p>Thank you for your purchase.</p>
<p>Your order no is <strong>{{$order->order_number}}</strong></p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
