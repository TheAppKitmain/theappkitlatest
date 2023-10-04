@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<style type="text/css">
::-webkit-scrollbar{width:5px}::-webkit-scrollbar-track{width:5px;background:#f5f5f5}::-webkit-scrollbar-thumb{width:1em;background-color:#ddd;outline:1px solid #708090;border-radius:1rem}.text-small{font-size:.9rem}.chat-box,.messages-box{height:510px;overflow-y:scroll}.rounded-lg{border-radius:.5rem}input::placeholder{font-size:.9rem;color:#999}.bg-gray.px-4.py-2.bg-light.rightname{background:#6a59f8!important;color:#fff}.list-group.rounded-0 .d-flex.align-items-center.justify-content-between.mb-1{margin-top:16px}.bg-primary.rounded.py-2.px-3.mb-2{background:#4096ee;background:-moz-linear-gradient(left,#4096ee 0,#6c2487 100%);background:-webkit-linear-gradient(left,#4096ee 0,#6c2487 100%);background:linear-gradient(to right,#4096ee 0,#6c2487 100%)}.list-group-item-light.list-group-item-action.active{color:#fff;background-color:#818182;border-color:#818182;background:#4096ee;background:-moz-linear-gradient(left,#4096ee 0,#6c2487 100%);background:-webkit-linear-gradient(left,#4096ee 0,#6c2487 100%);background:linear-gradient(to right,#4096ee 0,#6c2487 100%)}.messages-box{height:558px}button#button-addon2 i.fa.fa-paper-plane{font-size:24px}.messages-box::-webkit-scrollbar{width:2px}.messages-box::-webkit-scrollbar-track{background:#fff}.messages-box::-webkit-scrollbar-thumb{background:#6a59f8}.file-input input{color:transparent}.file-input input::-webkit-file-upload-button{visibility:hidden}.file-input input::before{content:'Select image';color:#fff;display:inline-block;background:-webkit-linear-gradient(top,#031c5f,#68789f);border:1px solid #999;border-radius:3px;padding:5px 8px;outline:0;white-space:nowrap;-webkit-user-select:none;cursor:pointer;font-weight:700;font-size:10pt}.file-input span{display:none}.file-input input:hover::before{border-color:#000}.file-input input:active{outline:0}.file-input input:active::before{background:-webkit-linear-gradient(top,#e3e3e3,#f9f9f9)}.file-input input{color:transparent;width:129px;margin-top:8px}img.rounded-circle{width:50px;height:50px}span.count_message{color:#fff;border:1px solid #415688;background:#415688;padding:5px;border-radius:50%}
</style>
@php $id = request()->route('id'); @endphp
<div class="container">
  <div class="row rounded-lg overflow-hidden shadow">
    <div class="col-5 px-0">
      <div class="bg-white">
        <div class="bg-gray px-4 py-2 bg-light"><p class="h5 mb-0 py-1">Customers</p></div>
        <div class="messages-box">
          <div id="users_list_box" class="list-group rounded-0">
            @if(isset($users_list) && !empty($users_list))
              {!! $users_list !!}
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- Chat Box-->
    @if(isset($id) && !empty($id))
    <div class="col-7 px-0">
        <div class="bg-gray px-4 py-2 bg-light rightname"><p class="h5 mb-0 py-1">Send Message</p></div>
        <div id="messagebox" class="px-4 py-5 chat-box bg-white">
          @if(isset($user_chat) && !empty($user_chat))
              {!! $user_chat !!}
          @endif
        </div>
        <form id="message_target" class="bg-light" method="post" enctype="multipart/form-data">
        @csrf
         <input type="hidden" name="user_id" value="{{$id}}">
         <div class="input-group">
          <div class='file-input'><input type='file' name="chat_image"><span class='button'>Choose</span></div>
          <input id="message_input_box" type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" name="message">
          <div class="input-group-append">
            <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript">
        setInterval(refreshMessages, 3000);
        function refreshMessages(){
           if (typeof my_intervel !== 'undefined') { 
              clearInterval(my_intervel); 
              my_intervel = undefined;
            } 
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
<script type="text/javascript">
    $(document).ready(function (e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#message_target').submit(function(e) {
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
                    $("#messagebox").animate({scrollTop: $('#messagebox').prop("scrollHeight")}, 1000);
                },
                error: function() { 
                   get_latest_chat(); 
                }
            });
        });
  });
</script>
@include('admin.super_admin.partials.footer')
