@component('mail::message')

Hey {{$dataList['business_name']}},

It was great speaking with you regarding your App idea.

Please follow the link below for your quote. We have taken into consideration the timeframes of development and payment method as discussed.

<a class="btn btn-primary" href="{{asset($dataList['quote_doc'])}}" download>View my quote</a>

Next steps if you are happy to proceed would be to get our agreement signed. Please respond to the email to confirm you are happy to review the agreement. 

Any questions we'll be happy to assist.

Many Thanks<br>
The App Kit
@endcomponent