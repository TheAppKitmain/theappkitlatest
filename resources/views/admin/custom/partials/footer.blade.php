
<!-- footer start-->
<footer></footer>
<!-- footer end -->

<script src="https://code.jquery.com/jquery-1.12.4.min.js"
integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
crossorigin="anonymous"></script>

<script src="{{ asset('asset/js/custom.js') }}"></script>
<script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
<script src="{{asset('template/js/custom.js')}}"></script>
<script src="{{ asset('asset/js/jquery.ccpicker.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js" integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.js" integrity="sha512-D8ZYpkcpCShIdi/rxpVjyKIo4+cos46+lUaPOn2RXe8Wl5geuxwmFoP+0Aj6wiZghAphh4LNxnPDiW4B802rjQ==" crossorigin="anonymous"></script>
<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.1.3/circle-progress.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="{{ asset('js/countrySelect.js') }}"></script>
<script src="{{ asset('js/jquery.ccpicker.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script>

function launch_worldwide() {

$(".store_app_country").css("display", "none");
document.getElementById("country_selector").value = "worldwide";
}

function select_country() {
$(".store_app_country").css("display", "block");
}

$('#all_users').dataTable({
        'language': {
            'searchPlaceholder': 'Search by name, business name, email, number...'
        },
        'ordering': false
    });

jQuery(function ($)
 {

    $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});
   
   
});
	</script>
  
<script>

  

$("#piece").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
$("#country_select").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})

    function delete_pm(url) {
        console.log(url)
        $('body').find("#deleteProductForm").attr('action', url);
        $('body').find('#myProductModal').modal('show');
    }



$( document ).ready(function() {
//$("#phoneField").CcPicker();
$("#country_selector").countrySelect();
});
</script>
<script>
$(document).ready(function() {
$('#example').DataTable();
} );
</script>
<script>
$(function() {
$("form[name='registration']").validate({
// Specify validation rules
rules: {
app_name: "required",
app_idea: "required",
domian_details: "required",

domain_email: {
required: true,
email: true
},
domain_password: {
required: true,
minlength: 8
}
},
// Specify validation error messages
messages: {
app_name: "Please enter your app name",
design_details: "Please enter your design details",
app_idea: "Please enter your app idea",
domian_details: "Please enter your domain details",
domain_password: {
required: "Please provide a password",
minlength: "Your password must be at least 8 characters long"
},
domain_email: "Please enter a valid email address"
},
submitHandler: function(form) {
form.submit();
}
});
});
</script>
<!--Validation End-->

<script>
$(function () {
  var bug_image = 1;
  $("#btnAdd").bind("click", function () {
   var html = '<div class="col-md-4"><div class="form-group bug-container"><i class="fa fa-trash-o deletei" aria-hidden="true" ></i><input type="hidden" class="form-control" name="bugby" value="client"><label for="">Bug Type</label><select name="bug_type[]" id="bugtype" class="form-control"><option value="Functional (Something not working)">Functional (Something not working)</option><option value="Functional (Something missing)">Functional (Something missing)</option><option value="User Interface (e.g. text, colours, element positioning etc.)">User Interface (e.g. text, colours, element positioning etc.)</option><option value="Other">Other</option></select><label for="exampleInputEmail1">Bug Description</label><textarea name="bug_description[]" class="form-control"  placeholder="Explain Bug" value="" required></textarea><label for="exampleInputEmail1">Bug Screenshot</label><input type="file" name="bug_screenshot['+bug_image+'][]" multiple class="form-control"><div class="form-group"><label for="exampleFormControlSelect1">Bug For</label><select class="form-control" id="bug_device" name="bug_device[]"><option>Android</option><option>IOS</option><option>Both</option></select></div><div class="form-group"><label for="exampleFormControlSelect1">Bug Priority</label><select class="form-control" id="bug_priority" name="bug_priority[]"><option>Low</option><option>Medium</option><option>High</option></select></div></div></div>';
    $("#bugs").append(html);
    bug_image++;
  });

  $("body").on("click", ".deletei", function () {
    $(this).parent().parent().remove();
  });
});
</script>


<script>
  $(function () {
    $("#btnAddud").bind("click", function () {
      var div = $("<div class='col-md-4'></div>");
      div.html(GetDynamicTextBoxud(""));
      $("#bugsud").append(div);
    });
    $("body").on("click", ".deletei", function () {
       $(this).parent().parent().remove();
    });
});
function GetDynamicTextBoxud(value) {
  return '<div class="form-group bug-container"><i class="fa fa-trash-o deletei" aria-hidden="true" ></i><label for="">Please paste your UDID number below </label><input type="hidden" name="main_id[]" value="0"><input type="text" id="udid" name="udid[]" class="form-control" placeholder="UDID" required><label for="">Add Screenshot</label><input type="file" name="add_screenshot[]" class="form-control"></div>'
  }
</script>

<script>
$(document).ready(function(){
  $("#name").keyup
  (function (e) {
  var value = this.value;
  $("#app_name").html(value);
});

$("#description").keyup
(function (e) {

var value = this.value;
$("#app_idea").html(value);

});

$("#image").change(function (e) {
url = URL.createObjectURL(e.target.files[0]),
$("#preview").attr("src",url);
console.log(url);

});

});
</script>

