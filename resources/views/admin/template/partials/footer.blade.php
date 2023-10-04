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

<script>
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
      </script>


<script>
$(document).ready(function() {
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
});

/* --------Slug--------- */

$('#collection_names').on('keyup',function(){
    var theTitle = this.value.toLowerCase().trim();
    slugInput = $('#slugs'),
    theSlug = theTitle.replace(/&/g,'-and-')
    .replace(/[^a-z0-9-]+/g,'-')
    .replace(/\-\-+/g,'-');
    slugInput.val(theSlug);
  });

  $('#product_name').on('keyup',function(){
    var theTitle = this.value.toLowerCase().trim();
    slugInput = $('#slug'),
    theSlug = theTitle.replace(/&/g,'-and-')
    .replace(/[^a-z0-9-]+/g,'-')
    .replace(/\-\-+/g,'-');
    slugInput.val(theSlug);
  });


/* --------Slug End--------- */


 $(document).ready(function(){

  $(".inputs").keyup(function () {
      $this=$(this);
      if ($this.val().length >=$this.data("maxlength")) {
        if($this.val().length>$this.data("maxlength")){
          $this.val($this.val().substring(0,1));
        }
        $this.next(".inputs").focus();
      }
    });
  });

function limitText(field, maxChar){
    $(field).attr('maxlength',maxChar);
}

/*-----------------------side menu-------------------------- */

$(document).ready(function(){
  $('.closeside').on('click', function(){
    $('body').removeClass ('open');
  });
});

/*  --------------------------------------------- Country Code Picker ----------------------------------------- */

$( document ).ready(function() {
  $("#phoneField").CcPicker();
  $("#country_selector").countrySelect();
});

/*  --------------------------------------------- Datatables  ----------------------------------------- */

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





$(document).ready(function() {
  $('#collections').DataTable();
});

$(document).ready(function() {
  $('#myorders').DataTable();
});

/*  --------------------------------------------- Validations  ----------------------------------------- */

