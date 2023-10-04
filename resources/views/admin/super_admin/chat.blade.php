@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container chatsty">


    
       

      <div class="container-fluid">
        <div class="row">
            @if($assigned == 0)
                 <h2>No User Found.</h2>
            @else
            <div class="col-md-4">
                <div class="user-wrapper admin-user-wrapper-left">
                    <ul class="users">
                        @foreach($users as $user)
                            <li class="user" id="{{ $user->id }}">
                                {{--will show unread count notification--}}
                                @php
                                 $messages_count = App\Message::where('to',$super_id)->where('from',$user->id)->where('is_read',0)->count();
                                @endphp
                                @if($messages_count)
                                    <span class="pending">{{ $messages_count }}</span>
                                @endif
                                <div class="media">
                                    <div class="media-left">
                                      <span>
                                        <p class="username-fl media-object">{{ $user->first_name[0] }}</p>
                                    </span>
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $user->business_name }} <!-- {{$user->last_name}} --></p>
                                        <!-- <p class="email">{{ $user->email }}</p> -->
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <div class="col-md-8 chat_feature">
            <div id="messages">
            </div>
            @if($assigned > 0)
            <div class="input-text">
               <!--  <i class="fa fa-paper-plane sendbtn-message" aria-hidden="true"></i> -->
                <!-- <input type="text" name="message" class="submit" placeholder="Please Enter to Send Message"> -->
                <textarea name="message" class="submit submitmsgchat" placeholder="Please Enter to Send Message"></textarea>
                </div>
            </div>
            @endif

        </div>
    </div>
        
         



</div>
</div>

@include('admin.super_admin.partials.footer')
<script>
$(document).ready(function() {
    var assigned = '<?php echo $assigned; ?>';
    if(assigned > 0){
     receiver_id = $("ul.users li:first").attr("id");
        $("ul.users li:first").addClass('active');
        $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    }
                });
    }
});
</script>


