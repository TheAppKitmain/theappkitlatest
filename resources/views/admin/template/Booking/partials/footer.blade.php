<!-- footer start-->
<footer>


<!-- Build app Modal here -->

<div class="modal" tabindex="-1" role="dialog"  aria-hidden="true" id="buildapp">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
         <div class="modal-body">
            <p>Hey!<br>
            We Got Your all info<br>
            Our Development Team Will get back to you soon
          </p>
         </div>
         <div class="modal-footer">          
            <!-- <button type="button" class="btn btn-success" data-dismiss="modal">No</button> -->
         </div>
         </div>
      </div>
</div>

<!-- Buildapp Modal End here -->


</footer>
<!-- footer end -->

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="{{ asset('js/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/countrySelect.js') }}"></script>
<script src="{{ asset('js/jquery.ccpicker.js') }}"></script>
<script src="{{asset('template/js/bootstrap.min.js') }}"></script>
<script src="{{asset('template/js/custom.js')}}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{asset('template/js/index.js') }}"></script>
<script src="{{asset('template/js/example1.js') }}"></script>
<script src="{{ asset('js/owl.carousel.js') }} "></script>
<script src="{{ asset('js/owl.carousel.min.js') }} "></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('#example').DataTable();
$('.select_multiple').select2({
    selectOnClose: true
});
$('.sub-menu ul').hide();
$(".sub-menu a").click(function () {
$(this).parent(".sub-menu").children("ul").slideToggle("100");
$(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
}); 

function deleteData(url)
{
    $("#deleteForm").attr('action', url);
    $('#myModal').modal();
}   

$.each($(".daycontainer .start_time"), function(){            
    var ids = $(this).attr('id');
    $("#"+ids).timepicker({uiLibrary: 'bootstrap4', icons: { rightIcon: '<i class="fa fa-clock-o" aria-hidden="true"></i>'}});
});
$.each($(".daycontainer .end_time"), function(){            
    var ids = $(this).attr('id');
    $("#"+ids).timepicker({ uiLibrary: 'bootstrap4' , icons: { rightIcon: '<i class="fa fa-clock-o" aria-hidden="true"></i>'}});
});
</script>


<script>

$(document).ready(function() {
  $('#product_details').dataTable( {
      language: {
          searchPlaceholder: "Search...",
          autoFill: false
      }
  });

});

$(document).ready(function() {
$("#product_details_filter input[type=search]").attr("autocomplete", "off").attr("readonly","");

$("#product_details_filter input[type=search]").click(function() {
  this.removeAttribute('readonly');
});

});



         $('#theme-showcase-all').owlCarousel({
             loop: true,
             margin: 30,
             smartSpeed: 2000, // duration of change of 1 slide
             nav: true,
             navigation: true,
             responsiveClass: true,
             responsive: {
                 0: {
                     items: 1,
                     nav: true
                 },
                 600: {
                     items: 1,
                     nav: false
                 },
                 1000: {
                     items: 1,
                     nav: true
                 },
                 1400: {
                     items: 1,
                     nav: true 
                 }
             }
         })

$("form[name='splashscreen_form']").submit(function(a) {
       a.preventDefault();
        $.ajax({
        url:'{{route("theme.splashscreen")}}',
        type: "POST",        
        data: new FormData(this),         
        contentType: false,         
        cache: false,  
        processData:false,
        success:function(response){
           if (response.success === true) {
              swal("Done!", response.message, "success");
              setInterval(function() { location.reload(); }, 1000);
           } else {
               swal("Error!", response.message, "error");
           }
        }
    });
});

$(function() {
  
$("form[name='login_form']").submit(function(a) {
       a.preventDefault();
        $.ajax({
        url:'{{route("theme.loginscreen")}}',
        type: "POST",        
        data: new FormData(this),         
        contentType: false,         
        cache: false,  
        processData:false,
        success:function(response){

           if (response.success === true) {
               swal("Done!", response.message, "success");
               setInterval(function() { location.reload(); }, 1000);
           } else {
               swal("Error!", response.message, "error");
           }
        }
    });
});

});

$("form[name='signup_form']").submit(function(a) {
       a.preventDefault();
        $.ajax({
        url:'{{route("theme.signupscreen")}}',
        type: "POST",        
        data: new FormData(this),         
        contentType: false,         
        cache: false,  
        processData:false,
        success:function(response){
      
           if (response.success === true) {
               swal("Done!", response.message, "success");
               setInterval(function() { location.reload(); }, 1000);
           } else {
               swal("Error!", response.message, "error");
           }
        }
    });


});     

/* --------------------------=========================  Sweet Alert =======================----------------------- */

@if(session('status'))
  swal({
  title: '{{session('status')}}',
  icon: '{{session('statuscode')}}',
  button: "OK",
  });
  @endif
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

/* --------------------------=========================  Sweet Alert End =======================----------------------- */  


</script>