<script>
$(document).ready(function () {
$('#myform').validate({ // initialize the plugin
rules: {
name: {
required: true,
},
},
submitHandler: function (form) { // for demo

return false; // for demo
}
});
});
</script>
<script>
jQuery(function ($) {
$(".sidebar-dropdown > a").click(function() {
$(".sidebar-submenu").slideUp(200);
if (
$(this)
.parent()
.hasClass("active")
) {
$(".sidebar-dropdown").removeClass("active");
$(this)
.parent()
.removeClass("active");
} else {
$(".sidebar-dropdown").removeClass("active");
$(this)
.next(".sidebar-submenu")
.slideDown(200);
$(this)
.parent()
.addClass("active");
}
});
});
</script>

<script>
    var statuscode = '{{session('schedulecode')}}';
    if(statuscode == 'schedule'){
      swal({
        title: '{{session('status')}}',
        icon: '{{session('statuscode')}}',
        button: "Schedule",
    }).then(function() {
        window.location = "{{ URL::to('schedulechat') }}";
    });
    }else{
      @if(session('status'))
        swal({
        title: '{{session('status')}}',
        icon: '{{session('statuscode')}}',
        button: "OK",
        });
      @endif
    }
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script>
/*side menu */
$('body').addClass ('open');
$(document).ready(function(){
$('.closeside').on('click', function(){
$('body').removeClass ('open');
});
});
</script>
<script>
$(document).ready(function(){
$(document).on('click', '.temp_popup', function () {
swal("Template", "Template Coming Soon");
});

$(document).on('click', '.ourworkul li a', function () {
console.log($(this));
$('.active').removeClass('active');
$(this).parent().addClass('active');
});
});
</script>
<script>
var receiver_id = '';
var my_id = "{{ Auth::id() }}";
$(document).ready(function () {
// ajax setup form csrf token
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('a70d53fd5d8a9b86aead', {
cluster: 'ap2',
forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function (data) {
//console.log(data);
//alert(JSON.stringify(data));
if (my_id == data.from) {
$('#' + data.to).click();
} else if (my_id == data.to) {
if (receiver_id == data.from) {
// if receiver is selected, reload the selected user ...
$('#' + data.from).click();
} else {
// if receiver is not seleted, add notification for that user
var pending = parseInt($('#' + data.from).find('.pending').html());

if (pending) {
$('#' + data.from).find('.pending').html(pending + 1);
} else {
$('#' + data.from).append('<span class="pending">1</span>');
}
}
}
});

$('.user').click(function () {
$('.user').removeClass('active');
$(this).addClass('active');
$(this).find('.pending').remove();

receiver_id = $(this).attr('id');
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
});

$('textarea.submitmsgchat').keyup(function (event) {
          var message = $(this).val();
       if (event.keyCode == 13 && event.shiftKey) {
           var content = this.value;
           var caret = getCaret(this);
           this.value = content.substring(0,caret)+"\n"+content.substring(carent,content.length-1);
           event.stopPropagation();
           
      }else if (event.keyCode == 13 && message != '' && receiver_id != '') {
$(this).val(''); // while pressed enter text box will be empty

var datastr = "receiver_id=" + receiver_id + "&message=" + message;
$.ajax({
type: "post",
url: "message", // need to create this post route
data: datastr,
cache: false,
success: function (data) {
//$('.user').click();
// scrollToBottomFunc();
//console.log(data)
},
error: function (jqXHR, status, err) {
},
complete: function () {
scrollToBottomFunc();
}
})
}
});
function getCaret(el) { 
  if (el.selectionStart) { 
    return el.selectionStart; 
  } else if (document.selection) { 
    el.focus(); 

    var r = document.selection.createRange(); 
    if (r == null) { 
      return 0; 
    } 

    var re = el.createTextRange(), 
        rc = re.duplicate(); 
    re.moveToBookmark(r.getBookmark()); 
    rc.setEndPoint('EndToStart', re); 

    return rc.text.length; 
  }  
  return 0; 
}



// $(document).on('keyup', '.input-text input', function (e) {
// var message = $(this).val();

// // check if enter key is pressed and message is not null also receiver is selected
// if (e.keyCode == 13 && message != '' && receiver_id != '') {
// $(this).val(''); // while pressed enter text box will be empty

// var datastr = "receiver_id=" + receiver_id + "&message=" + message;
// $.ajax({
// type: "post",
// url: "message", // need to create this post route
// data: datastr,
// cache: false,
// success: function (data) {
// //$('.user').click();
// // scrollToBottomFunc();
// //console.log(data)
// },
// error: function (jqXHR, status, err) {
// },
// complete: function () {
// scrollToBottomFunc();
// }
// })
// }
// });
});

// make a function to scroll down auto
function scrollToBottomFunc() {
$('.message-wrapper').animate({
scrollTop: $('.message-wrapper').get(0).scrollHeight
}, 50);
}
</script>
</body>

</html>