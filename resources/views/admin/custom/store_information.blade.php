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
                    <h2>Store Information</h2>
                </div>
                <div class="card-body">
                    @if(!is_null($store))
                    <form method ="POST" action="{{route('app.storeinformation.update',$store->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @else
                    <form method ="POST" action="{{route('app.storeinformation.store')}}" enctype="multipart/form-data">
                    @csrf
                    @endif
                    <input type="hidden" name="app_id" value="{{session('app_id')}}">
                    <div class="form-group">
                    @if(Auth::user()->parent_id == 0)  
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                    @else
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                    @endif                    
                    </div>

                    <div class="form-group">
                    <label for="">Promotional Text ( 1 or 2 lines on App)</label>
                    @if(!is_null($store))
                    @if(!is_null($store->promotional_text))
                    <textarea class="form-control" id="promotional_text" name="promotional_text" placeholder="Promotional Text" rows="4">{{$store->promotional_text}}</textarea required>
                    @else
                    <textarea class="form-control" id="promotional_text" name="promotional_text" placeholder="Promotional Text" rows="4"></textarea required>
                    @endif
                     @else
                     <textarea class="form-control" id="promotional_text" name="promotional_text" placeholder="Promotional Text" rows="4"></textarea required>
                     @endif
                    </div>

                    <div class="form-group">
                    <label for="">Subtitle of App</label>
                    @if(!is_null($store))
                     @if(!is_null($store->app_subtitle))
                    <input type="text" class="form-control" name="app_subtitle" id="app_subtitle" placeholder="App Subtitle" value="{{$store->app_subtitle}}" required>
                    @else
                    <input type="text" class="form-control" name="app_subtitle" id="app_subtitle" placeholder="App Subtitle" required>
                    @endif
                    @else
                    <input type="text" class="form-control" name="app_subtitle" id="app_subtitle" placeholder="App Subtitle" required>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">Keywords</label>
                    @if(!is_null($store))
                     @if(!is_null($store->keywords))
                     <select class="form-control" id="piece" multiple="multiple" name="keywords[]" value="{{$store->keywords}}" placeholder="Enter Keywords">
                         <option value="{{$store->keywords}}" selected>{{$store->keywords}}</option>
                     </select>
                    <!-- <input type="text" class="form-control" multiple="multiple" id="piece" name="keywords[]" placeholder="Enter Keywords" value="{{$store->keywords}}"> -->
                    @else
                    <select class="form-control" id="piece" multiple="multiple" name="keywords[]" placeholder="Enter Keywords">
                     </select>
                    @endif
                    @else
                    <select class="form-control" id="piece" multiple="multiple" name="keywords[]" placeholder="Enter Keywords">
                     </select>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">Support URL ( your website name )</label>
                    @if(!is_null($store))
                    @if(!is_null($store->support_url))
                    <input type="url" class="form-control" name="support_url" id="support_url" placeholder="Support url" value="{{$store->support_url}}" required>
                    @else
                    <input type="url" class="form-control" name="support_url" id="support_url" placeholder="Support url" required>
                    @endif
                    @else
                    <input type="url" class="form-control" name="support_url" id="support_url" placeholder="Support url" required>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">Marketing URL ( Your website )</label>
                    @if(!is_null($store))
                     @if(!is_null($store->marketing_url))
                    <input type="url" class="form-control" name="marketing_url" id="marketing_url" placeholder="Marketing url" value="{{$store->marketing_url}}" required>
                       @else
                    <input type="url" class="form-control" name="marketing_url" id="marketing_url" placeholder="Marketing url" required>
                    @endif
                    @else
                    <input type="url" class="form-control" name="marketing_url" id="marketing_url" placeholder="Marketing url" required>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">Description of App</label>
                    @if(!is_null($store))
                     @if(!is_null($store->app_description))
                     <textarea class="form-control" id="app_description" name="app_description" placeholder="Promotional Text" rows="4">{{$store->app_description}}</textarea>
                       @else
                       <textarea class="form-control" id="app_description" name="app_description" placeholder="Promotional Text" rows="4"></textarea>
                       @endif
                    @else
                    <textarea class="form-control" id="app_description" name="app_description" placeholder="Promotional Text" rows="4"></textarea>                    
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">Age Rating ( Enter Age Limmit )</label>
                    @if(!is_null($store))
                    @if(!is_null($store->age_rating))
                    <select class="form-select form-control"  name="age_rating" id="age_rating" aria-label="Default select example">
                        <option {{$store->age_rating == "" ? "selected" : ""}}>Select Category</option>
                        <option {{$store->age_rating == "Rated 4+: Contains no objectionable material" ? "selected" : ""}}>Rated 4+: Contains no objectionable material</option>
                        <option {{$store->age_rating == "Rated 9+: May contain content unsuitable for children under the age of 9" ? "selected" : ""}}>Rated 9+: May contain content unsuitable for children under the age of 9</option>
                        <option {{$store->age_rating == "Rated 12+: May contain content unsuitable for children under the age of 12" ? "selected" : ""}}>Rated 12+: May contain content unsuitable for children under the age of 12</option>
                        <option {{$store->age_rating == "Rated 17+: May contain content unsuitable for children under the age of 17" ? "selected" : ""}}>Rated 17+: May contain content unsuitable for children under the age of 17</option>
                    </select>
                    @else
                     <select class="form-select form-control"  name="age_rating" id="age_rating" aria-label="Default select example">
                        <option>Select Category</option>
                        <option>Rated 4+: Contains no objectionable material</option>
                        <option>Rated 9+: May contain content unsuitable for children under the age of 9</option>
                        <option>Rated 12+: May contain content unsuitable for children under the age of 12</option>
                        <option>Rated 17+: May contain content unsuitable for children under the age of 17</option>
                    </select>
                    @endif
                    @else
                    <select class="form-select form-control"  name="age_rating" id="age_rating" aria-label="Default select example">
                        <option>Select Category</option>
                        <option>Rated 4+: Contains no objectionable material</option>
                        <option>Rated 9+: May contain content unsuitable for children under the age of 9</option>
                        <option>Rated 12+: May contain content unsuitable for children under the age of 12</option>
                        <option>Rated 17+: May contain content unsuitable for children under the age of 17</option>
                    </select>
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">App countries</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <div class="row">
                        @if(!is_null($store))
                            @if($store->app_country == "worldwide")
                            <div class="col-md-6">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1" onchange="launch_worldwide()" class="custom-control-input" checked>
                                <label class="custom-control-label" for="customRadioInline1">Launch Worldwide</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1"  onchange="select_country()" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Select Country</label>
                            </div>
                            @else
                            <div class="col-md-6">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1" onchange="launch_worldwide()" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">Launch Worldwide</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1"  onchange="select_country()" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Select Country</label>
                            </div>
                            @endif
                        @else
                            <div class="col-md-6">
                                <input type="radio" id="customRadioInline1" name="customRadioInline1" onchange="launch_worldwide()" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">Launch Worldwide</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="customRadioInline2" name="customRadioInline1"  onchange="select_country()" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Select Country</label>
                            </div>
                        @endif
                        </div>
                    </div>

                    <div class="store_app_country">
                    @if(!is_null($store))
                    @if(!is_null($store->app_country))
                    <input type="text" id="country_selector" class="form-control" name="app_country" placeholder="select country" value="{{$store->app_country}}">
                    @else
                    <input type="text" id="country_selector" class="form-control" name="app_country" placeholder="select country" value="United Kingdom">
                    @endif
                    @else
                    <input type="text" id="country_selector" class="form-control" name="app_country" placeholder="select country" value="United Kingdom">
                    @endif
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="">Privacy Policy URL</label>
                    @if(!is_null($store))
                    @if(!is_null($store->privacy_policy_url))
                    <input type="url" class="form-control" name="privacy_policy_url" id="privacy_policy_url" placeholder="Privacy Policy URL" value="{{$store->privacy_policy_url}}">
                    @else
                    <input type="url" class="form-control" name="privacy_policy_url" id="privacy_policy_url" placeholder="Privacy Policy URL">
                    @endif
                    @else
                    <input type="url" class="form-control" name="privacy_policy_url" id="privacy_policy_url" placeholder="Privacy Policy URL">
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">Primary Language</label>
                    @if(!is_null($store))
                     @if(!is_null($store->primary_language))
                    <input type="text" class="form-control" name="primary_language" id="primary_language" placeholder="Primary Language" value="{{$store->primary_language}}">
                       @else
                    <input type="text" class="form-control" name="primary_language" id="primary_language" placeholder="Primary Language">
                    @endif
                    @else
                    <input type="text" class="form-control" name="primary_language" id="primary_language" placeholder="Primary Language">
                    @endif
                    </div>
                    
                    <div class="form-group">
                    <label for="">Primary Category of app</label>
                    <p>For more categories <a href="//developer.apple.com/app-store/categories/"> click here</a></p>
                    @if(!is_null($store))
                    @if(!is_null($store->primary_app_category))                   
                    <select class="form-select form-control"  name="primary_app_category" id="primary_app_category" aria-label="Default select example">
                        <option {{$store->primary_app_category == "" ? "selected" : ""}}>Select Category</option>
                        <option {{$store->primary_app_category == "Books" ? "selected" : ""}}>Books</option>
                        <option {{$store->primary_app_category == "Medical" ? "selected" : ""}}>Medical</option>
                        <option {{$store->primary_app_category == "Business" ? "selected" : ""}}>Business</option>
                        <option {{$store->primary_app_category == "Music" ? "selected" : ""}}>Music</option>
                        <option {{$store->primary_app_category == "Developer tools" ? "selected" : ""}}>Developer tools</option>
                        <option {{$store->primary_app_category == "Navigation" ? "selected" : ""}}>Navigation</option>
                        <option {{$store->primary_app_category == "Education" ? "selected" : ""}}>Education</option>
                        <option {{$store->primary_app_category == "Entertainment" ? "selected" : ""}}>Entertainment</option>
                        <option {{$store->primary_app_category == "Finance" ? "selected" : ""}}>Finance</option>
                        <option {{$store->primary_app_category == "Photo and Video" ? "selected" : ""}}>Photo and Video</option>
                        <option {{$store->primary_app_category == "Food and drink" ? "selected" : ""}}>Food and drink</option>
                        <option {{$store->primary_app_category == "Productivity" ? "selected" : ""}}>Productivity</option>
                        <option {{$store->primary_app_category == "Reference" ? "selected" : ""}}>Reference</option>
                        <option {{$store->primary_app_category == "Games" ? "selected" : ""}}>Games</option>
                        <option {{$store->primary_app_category == "Graphics and design" ? "selected" : ""}}>Graphics and design</option>
                        <option {{$store->primary_app_category == "Shopping" ? "selected" : ""}}>Shopping</option>
                        <option {{$store->primary_app_category == "Health and fitness" ? "selected" : ""}}>Health and fitness</option>
                        <option {{$store->primary_app_category == "Social networking" ? "selected" : ""}}>Social networking</option>    
                        <option {{$store->primary_app_category == "Lifestyle" ? "selected" : ""}}>Lifestyle</option>
                        <option {{$store->primary_app_category == "Sports" ? "selected" : ""}}>Sports</option>
                        <option {{$store->primary_app_category == "Travel" ? "selected" : ""}}>Travel</option>
                        <option {{$store->primary_app_category == "Kids" ? "selected" : ""}}>Kids</option>
                        <option {{$store->primary_app_category == "Magazine and newspapers" ? "selected" : ""}}>Magazine and newspapers</option>
                        <option {{$store->primary_app_category == "Utilities" ? "selected" : ""}}>Utilities</option>
                        <option {{$store->primary_app_category == "Weather" ? "selected" : ""}}>Weather</option>
                    </select>  
                    @else
                    <select class="form-select form-control"  name="primary_app_category" id="primary_app_category" aria-label="Default select example">
                        <option selected>Select Category</option>
                        <option>Books</option>
                        <option>Medical</option>
                        <option>Business</option>
                        <option>Music</option>
                        <option>Developer tools</option>
                        <option>Navigation</option>
                        <option>Education</option>
                        <option>Entertainment</option>
                        <option>Finance</option>
                        <option>Photo and Video</option>
                        <option>Food and drink</option>
                        <option>Productivity</option>
                        <option>Reference</option>
                        <option>Games</option>
                        <option>Graphics and design</option>
                        <option>Shopping</option>
                        <option>Health and fitness</option>
                        <option>Social networking</option>    
                        <option>Lifestyle</option>
                        <option>Sports</option>
                        <option>Travel</option>
                        <option>Kids</option>
                        <option>Magazine and newspapers</option>
                        <option>Utilities</option>
                        <option>Weather</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="primary_app_category" id="primary_app_category" placeholder="Primary App Category"> -->
                    @endif
                    @else
                    <select class="form-select form-control"  name="primary_app_category" id="primary_app_category" aria-label="Default select example">
                        <option selected>Select Category</option>
                        <option>Books</option>
                        <option>Medical</option>
                        <option>Business</option>
                        <option>Music</option>
                        <option>Developer tools</option>
                        <option>Navigation</option>
                        <option>Education</option>
                        <option>Entertainment</option>
                        <option>Finance</option>
                        <option>Photo and Video</option>
                        <option>Food and drink</option>
                        <option>Productivity</option>
                        <option>Reference</option>
                        <option>Games</option>
                        <option>Graphics and design</option>
                        <option>Shopping</option>
                        <option>Health and fitness</option>
                        <option>Social networking</option>    
                        <option>Lifestyle</option>
                        <option>Sports</option>
                        <option>Travel</option>
                        <option>Kids</option>
                        <option>Magazine and newspapers</option>
                        <option>Utilities</option>
                        <option>Weather</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="primary_app_category" id="primary_app_category" placeholder="Primary App Category"> -->
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">Secondary Category of app</label>
                    <p>For more categories <a href="//developer.apple.com/app-store/categories/"> click here</a></p>
                    @if(!is_null($store))
                    @if(!is_null($store->secondary_app_category))
                    <select class="form-select form-control"  name="secondary_app_category" id="secondary_app_category" aria-label="Default select example">
                        <option {{$store->secondary_app_category == "" ? "selected" : ""}}>Select Category</option>
                        <option {{$store->secondary_app_category == "Books" ? "selected" : ""}}>Books</option>
                        <option {{$store->secondary_app_category == "Medical" ? "selected" : ""}}>Medical</option>
                        <option {{$store->secondary_app_category == "Business" ? "selected" : ""}}>Business</option>
                        <option {{$store->secondary_app_category == "Music" ? "selected" : ""}}>Music</option>
                        <option {{$store->secondary_app_category == "Developer tools" ? "selected" : ""}}>Developer tools</option>
                        <option {{$store->secondary_app_category == "Navigation" ? "selected" : ""}}>Navigation</option>
                        <option {{$store->secondary_app_category == "Education" ? "selected" : ""}}>Education</option>
                        <option {{$store->secondary_app_category == "Entertainment" ? "selected" : ""}}>Entertainment</option>
                        <option {{$store->secondary_app_category == "Finance" ? "selected" : ""}}>Finance</option>
                        <option {{$store->secondary_app_category == "Photo and Video" ? "selected" : ""}}>Photo and Video</option>
                        <option {{$store->secondary_app_category == "Food and drink" ? "selected" : ""}}>Food and drink</option>
                        <option {{$store->secondary_app_category == "Productivity" ? "selected" : ""}}>Productivity</option>
                        <option {{$store->secondary_app_category == "Reference" ? "selected" : ""}}>Reference</option>
                        <option {{$store->secondary_app_category == "Games" ? "selected" : ""}}>Games</option>
                        <option {{$store->secondary_app_category == "Graphics and design" ? "selected" : ""}}>Graphics and design</option>
                        <option {{$store->secondary_app_category == "Shopping" ? "selected" : ""}}>Shopping</option>
                        <option {{$store->secondary_app_category == "Health and fitness" ? "selected" : ""}}>Health and fitness</option>
                        <option {{$store->secondary_app_category == "Social networking" ? "selected" : ""}}>Social networking</option>    
                        <option {{$store->secondary_app_category == "Lifestyle" ? "selected" : ""}}>Lifestyle</option>
                        <option {{$store->secondary_app_category == "Sports" ? "selected" : ""}}>Sports</option>
                        <option {{$store->secondary_app_category == "Travel" ? "selected" : ""}}>Travel</option>
                        <option {{$store->secondary_app_category == "Kids" ? "selected" : ""}}>Kids</option>
                        <option {{$store->secondary_app_category == "Magazine and newspapers" ? "selected" : ""}}>Magazine and newspapers</option>
                        <option {{$store->secondary_app_category == "Utilities" ? "selected" : ""}}>Utilities</option>
                        <option {{$store->secondary_app_category == "Weather" ? "selected" : ""}}>Weather</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="secondary_app_category" id="secondary_app_category" placeholder="Secondary App Category" value="{{$store->secondary_app_category}}"> -->
                    @else
                    <select class="form-select form-control"  name="secondary_app_category" id="secondary_app_category" aria-label="Default select example">
                        <option selected>Select Category</option>
                        <option>Books</option>
                        <option>Medical</option>
                        <option>Business</option>
                        <option>Music</option>
                        <option>Developer tools</option>
                        <option>Navigation</option>
                        <option>Education</option>
                        <option>Entertainment</option>
                        <option>Finance</option>
                        <option>Photo and Video</option>
                        <option>Food and drink</option>
                        <option>Productivity</option>
                        <option>Reference</option>
                        <option>Games</option>
                        <option>Graphics and design</option>
                        <option>Shopping</option>
                        <option>Health and fitness</option>
                        <option>Social networking</option>    
                        <option>Lifestyle</option>
                        <option>Sports</option>
                        <option>Travel</option>
                        <option>Kids</option>
                        <option>Magazine and newspapers</option>
                        <option>Utilities</option>
                        <option>Weather</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="secondary_app_category" id="secondary_app_category" placeholder="Secondary App Category"> -->
                    @endif
                    @else
                    <select class="form-select form-control"  name="secondary_app_category" id="secondary_app_category" aria-label="Default select example">
                        <option selected>Select Category</option>
                        <option>Books</option>
                        <option>Medical</option>
                        <option>Business</option>
                        <option>Music</option>
                        <option>Developer tools</option>
                        <option>Navigation</option>
                        <option>Education</option>
                        <option>Entertainment</option>
                        <option>Finance</option>
                        <option>Photo and Video</option>
                        <option>Food and drink</option>
                        <option>Productivity</option>
                        <option>Reference</option>
                        <option>Games</option>
                        <option>Graphics and design</option>
                        <option>Shopping</option>
                        <option>Health and fitness</option>
                        <option>Social networking</option>    
                        <option>Lifestyle</option>
                        <option>Sports</option>
                        <option>Travel</option>
                        <option>Kids</option>
                        <option>Magazine and newspapers</option>
                        <option>Utilities</option>
                        <option>Weather</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="secondary_app_category" id="secondary_app_category" placeholder="Secondary App Category"> -->
                    @endif
                    </div>

                    <div class="form-group">
                    <label for="">Price of App</label>
                    @if(!is_null($store))
                     @if(!is_null($store->app_price))
                    <input type="text" class="form-control" name="app_price" id="app_price" placeholder="Enter App Price" value="{{$store->app_price}}">
                       @else
                    <input type="text" class="form-control" name="app_price" id="app_price" placeholder="Enter App Price">
                    @endif
                    @else
                    <input type="text" class="form-control" name="app_price" id="app_price" placeholder="Enter App Price">
                    @endif
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">First Name</label>
                        @if(!is_null($store))
                        @if(!is_null($store->first_name))
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{$store->first_name}}">
                        @else
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                        @endif
                        @else
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                        @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Last Name</label>
                        @if(!is_null($store))
                        @if(!is_null($store->last_name))
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{$store->last_name}}">
                        @else
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                        @endif
                        @else
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                        @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Email</label>
                        @if(!is_null($store))
                        @if(!is_null($store->email))
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{$store->email}}">
                        @else
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        @endif
                        @else
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Contact No.</label>
                        @if(!is_null($store))
                        @if(!is_null($store->number))
                        <input type="number" class="form-control" name="number" id="number" placeholder="Number" value="{{$store->number}}">
                        @else
                        <input type="number" class="form-control" name="number" id="number" placeholder="Number">
                        @endif
                        @else
                        <input type="number" class="form-control" name="number" id="number" placeholder="Number">
                        @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="">Address</label>
                        @if(!is_null($store))
                        @if(!is_null($store->address))
                        <textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="4">{{$store->address}}</textarea required>
                        @else
                        <textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="4"></textarea required>
                        @endif
                        @else
                        <textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="4"></textarea required>
                        @endif
                        </div>
                    </div>

                    </div>

                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
