@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
    <div class="mainwrapper-inner-container">
        <div class="smallmainwrapper">
            <div class="container-fluid">
                <div class="main-page-container">
                    <div class="container-fluid">
                        <div class="col-lg-12 col-xl-12 col-md-12">
                            @if (Session::get('alert'))
                                <div class="alert alert-{{ Session::get('alert') }} alert-dismissible" role="alert">
                                    <p>{{ Session::get('message') }} </p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                            @endif
                        </div>
                        <form role="form" data-toggle="validator" action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12">
                                    <div class="col-lg-12 col-xl-12 col-md-12">
                                        <div class="form-group f-g-o">
                                            <label for="usr">Send to (all or select)</label>
                                            <select data-error="This field is required." name="notif_to"
                                                class="form-control" id="notification_to">
                                                <option value="1" selected>Send to all</option>
                                                <option value="2">Select from list</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="select_customer" class="col-lg-12 col-xl-12 col-md-12 d-none">
                                        <div class="form-group f-g-o">
                                            <label for="usr">Select Cutomers</label>
                                            <select class="form-control" name="users_id[]" multiple id="all_customer">

                                                @foreach ($all_users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->business_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-xl-12 col-md-12">
                                        <div class="form-group f-g-o">
                                            <label for="usr">Notification Body</label>
                                            <textarea rows="6" class="form-control" placeholder="Notification body"
                                                name="notif_body" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-12 col-md-12">
                                        <div class="form-group"><button class="btn btn-primary"
                                                type="submit">Send</button></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    #select_business span.select2.select2-container.select2-container--default {
        width: 100% !important;
        height: 100%;
        border-radius: 0px !important;


    }

    #select_customer span.select2.select2-container.select2-container--default {
        width: 100% !important;
        height: 100%;
        border-radius: 0px !important;

    }

    span.select2.select2-container.select2-container--default.select2-container--focus {
        width: 100% !important;
        height: 100%;
        border-color: #5e32d7 !important;
        border-radius: 0px !important;
        background-color: #FFF;

    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {

        border: solid #5e32d7 1px;
        outline: 0;
        background-color: #FFF;
    }

    .select2-container--default .select2-selection--multiple {
        background-color: white;
        border: 1px solid rgb(204, 201, 201);
        border-radius: 0px;
        cursor: text;
        padding-bottom: 10px;
        padding-right: 10px;
        height: 100%;
    }

    .select2-container .select2-search--inline .select2-search__field {
        box-sizing: border-box;
        border: none;
        font-size: 100%;
        margin-top: 10px;
        margin-left: 10px;
        padding: 0;
    }

</style>

@include('admin.super_admin.partials.footer')
