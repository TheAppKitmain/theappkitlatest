@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<style type="text/css">
img.chat_img {
    width: 220px;
    margin: 0 auto;
    display: block;
}
</style>
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
                            <li class="user" id="{{ $pm->id }}">
                                <span class="pending" id="custom_unread_count">{{$unread_count}}</span>
                                <div class="media">
                                    <div class="media-left">
                                      <span>
                                        <p class="username-fl media-object">{{ $pm->first_name[0] }}</p>
                                      </span>
                                    </div>
                                    <div class="media-body">
                                        <p class="name">{{ $pm->first_name }}</p>
                                        <p class="email">{{ $pm->email }}</p>
                                    </div>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
            @endif
            <div class="col-md-12 chat_feature">
                <div class="user-chat-right">
                @if($assigned > 0)
                    <div class="message-wrapper-main">
                        <div class="message-wrapper" id="scroll_bottom">
                            <ul class="messages" id="messagebox">
                              @if(isset($user_chat) && !empty($user_chat))
                                  {!! $user_chat !!}
                              @endif
                            </ul>
                        </div>
                        <form id="message_target" class="bg-light" method="post" enctype="multipart/form-data">
                        @csrf
                          <div class="msg_file">
                            <input type='file' name="chat_image"><span class='button'>Choose</span>
                          </div>
                          <div class="type_message">
                            <input id="message_input_box" type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" name="message">
                          </div>
                          <div class="send_btn">
                            <button id="button-addon2" type="submit" class="btn btn-link">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                          </div>
                       </form>
                    </div>
                    <script type="text/javascript">
                        setInterval(refreshMessages, 3000);
                        function refreshMessages(){
                          $.ajax({
                              type: 'GET',
                              url: "{{ URL::to('app/user_all_messages',[$user_id,$pm_id]) }}",
                              success: function(data) {
                                  $('#messagebox').empty();
                                  $("#messagebox").html(data['user_chat']);
                                  $('#custom_unread_count').text(data['total_count']);
                                  $('#total_unread_count_c').text(data['total_count']);
                              },
                              error: function() { 
                                $('#messagebox').empty();
                                $("#messagebox").html('<div class="w-100 main-chatbox"><div class="media-body" style="margin-left: auto;width: 100%!important;margin-right: auto;text-align: center;"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white"><strong>No messages</strong></p></div></div></div>');
                              }
                          });
                        }
                    </script>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('admin.custom.partials.footer')
<script type="text/javascript">
    $(document).ready(function (e)
    {
        $("#scroll_bottom").animate({scrollTop: $('#scroll_bottom').prop("scrollHeight")}, 1000);
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('#message_target').submit(function(e)
        {
          e.preventDefault();
          var formData = new FormData(this);
          $("#message_input_box").val('');
          $.ajax({
              type: 'POST',
              url: "{{ URL::to('app/send_message_user') }}",
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: (data) => {
                  this.reset();
                  $('#messagebox').empty();
                  $("#messagebox").html(data['user_chat']);
                  $('#custom_unread_count').text(data['total_count']);
                  $('#total_unread_count_c').text(data['total_count']);
                  $("#scroll_bottom").animate({scrollTop: $('#scroll_bottom').prop("scrollHeight")}, 1000);
              },
              error: function() { 
                  $('#messagebox').empty();
                  $("#messagebox").html('<div class="w-100 main-chatbox"><div class="media-body" style="margin-left: auto;width: 100%!important;margin-right: auto;text-align: center;"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white"><strong>No messages</strong></p></div></div></div>');
              }
          });
      });
  });
</script>



