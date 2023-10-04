<!-- footer start-->
<footer></footer>
<!-- footer end -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"
integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="{{ asset('asset/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js"
integrity="sha512-J4OD+6Nca5l8HwpKlxiZZ5iF79e9sgRGSf0GxLsL1W55HHdg48AEiKCXqvQCNtA1NOMOVrw15DXnVuPpBm2mPg=="
crossorigin="anonymous"></script>
<script
src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.1.3/circle-progress.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/countrySelect.js') }}"></script>
<script src="{{ asset('js/jquery.ccpicker.js') }}"></script>
<script src="{{ asset('asset/js/custom.js') }}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

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
    $( document ).ready(function() {
    $("#phoneField").CcPicker();
    $("#country_selector").countrySelect();
    });
    
    $('#all_users').dataTable({
        'language': {
            'searchPlaceholder': 'Search by name, business name, email, number...'
        },
        'ordering': false
    });

    // $('#all_custom_users').dataTable({
    //     'language': {
    //         'searchPlaceholder': 'Search by name, business name, email, number...'
    //     },
    //     'ordering': false
    // });

    

    @if (session('status'))
        @if (session('goto_tab'))
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) { tabcontent[i].style.display="none" ; }
                tablinks=document.getElementsByClassName("tablinks"); for (i=0; i < tablinks.length; i++) {
                tablinks[i].className=tablinks[i].className.replace(" active", "" ); }
                document.getElementById('{{ session('goto_tab') }}').style.display="block" ;
                document.getElementById('{{ session('goto_tab') }}_').className +=" active" ;; @endif
                swal({title: '{{ session('status') }}',icon: '{{ session('statuscode') }}',button: "OK",});
        @endif
    $.ajaxSetup({
        headers: {
            'csrftoken': '{{ csrf_token() }}'
        }
    });
</script>

<script>

      $('#all_custom_users').dataTable({
        'language': {
            'searchPlaceholder': 'Search by name, business name, email, number...'
        },
        'ordering': false
    });

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
<script>
    $(document.body).delegate('#select_super_admin .assigntoRoles', 'change', function() {
        var super_user_id = $(this).val();
        var customer_id = $(this).attr('data-customer-id');
        $.ajax({
            url: "{{ route('assignpm') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",
                "super_user_id": super_user_id,
                "customer_id": customer_id,
            },
            success: function(response) {
                // alert(JSON.stringify(response));
                if (response == 1) {
                    swal("Assign Project Manager successfully");
                } else {
                    swal("Assign Project Manager updated successfully");
                }
                setTimeout(function() {
                    location.reload();
                }, 1000)
                // alert(response);
                //  swal(response, "Payment status updated successfully", "success");
            },
        });
    });


    $("#filterByassisnged_un").change(function() {
        var option = $(this).find('option:selected');
        window.location.href = option.data("url");
    });
</script>
<script>
    function delete_pm(url) {
        console.log(url)
        $('body').find("#deleteProductForm").attr('action', url);
        $('body').find('#myProductModal').modal('show');
    }
</script>


<script>
    $('#theme_name').on('keyup', function() {
        var theTitle = this.value.toLowerCase().trim();
        slugInput = $('#theme_slug'),
            theSlug = theTitle.replace(/&/g, '-and-')
            .replace(/[^a-z0-9-]+/g, '-')
            .replace(/\-\-+/g, '-');
        slugInput.val(theSlug);
    });
</script>

<script>
    $('#category_name').on('keyup', function() {
        var theTitle = this.value.toLowerCase().trim();
        slugInput = $('#category_slug'),
            theSlug = theTitle.replace(/&/g, '-and-')
            .replace(/[^a-z0-9-]+/g, '-')
            .replace(/\-\-+/g, '-');
        slugInput.val(theSlug);
    });
</script>

