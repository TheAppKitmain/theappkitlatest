@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container chatsty">


    
       

      <div class="container-fluid">
        <div class="row">
                @if($assigned == 0)
                 <h2>No Project Manager is Assigned yet.</h2>
                @else
                <div class="col-md-12">
                 <div class="user-wrapper userwrapperchat-left">
                    <ul class="users userchatul">
                            <li class="user" id="{{ $user->id }}">
                                {{--will show unread count notification--}}
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
                                        <p class="name">{{ $user->first_name }}</p>
                                        <p class="email">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </li>
                    </ul>
                </div>
                </div>
                @endif

            <div class="col-md-12 chat_feature">
            <div class="user-chat-right" id="messages"></div>
            @if($assigned > 0)
            <div class="input-text">
               <!--  <i class="fa fa-paper-plane sendbtn-message" aria-hidden="true"></i> -->
                <!-- <input type="file" name="file" id="file" /> -->
                <!-- <input type="text" name="message" class="submit" placeholder="Please Enter to Send Message"> -->
                <textarea name="message" class="submit submitmsgchat" placeholder="Please Enter to Send Message"></textarea>
            </div>
            @endif
            </div>
        </div>
    </div>
</div>
</div>

@include('admin.custom.partials.footer')
<script>
$(document).ready(function() {
      $('.user').click();
});
</script>



