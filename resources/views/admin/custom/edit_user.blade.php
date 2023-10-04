@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
   <div class="mainwrapper-inner-container">
<div class="smallmainwrapper">
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Custom User</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('custom_user.update',$user->id)}}" name="registration">                  
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{$user->first_name}}" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{$user->last_name}}" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label for="">Country</label><br>
                        <input id="country_selector" type="text" class="form-control" name="country" value="{{$user->country}}"  style="width:100%;">
					</div>
                    <div class="form-group">
                        <label for="">Number</label>
                        <input type="number" name="phone_number" id="edit_number"  placeholder="Enter Number" data-maxlength="13" value="{{$user->number}}" class="phone-field form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
                
        </div>
    </div>
</div>
</div>
</div>
</div>

@include('admin.custom.partials.footer')


<script>
   $('#edit_number').keyup(validateMaxLength);

function validateMaxLength()

{
        var text = $(this).val();
        var maxlength = $(this).data('maxlength');

        if(maxlength > 0)  
        {
                $(this).val(text.substr(0, maxlength)); 
        }
}

</script>
