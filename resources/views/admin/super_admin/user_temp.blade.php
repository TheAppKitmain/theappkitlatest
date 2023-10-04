@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
    <div class="mainwrapper-inner-container">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 text-right">
                    <div class="add-app-new">
                    </div>
                </div>

            </div>
            <div class="row admin-rowabtapp">

                <div class="super_admin_custom_users">
                    <h1 class="temph1"><span class="cusadmin-1">Customer Name</span> : {{ $user->first_name }}
                        {{ $user->last_name }}</h1>
                </div>
            </div>
            <div class="row admin-rowabtappbtm super_admin_custom_users">
                @if (count($themetemplates) == 0)

                    <h1 class="no_app">No App yet</h1>

                @else

                    @foreach ($themetemplates as $themetemplate)

                        <div class="col-md-3">
                            <div class="user_temp_app">
                                <a href="{{ route('showuser_temp_data', ['id' => $user->id]) }}">
                                    <img class="temimg" src="{{ asset($themetemplate->theme_thumbnail) }}">
                                    <!-- <img class="" src="{{ asset('images/placeholder_logo.png') }}"> -->
                                    <h2>{{ $themetemplate->theme_name }}</h2>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>

@include('admin.super_admin.partials.footer')
