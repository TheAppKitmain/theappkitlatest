@include('admin.custom.partials.head')
@include('admin.custom.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
   <div class="row clearfix">
      <div class="col-md-12">
         <div class="mt-20">
            <div class="card-header mb-20">
               <h2>My App Stores</h2>
            </div>
            <ul class="nav nav-tabs customnvtab mt-20" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" required>iOS Store</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" required>Android Store</a>
               </li>
            </ul>
            <div class="tab-content custom-tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
               <div class="card-body">
               
               <h4>
               To get your App in the store our team needs to gain access to your App store account.
               </h4>
               <h5 class="bold-h">Follow these steps:</h5>
               <br>
               <ul class="follow-step">
                Click the link below and follow these simple steps - <a class="linka" target="_blank" href="https://developer.apple.com/programs/enroll/">https://developer.apple.com/programs/enroll/</a>
                   
                   <li>1) Go to the Apple Developer Program enrollment page and click Start Your Enrollment.</li>
                   <li>2) Log in with your Apple ID and password.</li>
                   <li>3) When prompted to verify your identity, enter the verification code sent to your Apple ID email address and click Continue.</li>                     
                   <li>4) From the Entity Type list, select Company/Organization and click Continue.</li> 
                   <li>5) Under Authority to Sign Legal Agreements, select the appropriate option:<br>  </li>
                        <br>
                        - I am the owner/founder and have the authority to bind my organization to legal agreements –  Upon selection, Your Work Email field will be displayed. Enter your business email address; you must use a private domain name (e.g., email@yourbusiness.com). You cannot use Gmail, Hotmail, Yahoo, or any other email addresses from common email service providers.<br>
                          <br>
                        - My organization has given me the authority to bind it to legal agreements  –  Apple will contact a senior employee at your organization to confirm enrollment. Under Verification Contact enter the employee’s contact information.

                 
                    <li>6) Under Organization Information, enter the information for your organization:
                        <ul class="stp-ul">
                            <li>a) In the Legal Entity Name field, enter the name of your business as it appears in the D-U-N-S lookup. Your enrollment will not be successful if the legal entity name does not match the one in the D&B profile.</li>
                            <li>b) In the D-U-N-S Number field, enter the nine-digit D-U-N-S number assigned to your business. For more information on retrieving your D-U-N-S Number, see What is a D-U-N-S Number?</li>
                            <li>c) In the Website field, enter the website URL of your organization’s publicly available website with a domain name associated with your organization.
                            </li>  
                            <li>d)In the Headquarters Phone field, enter a phone number where Apple can reach you to confirm enrollment. Apple will call the number provided in this field to verify your enrollment.</li>  
                            <li>e)You can leave the Tax ID/National ID field blank.</li>
                            <li>f) Type the correct characters in the CAPTCHA and click Continue.<br><br>                            Note - If you receive an error message under the Legal Entity Name field, click update your D&B profile and submit your business’s information. You may continue this procedure once your profile has been updated.<br><br>
                            </li>

                        </ul>

                    </li>  
               </ul>
               <ul class="follow-step">
               <li>On the Summary for Review page, review and confirm the information. </li>

       <li>After submitting your application, Apple will contact you to verify your enrollment. A confirmation email will be sent to your Apple ID email address with a link enclosed to confirm and pay for your developer membership. The $99 (USD) membership is billed annually.</li></ul><br><br>


               <h4 class="note-txt"> <b>After Account Approval - Allow us Access</b></h4>
                <ul class="follow-step">

                <li> 1)  Log into your App store - https://developer.apple.com/</li>

                <li> 2) Click App Store Connect</li>

                <li> 3) Click Users and Access</li>

                <li>4) Add a new user to your account using these details
       <ul class="stp-ul">
                     <li> <strong> First Name </strong>- App</li>

                     <li> <strong> Last Name</strong> - Kit</li>

                     <li> <strong> Email</strong> - kylemckitty@me.com</li>
       </ul></li>
                <li>5) Select full admin access</li>

              </ul>

               <h4 class="note-txt">
               Note - Admin access allows us to correctly set up your account. 
               </h4>
                  <form method ="POST" action="{{route('app.appstore.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    @if(Auth::user()->parent_id == 0)  
                     <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                     @else
                     <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->parent_id}}">     
                     @endif                    
                     </div>
                    @if(!is_null($store))
                      @if(!is_null($store->done_ios))
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="done_ios" checked disabled>
                        <label class="custom-control-label" for="customCheck1">I have now given The App Kit access to my App store</label>
                      </div>
                      @else
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="done_ios" required>
                        <label class="custom-control-label" for="customCheck1">I have now given The App Kit access to my App store</label>
                      </div>
                      <div class="and_ios">
                       <div class="form-group">
                          <button type="submit" class="btn btn-primary">Save</button>
                       </div>
                    </div>
                      @endif
                    @else
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" name="done_ios" required>
                        <label class="custom-control-label" for="customCheck1">I have now given The App Kit access to my App store</label>
                      </div>
                      <div class="and_ios">
                       <div class="form-group">
                          <button type="submit" class="btn btn-primary">Save</button>
                       </div>
                    </div>
                    @endif
                 </form>
            </div>


               </div>
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               <div class="card-body">
              
               <h4>
               To get your App in the Google Play Store, Please follow these steps:
               </h4>
               <h5 class="bold-h">Follow these steps:</h5>
               <ul class="follow-step">
                   <li>Step 1: Sign up for a Google Play Developer account</li>
                   <li>Step 2: Accept the Developer Distribution Agreement</li>
                   <li>Step 3: Pay registration fee</li>
                   <li>Step 4: Complete your account details</li>   
                   
               </ul>
               <h4 class="note-txt"><b>After Account Approval - Allow us Access</b></h4>
               <ul class="follow-step">

                   <li>1) Log into your App store - <a class="linka" target="_blank" href="https://developer.android.com/distribute/console">https://developer.android.com/distribute/console</a></li>
                   <li>2) Click Users & Permissions</li>
                   <li>3) Click Invite new users</li>
                   <li>4) Add a new user to your account using these details  </li>   
                   <li>5) Add our email - documents@theappkit.co.uk</li> 
               </ul>
               <h4  class="note-txt">
               Note - Admin access allows us to correctly set up your account. 
               </h4>
               <form method ="POST" action="{{route('app.appstore.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id}}">
                    </div>
                    @if(!is_null($store))
                      @if(!is_null($store->done_android))
                      <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck2" name="done_android" checked disabled>
                      <label class="custom-control-label" for="customCheck2">I have now given The App Kit access to my App store</label>
                      </div>
                      @else
                      <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck2" name="done_android" required>
                      <label class="custom-control-label" for="customCheck2">I have now given The App Kit access to my App store</label>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                      @endif
                    @else
                      <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck2" name="done_android" required>
                      <label class="custom-control-label" for="customCheck2">I have now given The App Kit access to my App store</label>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    @endif
                    
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
</div>
</div>
@include('admin.custom.partials.footer')