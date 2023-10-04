<div class="message-wrapper-main">
<div class="message-wrapper">
    <ul class="messages">
        @foreach($messages as $message)
            <li class="message clearfix">
                {{--if message from id is equal to auth id then it is sent by logged in user --}}
                <div class="messagemain">
                <div class="{{ ($message->from == Auth::id()) ? 'sent' : 'received' }}">
                   <p class="chat-message-box">{!! nl2br($message->message) !!}</p>
                    <p class="date">
                     @php
                     $date = $message->created_at->setTimezone(new \DateTimeZone($timezone));
                     @endphp
                     {{$date->format('g:i a')}}
                     </p>
                </div>

                </div>
            </li>
        @endforeach
    </ul>
</div>
</div>



