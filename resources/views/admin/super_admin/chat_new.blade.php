@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
@php $id = request()->route('id'); @endphp
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
            <div class="col-md-4">
                <div class="user-wrapper admin-user-wrapper-left">
                    <ul class="users" id="users_list_box">
                        @if(isset($users_list) && !empty($users_list))
                          {!! $users_list !!}
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-8 chat_feature">
              @if(isset($id) && !empty($id))
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
                      <input type="hidden" name="user_id" value="{{$id}}">
                      <div class="msg_file">
                        <input type='file' name="chat_image"><span class='button'>Choose</span>
                      </div>
                      <div class="type_message">
                        <input id="message_input_box" type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" name="message">
                      </div>
                      <div class="send_btn">
                        <button id="button-addon2" type="submit" class="btn btn-link"><i class="fa fa-paper-plane"></i></button>
                      </div>
                   </form>
               </div>
              <script type="text/javascript">
                  setInterval(refreshMessages, 3000);
                  function refreshMessages(){
                      $.ajax({
                          type: 'GET',
                          url: '{{ route('load_ajex_data', $id) }}',
                          success: function(data) {
                            $('#users_list_box').empty();
                            $("#users_list_box").html(data['users_list']);
                            $('#messagebox').empty();
                            $("#messagebox").html(data['user_chat']);
                            $('#total_unread_count').text(data['total_count']);
                          },
                          error: function() { 
                            get_latest_chat();
                          }
                      });
                  }

                </script>
                @else
                <script type="text/javascript">
                  var my_intervel = setInterval(get_latest_chat, 5000);
                  function get_latest_chat(){
                    $.ajax({
                        type: 'GET',
                        url: '{{route('load_ajex_data')}}',
                        success: function(data) {
                            $('#users_list_box').empty();
                            $("#users_list_box").html(data['users_list']);
                            $('#total_unread_count').text(data['total_count']);
                        },
                        error: function() { 
                          $('#users_list_box').prepend('No Customers.'); 
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
@include('admin.super_admin.partials.footer')
<script type="text/javascript">
    $(document).ready(function (e){
        $("#scroll_bottom").animate({scrollTop: $('#scroll_bottom').prop("scrollHeight")}, 1000);
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $('#message_target').submit(function(e)
        {
          e.preventDefault();
          var formData = new FormData(this);
          $("#message_input_box").val('');
          $.ajax({
              type: 'POST',
              url: "{{ route('send_message') }}",
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: (data) => {
                  this.reset();
                  $('#messagebox').empty();
                  $("#messagebox").html(data);
                  $("#scroll_bottom").animate({scrollTop: $('#scroll_bottom').prop("scrollHeight")}, 1000);
              },
              error: function() { 
                 get_latest_chat(); 
              }
          });
      });
  });
</script>