$(function() {
  $("#product_validation").validate({
    rules: {

      product_name: "required",
      collection_name: "required",
      product_description: "required",
      product_price: "required",
      product_type: "required",
      product_image: "required",

      email: {
        required: true,
      },
      password: {
        required: true,
        minlength: 5
      }

    },

    messages: {

      product_name: "Please enter your product name",
      collection_name: "Collection name field is required.",
      product_description: "Please enter your product description",
      product_price: "Please enter your product price",
      product_type: "Please enter your product type",
      product_image: "Please upload your product image",

      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },

    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

$(function() {
  $("#coupon_validation").validate({
    rules: {

      coupon_code: "required",
      cart_amount: "required",
      discount_type: "required",
      discount: "required",
      limit: "required",
      from_date: "required",
      to_date: "required",
      description: "required",

    },

    messages: {

      coupon_code: "Please enter coupon code.",
      cart_amount: "Please enter cart amount.",
      discount_type: "Please enter discount type.",
      limit: "Limit feild is required",
      from_date: "Please enter date",
      to_date: "Please enter date",
      description: "Description feild is required"

    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});


$(function() {
  $("#stripe_validation").validate({
    rules: {

     stripe_key: "required",
     stripe_secret: "required"
    },

    messages: {

     stripe_key: "Please enter Stripe Key.",
     stripe_secret: "Please enter Stripe Secret.",
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

$("form[name='car_splashscreen_form']").submit(function(a) {
       a.preventDefault();
        $.ajax({
        url:'{{route("theme.booking_splashscreen")}}',
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




/*  --------------------------------------------- Validations End ----------------------------------------- */

/*  ------------------------------------------delete modal--------------------------------------------------------  */

function deleteData(url){
        $("#deleteForm").attr('action', url);
        $('#myModal').modal();
    }

function deleteProductData(url){
        $("#deleteProductForm").attr('action', url);
        $('#myProductModal').modal();
    }

/* ---------------------------------------=========================== Product Variations ==============================---------------------------------------------------- */

$(document).ready(function(){

function SelectionOfValues(){
  array1 = $('#pieces').val();
  array2 = $('#pieces1').val();
  var html = '<div>'
  if(jQuery.isEmptyObject(array1) == false && jQuery.isEmptyObject(array2) == true){
	  for(var i = 0; i < array1.length; i++) {
	     html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+array1[i]+'" name="variant_name[]"></div><p>'+array1[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
	   }
  }else if(jQuery.isEmptyObject(array1) == true && jQuery.isEmptyObject(array2) == false){
       for(var i = 0; i < array2.length; i++) {
	     html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+array2[i]+'" name="variant_name[]"></div><p>'+array2[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
	   }
  }else{
  	    var values = combineArraysRecursively([array1, array2]);
  	    for(var i = 0; i < values.length; i++) {
          html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+values[i]+'" name="variant_name[]"></div><p>'+values[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
        }
  }
  return html += '</div>';

}
function UnSelectionOfValues(array1,array2){
  var html = '<div>'
	  if(jQuery.isEmptyObject(array1) == false && jQuery.isEmptyObject(array2) == true){
		  for(var i = 0; i < array1.length; i++) {
		     html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+array1[i]+'" name="variant_name[]"></div><p>'+array1[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
		   }
	  }else if(jQuery.isEmptyObject(array1) == true && jQuery.isEmptyObject(array2) == false){
	       for(var i = 0; i < array2.length; i++) {
		     html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+array2[i]+'" name="variant_name[]"></div><p>'+array2[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
		   }
	  }else{
	  	    var values = combineArraysRecursively([array1, array2]);
	  	    for(var i = 0; i < values.length; i++) {
	          html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+values[i]+'" name="variant_name[]"></div><p>'+values[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
	        }
	  }
	  return html += '</div>';
}

$("#pieces").select2({
   tags: true})
.on("select2:select", function (e) {
   var data = SelectionOfValues();
   $('#variant_values').html(data);
});

$("#pieces1").select2({
   tags: true})
.on("select2:select", function (e) {
	  var data = SelectionOfValues();
      $('#variant_values').html(data);
});

$("#pieces").select2({
   tags: true})
.on("select2:unselecting", function (e) {
	array1 = $('#pieces').val();
    array1 = array1.filter(function(item) {
    return item !== e.params.args.data.id
    });
	array2 = $('#pieces1').val();
	var data = UnSelectionOfValues(array1,array2);
	$('#variant_values').html(data);

});

$("#pieces1").select2({
   tags: true})
.on("select2:unselecting", function (e) {
	array2 = $('#pieces1').val();
    array2 = array2.filter(function(item) {
    return item !== e.params.args.data.id
    });
	array1 = $('#pieces').val();
    var data = UnSelectionOfValues(array1,array2);
	$('#variant_values').html(data);

});

$('#show').on('click', function(e) {
  array1 = $('#pieces').val();
  array2 = $('#pieces1').val();
  var html = '<div>'
  if(jQuery.isEmptyObject(array1) == false && jQuery.isEmptyObject(array2) == true){
	  for(var i = 0; i < array1.length; i++) {
	     html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+array1[i]+'" name="variant_name[]"></div><p>'+array1[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
	   }
  }else if(jQuery.isEmptyObject(array1) == true && jQuery.isEmptyObject(array2) == false){
       for(var i = 0; i < array2.length; i++) {
	     html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+array2[i]+'" name="variant_name[]"></div><p>'+array2[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
	   }
  }else{
  	    var values = combineArraysRecursively([array1, array2]);
  	    for(var i = 0; i < values.length; i++) {
          html += '<div class="form-group"><div class="row"><div class="col-md-2"><label for="">Variant:</label><div class="form-group"><input type="hidden" class="form-control" value="'+values[i]+'" name="variant_name[]"></div><p>'+values[i]+'</p></div><div class="col-md-3"><label for="">Price:</label><input type="number" class="form-control" id="variant_price" name="variant_price[]" placeholder="0.00"></div><div class="col-md-2"><label for="">Quantity:</label><input type="number" class="form-control" id="variant_qty" name="variant_qty[]" placeholder="0"></div><div class="col-md-5"><label for="">Upload Image:</label><input type="file" class="form-control" id="variant_image" name="variant_image[]"></div></div></div>';
        }
  }
  html += '</div>';
  $('#variant_values').html(html);

});

function combineArraysRecursively( array_of_arrays )
{
        // First, handle some degenerate cases...
        if( ! array_of_arrays ){
            // Or maybe we should toss an exception...?
            return [];
        }
        if( ! Array.isArray( array_of_arrays ) ){
            // Or maybe we should toss an exception...?
            return [];
        }
        if( array_of_arrays.length == 0 ){
            return [];
        }
        for( let i = 0 ; i < array_of_arrays.length; i++ ){
            if( ! Array.isArray(array_of_arrays[i]) || array_of_arrays[i].length == 0 ){
                // If any of the arrays in array_of_arrays are not arrays or are zero-length array, return an empty array...
                return [];
            }
        }
        // Done with degenerate cases...
        let outputs = [];
        function permute(arrayOfArrays, whichArray=0, output=""){

            arrayOfArrays[whichArray].forEach((array_element)=>{
                if( whichArray == array_of_arrays.length - 1 ){
                    // Base case...
                    outputs.push( output +'/'+ array_element );
                }
                else{
                    // Recursive case...
                    permute(arrayOfArrays, whichArray+1, output + array_element );
                }
            });/*  forEach() */
        }
        permute(array_of_arrays);
        return outputs;

}

/* function combineArraysRecursively() */

});


$(".product_size").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
$(".product_color").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
$(".product_material").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})


/* ---------------------------------------=========================== Product Variations End ==============================---------------------------------------------------- */




$(document).ready(function(){
  $("#selectdata").click(function(){
    $("#append").append(" <form><input type='text' name='' id=''><input type='text' name='' id=''></form><br>");
  });
});


$(document).ready(function() {
  $("#product_variant").click(function() {
    $("#variant_form").toggle();
  });
});

$(document).ready(function() {
  $("#shipping").click(function() {
    $("#form_shipping").toggle();
  });
});

$(document).ready(function() {
  $("#edit_shipping").click(function() {
    $("#edit_form_shipping").toggle();
  });
});


/* --------------------------=========================  Splash Screen =======================----------------------- */

// Splash BG Color

function splshbgshow() {

$('.splashbg').hide();
var x = document.getElementById("splash_bg_color").value;
document.getElementById("splash_screen_bg").style.backgroundColor = x;
document.getElementById("inp2").value = "";

}


function splshbgimgshow() {

  $('.splashbg').show();
  document.getElementById("splash_bg_color").value = "#ffffff";
}

function splshbgshopimgshow() {

  $('.e-com-3-splashbg').show();
  document.getElementById("splash_bg_color").value = "#ffffff";

}

// Splash Logo

$(".splash_logo").change(function (e) {

    $('#remove_logo_image').show();
    url = URL.createObjectURL(e.target.files[0]),
    $(".preview").attr("src",url);
    console.log(url);

});




// Remove Splash Logo

function removelogoimg() {

  document.getElementById("splash_logo").src = "{{asset('asset/images/splash/applogo.png')}}";
  $('#remove_logo_image').hide();
  $('#inp1').val('');

}

function removebeautylogoimg() {

  document.getElementById("splash_logo").src = "{{asset('template/images/beauty_creams/logo_skincare.png')}}";
  $('#remove_logo_image').hide();
  $('#inp1').val('');

}

function removereddresslogoimg() {

  document.getElementById("splash_logo").src = "{{asset('asset/images/red-logo.png')}}";
  $('#remove_logo_image').hide();
  $('#inp1').val('');

}

// Splash BG Image

$(".splash_bg_image").change(function (e) {
    $('#remove_splash_image').show();
    $('#splash_bg').show();
    url = URL.createObjectURL(e.target.files[0]),
    $("#splash_bg").attr("src",url);
    console.log(url);
});

// Remove Splash BG Image

function removesplashimg() {
  document.getElementById("splash_bg").src = "{{asset('asset/images/splash/spalshbg.png')}}";
  $('#remove_splash_image').hide();
}




function removebeautysplashimg() {
  document.getElementById("splash_bg").src = "{{asset('template/images/beauty_creams/skin-splash-bg.png')}}";
  $('#remove_splash_image').hide();
}

/* --------------------------=========================  Splash Screen End =======================----------------------- */

/* --------------------------=========================  Login Screen =======================----------------------- */

$("#inp3").change(function (e) {

  $('.loginsignbg').css("display", "block");
  $('#remove_login_image').show();
  url = URL.createObjectURL(e.target.files[0]),
  $("#login_image").attr("src",url);
  console.log(url);

});

// Remove login Image

function removeloginimg() {
  document.getElementById("login_image").src = "{{asset('images/econ-1-top-bg.png')}}";
  $('#remove_login_image').hide();
  $('#inp3').val('');
}

function removecarloginimg() {
  document.getElementById("login_image").src = "{{asset('template/images/car_wash/car-wash-img.png')}}";
  $('#remove_login_image').hide();
  $('#inp3').val('');
}

function loginbgshow() {
var x = document.getElementById("login_bg_color2").value;

$('.loginsignbg').css("display", "none");

document.getElementById("back_image").style.backgroundColor = x;
document.getElementById("login_image1").style.backgroundColor = x;
document.getElementById("login_image2").style.backgroundColor = x;
}

function loginbtnshow() {
var x1 = document.getElementById("login_bg_color1").value;
document.getElementById("login_button").style.backgroundColor = x1;
}

const logindropshow = () => {

  var x = document.getElementById("login_dropdown").value;
  if(x==='20'){
  document.getElementById("login_button").style.fontSize = '20px';}
  else if (x==='18'){
  document.getElementById("login_button").style.fontSize = '18px';}
  else if(x==='16'){
  document.getElementById("login_button").style.fontSize = '16px';}
  else if (x==='14'){
  document.getElementById("login_button").style.fontSize = '14px';}
  else if (x==='12'){
  document.getElementById("login_button").style.fontSize = '12px';}
}



/* --------------------------=========================  Login Screen End =======================----------------------- */


/* --------------------------=========================  signup Screen =======================----------------------- */

$(".signup_bg_img").change(function (e) {
  $('#remove_signup_image').show();
  url = URL.createObjectURL(e.target.files[0]),
  $("#signup_back").attr("src",url);
  console.log(url);
});

// Remove signup Image

function removesignupimg() {
  document.getElementById("signup_back").src = "{{asset('images/econ-1-top-bg.png')}}";
  $('#remove_signup_image').hide();
  $('#inp4').val('');
}

function signupbgshow() {
var x = document.getElementById("signup_bg_color2").value;
document.getElementById("signup_back_color").style.backgroundColor = x;
document.getElementById("signup_back1").style.backgroundColor = x;
document.getElementById("signup_back2").style.backgroundColor = x;
}

function signupbtnshow() {
var x1 = document.getElementById("signup_bg_color1").value;
document.getElementById("signup_button").style.backgroundColor = x1;
}

// function signupdropshow() {
// var x2 = document.getElementById("signup_dropdown").value;
// document.getElementById("signup_button").style.fontSize = x2;
// }

const signupdropshow = () => {

var x = document.getElementById("signup_dropdown").value;
if(x==='20'){
document.getElementById("signup_button").style.fontSize = '20px';}
else if (x==='18'){
document.getElementById("signup_button").style.fontSize = '18px';}
else if(x==='16'){
document.getElementById("signup_button").style.fontSize = '16px';}
else if (x==='14'){
document.getElementById("signup_button").style.fontSize = '14px';}
else if (x==='12'){
document.getElementById("signup_button").style.fontSize = '12px';}
}

/* --------------------------=========================  signup Screen End =======================----------------------- */


/* --------------------------=========================  Products Section =======================----------------------- */

//  Key up Functions

$(document).ready(function(){

  $("#product_name").keyup
  (function (e) {
      var value = this.value;
      $("#pro_name").html(value);

  });

  $('.product_color').on("select2:select",function(){

      $('#ecomm_color_option').hide();
      var val_names = $(this).val();
      var mySelect = $('#ecomm_color_select');
      mySelect.empty();
      $.each(val_names, function(val, text) {
        mySelect.append(
            $('<option></option>').html(text)
        );
      });

   });

   $('.product_size').on("select2:select",function(){
    var val_names = $(this).val();
    var mylist = $('#ecomm_size_select');
    mylist.empty();
    $.each(val_names, function(val, text) {
      mylist.append(
          $('<li class="selected-licolor list-inline-item preview_size"></li>').html(text)
      );
    });

 });



  $("#product_description").keyup
  (function (e) {
      var value = this.value;
      $("#pro_description").html(value);
  });


  $("#product_price").keyup
  (function (e) {
      var value = this.value;
      var saleprice = $("#sale_price").val()
      $('.p-old-price').hide();
      $("#pro_price").html(value);
      if(saleprice !== ""){
        $('.p-old-price').show();
        $("#pro_price").html(saleprice);
        $("#sale_price_preview").html(value);
      }
  });

  $("#sale_price").keyup
  (function (e) {
      var value = this.value;
      var regularprice = $("#product_price").val()
      $('.p-old-price').show();
      $("#pro_price").html(value);
      $("#sale_price_preview").html(regularprice);
      if(value == ""){
        $('.p-old-price').hide();
        $("#pro_price").html(regularprice);
      }
  });


});

// Product Image

$("#product_image").change(function (e) {

    url = URL.createObjectURL(e.target.files[0]),
    $(".product_image_screen").attr("src",url);
    console.log(url);

});

// Product Display Image

$("#product_display_image").change(function (e) {

    url = URL.createObjectURL(e.target.files[0]),
    $(".display_image_screen").attr("src",url);
    console.log(url);

});

// Product Display Image 2

$("#product_display_image_1").change(function (e) {

    url = URL.createObjectURL(e.target.files[0]),
    $(".display_image_screen_2").attr("src",url);
    console.log(url);

});

// Product Display Image 3

$("#product_display_image_2").change(function (e) {

    url = URL.createObjectURL(e.target.files[0]),
    $(".display_image_screen_3").attr("src",url);
    console.log(url);

});

/* --------------------------=========================  Products Section End =======================----------------------- */

/* --------------------------=========================  App Setting Colors =======================----------------------- */


function navheadingshow() {
//Nav Heading Color
var x1 = document.getElementById("NavHeadingColor").value;
document.getElementById("theme_nav_heading").style.color = x1;

}
function navbgshow() {
//Nav bg Color
var x1 = document.getElementById("NavBgColor").value;
document.getElementById("nav_background").style.backgroundColor = x1;

}
function headingshow() {
//Heading Color
var x1 = document.getElementById("HeadingColor").value;
document.getElementById("theme_heading").style.color = x1;

}
function subheadingshow() {
//Sub Heading Color
var x1 = document.getElementById("SubHeadingColor").value;
document.getElementById("theme_sub_heading").style.color = x1;

}
function paragraphshow() {
//Paragraph Color
var x1 = document.getElementById("ParagraphColor").value;
document.getElementById("theme_paragraph").style.color = x1;

}
function primarybtnshow() {
//Primary btn Color
var x1 = document.getElementById("PrimaryBtnColor").value;
document.getElementById("primary_button").style.color = x1;

}
function primarybtnbgshow() {
//Primary btn bg Color
var x1 = document.getElementById("PrimaryBtnBgColor").value;
document.getElementById("primary_button").style.backgroundColor = x1;

}
function successbtnshow() {
//Success btn Color
var x1 = document.getElementById("SuccessBtnColor").value;
document.getElementById("success_button").style.color = x1;

}
function successbtnbgshow() {
//Success btn bg Color
var x1 = document.getElementById("SuccessBtnBgColor").value;
document.getElementById("success_button").style.backgroundColor = x1;

}
function dangerbtnshow() {
//Danger btn Color
var x1 = document.getElementById("DangerBtnColor").value;
document.getElementById("danger_button").style.color = x1;

}
function dangerbtnbgshow() {
//Danger btn bg Color
var x1 = document.getElementById("DangerBtnBgColor").value;
document.getElementById("danger_button").style.backgroundColor = x1;

}
function screenbgshow() {
//Screen bg Color
var x1 = document.getElementById("ScreenBgColor").value;
document.getElementById("screen_bg").style.backgroundColor = x1;

}

/* --------------------------=========================  App Setting Colors End Here =======================----------------------- */


/* --------------------------=========================  App Setting Font Size =======================----------------------- */


const navheadingfontshow = () => {
  //  Nav Heading Font
  var x = document.getElementById("nav_heading_font").value;
  if(x==='20px'){
  document.getElementById("theme_nav_heading").style.fontSize = '20px';}
  else if (x==='18px'){
  document.getElementById("theme_nav_heading").style.fontSize = '18px';}
  else if(x==='16px'){
  document.getElementById("theme_nav_heading").style.fontSize = '16px';}
  else if (x==='14px'){
  document.getElementById("theme_nav_heading").style.fontSize = '14px';}
  else if (x==='12px'){
  document.getElementById("theme_nav_heading").style.fontSize = '12px';}
}


const headingfontshow = () => {
  // Heading Font
  var x = document.getElementById("heading_font").value;
  if(x==='20px'){
  document.getElementById("theme_heading").style.fontSize = '20px';}
  else if (x==='18px'){
  document.getElementById("theme_heading").style.fontSize = '18px';}
  else if(x==='16px'){
  document.getElementById("theme_heading").style.fontSize = '16px';}
  else if (x==='14px'){
  document.getElementById("theme_heading").style.fontSize = '14px';}
  else if (x==='12px'){
  document.getElementById("theme_heading").style.fontSize = '12px';}
}

const subheadingfontshow = () => {
  // Sub Heading Font
  var x = document.getElementById("sub_heading_font").value;
  if(x==='20px'){
  document.getElementById("theme_sub_heading").style.fontSize = '20px';}
  else if (x==='18px'){
  document.getElementById("theme_sub_heading").style.fontSize = '18px';}
  else if(x==='16px'){
  document.getElementById("theme_sub_heading").style.fontSize = '16px';}
  else if (x==='14px'){
  document.getElementById("theme_sub_heading").style.fontSize = '14px';}
  else if (x==='12px'){
  document.getElementById("theme_sub_heading").style.fontSize = '12px';}
}

const paragraphfontshow = () => {
  // Paragraph Font
  var x = document.getElementById("paragraph_font").value;
  if(x==='20px'){
  document.getElementById("theme_paragraph").style.fontSize = '20px';}
  else if (x==='18px'){
  document.getElementById("theme_paragraph").style.fontSize = '18px';}
  else if(x==='16px'){
  document.getElementById("theme_paragraph").style.fontSize = '16px';}
  else if (x==='14px'){
  document.getElementById("theme_paragraph").style.fontSize = '14px';}
  else if (x==='12px'){
  document.getElementById("theme_paragraph").style.fontSize = '12px';}
}

const primarybtnfontshow = () => {
  // Primary btn Font
  var x = document.getElementById("primary_btn_font").value;
  if(x==='20px'){
  document.getElementById("primary_button").style.fontSize = '20px';}
  else if (x==='18px'){
  document.getElementById("primary_button").style.fontSize = '18px';}
  else if(x==='16px'){
  document.getElementById("primary_button").style.fontSize = '16px';}
  else if (x==='14px'){
  document.getElementById("primary_button").style.fontSize = '14px';}
  else if (x==='12px'){
  document.getElementById("primary_button").style.fontSize = '12px';}
}

const successbtnfontshow = () => {
  // Success btn Font
  var x = document.getElementById("success_btn_font").value;
  if(x==='20px'){
  document.getElementById("success_button").style.fontSize = '20px';}
  else if (x==='18px'){
  document.getElementById("success_button").style.fontSize = '18px';}
  else if(x==='16px'){
  document.getElementById("success_button").style.fontSize = '16px';}
  else if (x==='14px'){
  document.getElementById("success_button").style.fontSize = '14px';}
  else if (x==='12px'){
  document.getElementById("success_button").style.fontSize = '12px';}
}

const dangerbtnfontshow = () => {
  // Danger btn Font
  var x = document.getElementById("danger_btn_font").value;
  if(x==='20px'){
  document.getElementById("danger_button").style.fontSize = '20px';}
  else if (x==='18px'){
  document.getElementById("danger_button").style.fontSize = '18px';}
  else if(x==='16px'){
  document.getElementById("danger_button").style.fontSize = '16px';}
  else if (x==='14px'){
  document.getElementById("danger_button").style.fontSize = '14px';}
  else if (x==='12px'){
  document.getElementById("danger_button").style.fontSize = '12px';}
}

/* --------------------------=========================  App Setting Font Size End Here =======================----------------------- */

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



//     function openCity(evt, cityName) {
//        var i, tabcontent, tablinks;
//        tabcontent = document.getElementsByClassName("tabcontent");
//        for (i = 0; i < tabcontent.length; i++) {
//           tabcontent[i].style.display = "none";
//        }
//        tablinks = document.getElementsByClassName("tablinks");
//        for (i = 0; i < tablinks.length; i++) {
//           tablinks[i].className = tablinks[i].className.replace(" active", "");
//        }
//        document.getElementById(cityName).style.display = "block";
//        evt.currentTarget.className += " active";
//     }



// $(function () {
//     $("#btnAddq").bind("click", function () {
//         var div = $("<div class='col-md-6'></div>");
//         div.html(GetDynamicTextBox(""));
//         $("#faq").append(div);
//     });
//     $("body").on("click", ".deletei", function () {
//         $(this).parent().parent().remove();
//     });
// });
// function GetDynamicTextBox(value) {
//     return '<div class="form-group bug-container"><i class="fa fa-trash-o deletei" aria-hidden="true"></i><div class="form-group bug-container"><label class="pr-label" for="Quote Title">FAQ Question</label><input  type="text" name="faq_questions[]" class="form-control input-style" placeholder="Enter FAQ Question" required></div><div class="form-group bug-container"><label class="pr-label" for="Add Quote">FAQ Answer</label><textarea class="form-control input-style" id="faq_answers" name="faq_answers[]" rows="10" cols="50" placeholder="FAQ Answers"></textarea></div></div>'
// }


</script>
<script>
  $('body').addClass ('open');
    $(document).ready(function(){
    $('.closeside').on('click', function(){
      $('body').removeClass ('open');
    });
  });
</script>
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
</body>
</html>
