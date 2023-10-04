@component('mail::message')

<p>Hello <b>{{$bugstatus['business_name']}}</b></p>

<p style="color:#718096;">Please check the build below. Once happy, you can verify and save from the admin panel which will automatically be sent to the client</p>

@if(!is_null($bugstatus['iosbuild']))
<p style="color:#718096; margin-bottom:5px; font-size: 15px;"><b style="color:#718096;">iOS Build</b> : {{$bugstatus['iosbuild']}}</p>
@endif
@if(!is_null($bugstatus['androidbuild'])) 
<p style="color:#718096; font-size: 15px;"><b style="color:#718096;">Android Build</b> : {{$bugstatus['androidbuild']}}</p>
@endif

<p style="color:#718096;"><b style="color:#718096;">Note</b> - Please delete any previous builds or any downloaded Apps from the live store before downloading this new build.</p>

Many Thanks<br>
{{ config('app.name') }}
@endcomponent
