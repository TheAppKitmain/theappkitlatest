
<h2>The App Kit</h2>

<h2>Failed Maintenance payment</h2>

<p> We were unable to process your direct debit payment for {{ $dataList['business_name'] }} maintainance plan. </p><br>
<h2>Your card transaction failed while attempting to process the payment of</h2>

@if($dataList['country'] == 'United Kingdom')
<p>  £150 - Monthly plan </p>
@else
<p>  $150 - Monthly plan </p>
@endif

<p>If you do not settle this invoice within 7 days your account may be suspended from our sever affecting the running of your App.</p> 
<p>Please contact us immediately if you have any questions or concerns regarding this notice.</p> 

<br>Many Thanks<br>
<h2>The App Kit</h2>