<script>
    // Wait for the DOM to be ready
    $(function() {
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("form[name='registration']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                app_name: "required",
                app_idea: "required",
                domian_details: "required",
                design_details: "required",
                domain_email: {
                    required: true,
                    // Specify that email should be validated
                    // by the built-in "email" rule
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
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {

        $("#name").keyup(function(e) {

            var value = this.value;
            $("#app_name").html(value);

        });

        $("#description").keyup(function(e) {

            var value = this.value;
            $("#app_idea").html(value);

        });

        $("#image").change(function(e) {
            url = URL.createObjectURL(e.target.files[0]),
                $("#preview").attr("src", url);
            console.log(url);

        });

    });
</script>
<script>
    $(document).ready(function() {

        $('#myform').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true,
                },
            },
            submitHandler: function(form) { // for demo

                return false; // for demo
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#phoneField").CcPicker();
    });
</script>
<script>
    /*side menu */
    $('body').addClass('open');
    $(document).ready(function() {
        $('.closeside').on('click', function() {
            $('body').removeClass('open');
        });
    });
</script>

<script>
    $(function() {
        var max_note_editor_limit = 10;
        var note = 1;
        $("#btnAddn").bind("click", function() {
            if (note < max_note_editor_limit) {
                note++;
                var html =
                    '<div class="col-md-6"><div class="form-group bug-container"><i class="fa fa-trash-o deletein" aria-hidden="true" ></i><label for=" Add Note "> Add Note </label><textarea name="add_note[]" id="ckeditor_' +
                    note +
                    '" class="ckeditor form-control" placeholder="Note" value = "" required rows="10" cols="50"></textarea></div></div>';
                $("#bugsn").append(html);
                CKEDITOR.replace("ckeditor_" + note);
            }
        });

        $("body").on("click", ".deletein", function() {
            $(this).parent().parent().remove();
        });
    });
</script>

<script>
    $(function() {
        var max_note_editor_limit = 10;
        var note = 1;
        $("#btnAddn1").bind("click", function() {
            if (note < max_note_editor_limit) {
                note++;
                var html =
                    '<div class="col-md-6"><div class="form-group bug-container"><i class="fa fa-trash-o deletein" aria-hidden="true" ></i><label for=" Add Note "> Add XD Links </label><input type="text" class="form-control" name="add_note[]" placeholder="Add XD Links"></div></div>';
                $("#bugsn1").append(html);
            }
        });

        $("body").on("click", ".deletein", function() {
            $(this).parent().parent().remove();
        });
    });
</script>

<script>
    $(function() {
        var max_note_editor_limit = 10;
        var note = 1;
        $("#add_notes").bind("click", function() {
            if (note < max_note_editor_limit) {
                note++;
                var html =
                    '<div class="col-md-6"><div class="form-group bug-container"><i class="fa fa-trash-o deletein" aria-hidden="true" ></i><label for=" Add Note "> Add Note </label><textarea name="internal_notes[]" id="ckeditor_' +
                    note +
                    '" class="ckeditor form-control" placeholder="Note" value = "" rows="10" cols="50" required></textarea></div></div>';
                $("#interal_notes").append(html);
                CKEDITOR.replace("ckeditor_" + note);
            }
        });

        $("body").on("click", ".deletein", function() {
            $(this).parent().parent().remove();
        });
    });
</script>

<script>
    $(function() {
        $("#btnAddq").bind("click", function() {
            var div = $("<div class='col-md-6'></div>");
            div.html(GetDynamicTextBoxq(""));
            $("#bugsq").append(div);
        });
        $("body").on("click", ".deletein", function() {
            $(this).parent().parent().remove();
        });
    });

    function GetDynamicTextBoxq(value) {
        return '<div class="form-group bug-container"><i class="fa fa-trash-o deletein" aria-hidden="true" ></i><label for="Quote Title">Quote Title</label><input type="text" name="quote_title[]" class="form-control"><label for=" Add Note "> Add Quote </label> <input type="file" name="quote_doc[]" class="form-control"><div class="col-md-12"><div class="row"><div class="col-md-6 Q-price"><label for="Add Price"> Add Price </label><input type="number" name="quote_price[]" class="form-control" reqired></div><div class="col-md-6 D-price"> <label for="Due Date">Due Date</label><input type="date" name="date[]" class="form-control" reqired></div></div></div></div>'
    }
</script>

<script>
    $(function() {
        $("#btnAddint").bind("click", function() {
            var div = $("<div class='col-md-4'></div>");
            div.html(GetDynamicTextBox(""));
            $("#bugsint").append(div);
        });
        $("body").on("click", ".deletei", function() {
            $(this).parent().parent().remove();
        });
    });

    function GetDynamicTextBox(value) {
        return '<div class="form-group bug-container"><i class="fa fa-trash-o deletei" aria-hidden="true" ></i><input type="hidden" class="form-control" name="bugby" value="pm"><label for="">Bug Type</label><select name="bug_type[]" id="bugtype" class="form-control"><option value="Functional (Something not working)">Functional (Something not working)</option><option value="Functional (Something missing)">Functional (Something missing)</option><option value="User Interface (e.g. text, colours, element positioning etc.)">User Interface (e.g. text, colours, element positioning etc.)</option><option value="Other">Other</option></select><label for="exampleInputEmail1">Bug Description</label><textarea name="bug_description[]" class="form-control"  placeholder="Explain Bug" value = "' +
            value +
            '" required></textarea><label for="exampleInputEmail1">Bug Screenshot</label><input type="file" name="bug_screenshot[1][]"  multiple class="form-control"> <div class="form-group"><label for="exampleFormControlSelect1">Bug For</label><select class="form-control" id="bug_device" name="bug_device[]"><option>Android</option><option>iOS</option><option>Both</option><option>Admin Panel</option></select></div><div class="form-group"><label for="exampleFormControlSelect1">Bug Priority</label><select class="form-control" id="bug_priority" name="bug_priority[]"><option>Low</option><option>Medium</option><option>High</option></select></div><label for="">for client</label><input type="checkbox" class="bugforclient" value="0"><input class="bugforclientHidden" type="hidden" value="0" name="bugforclient[]"></div>'
    }
</script>

<!--------------------------Web Bug ----------------------->
<script>
    $(function() {
        $("#btnAddweb").bind("click", function() {
            var div = $("<div class='col-md-4'></div>");
            div.html(GetDynamicTextBoxweb(""));
            $("#bugsweb").append(div);
        });
        $("body").on("click", ".deletei", function() {
            $(this).parent().parent().remove();
        });
    });

    function GetDynamicTextBoxweb(value) {
        return '<div class="form-group bug-container"><i class="fa fa-trash-o deletei" aria-hidden="true" ></i><label for="">Bug Type</label><select name="bug_type[]" id="bugtype" class="form-control"><option value="Functional (Something not working)">Functional (Something not working)</option><option value="Functional (Something missing)">Functional (Something missing)</option><option value="User Interface (e.g. text, colours, element positioning etc.)">User Interface (e.g. text, colours, element positioning etc.)</option><option value="Other">Other</option></select><label for="exampleInputEmail1">Bug Description</label><textarea name="bug_description[]" class="form-control"  placeholder="Explain Bug" value = "' +
            value +
            '" required></textarea><label for="exampleInputEmail1">Bug Screenshot</label><input type="file" name="bug_screenshot[]" multiple class="form-control"><input type="hidden" class="form-control" name="status[]" value="1"></div>'
    }
</script>



<script>
    $(function() {
        var max_fields_limit = 10;
        var x = 1;
        $('#bugsq #add_new_tyer').bind("click", function(e) {
            e.preventDefault();
            if (x < max_fields_limit) {
                x++;
                var html =
                    '<div class="row"><div class="col-md-4 Q-price" style="padding-left: 0px;"><label for="First Payment"> Invoice Link  </label><input type="url" name="invoice_url[]" class="form-control" required></div><div class="col-md-3 Q-price" style="padding-left: 0px;"><label for="Add Price"> Add Price </label><input type="number" name="quote_price[]" class="form-control" required></div><div class="col-md-3 D-price"><label for="Due Date">Due Date</label><input type="date" name="date[]" class="form-control" required></div><div class="col-md-2 add_tyer_btn" style="margin-top: 31px;"><button type="button" style="float:right;" class="btn btn-primary remove_item">Remove</button></div></div>';
                $('#bugsq .input_fields_container').append(html);
            }
        });

        $('#bugsq .input_fields_container').on("click", ".remove_item", function(e) {
            e.preventDefault();
            var y = $('.input_fields_container .row').length;
            console.log(y);
            if (y > 1) {
                $(this).parent('div').parent('div').remove();
                x--;
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function(e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<span class=\"col-md-4\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\">Remove image</span>" +
                            "</span>").insertAfter("#files");
                        $(".remove").click(function() {
                            $(this).parent(".col-md-4").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });
</script>
<!------------------------------Timeline Jquery----------------------->
<script>
    $(function() {
        var max_note_editor_limit = 10;
        var note = 1;
        $("#btnAddt").bind("click", function() {
            if (note < max_note_editor_limit) {
                note++;
                var html =
                    '<div class="col-md-12"><div class="form-group"><i class="fa fa-trash-o deletein" aria-hidden="true" ></i><label for=" Add task "> Add task </label><textarea name="task_description[]" id="add_task_' +
                    note +
                    '" class="ckeditor form-control" value = "" required rows="2" cols="10"></textarea></div></div>';
                $("#timeline").append(html);
                CKEDITOR.replace("add_task_" + note);
            }
        });
        $("body").on("click", ".deletein", function() {
            $(this).parent().parent().remove();
        });
    });
</script>

<script>
    $(function() {
        var max_note_editor_limit = 10;
        var note = 1;
        $("#btnAddtd").bind("click", function() {
            if (note < max_note_editor_limit) {
                note++;
                var html =
                    '<div class="col-md-12"><div class="form-group bug-container"><i class="fa fa-trash-o deletein" aria-hidden="true" ></i><label for=" Add task "> Add task </label><textarea name="task_description[]" id="" class="ckeditor form-control" value = "" required rows="2" cols="10"></textarea></div></div>';
                $("#timelinedev").append(html);
                // CKEDITOR.replace("ckeditor_2"+note);
            }
        });
        $("body").on("click", ".deletein", function() {
            $(this).parent().parent().remove();
        });
    });
</script>

<!---------------------------------------Chat jQuery---------------------------------------------->
<script>
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";
    $(document).ready(function() {
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
        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data));
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

        $('.user').click(function() {
            $('.user').removeClass('active');
            $(this).addClass('active');
            $(this).find('.pending').remove();

            receiver_id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "message/" + receiver_id, // need to create this route
                data: "",
                cache: false,
                success: function(data) {
                    $('#messages').html(data);
                    scrollToBottomFunc();
                }
            });
        });

        $('textarea.submitmsgchat').keyup(function(event) {
            var message = $(this).val();
            if (event.keyCode == 13 && event.shiftKey) {
                var content = this.value;
                var caret = getCaret(this);
                this.value = content.substring(0, caret) + "\n" + content.substring(carent, content
                    .length - 1);
                event.stopPropagation();

            } else if (event.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val(''); // while pressed enter text box will be empty

                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "post",
                    url: "message", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function(data) {
                        //$('.user').click();
                        // scrollToBottomFunc();
                        //console.log(data)
                    },
                    error: function(jqXHR, status, err) {},
                    complete: function() {
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
        // // console.log(data)
        // // scrollToBottomFunc();
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#all_customer").select2({
            placeholder: "Select customers",
            allowClear: true
        });
        $('#notification_to').change(function() {
            var notif_to = $("#notification_to").val();
            if (notif_to == 1) {
                $('#all_customer').val(null).trigger('change');
                $("#select_customer").addClass("d-none");
            } else if (notif_to == 2) {
                $('#all_customer').val(null).trigger('change');
                $("#select_customer").removeClass("d-none");
            }
        });
    });
</script>

</body>

</html>
