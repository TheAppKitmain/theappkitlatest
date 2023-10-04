@include('admin.template.partials.head')
@include('admin.template.partials.header')
@include('admin.template.Food_Delivery.partials.sidemenu')
      <!-- main start-->
      <main>
         <div class="main-home branding-page">
            <div class="main-wrapper main-wrapper-app-st">
               <div class="main-container">
                  <div class="main-container-inner">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-8 own-8-col">
                              <div class="row card owncard no-gutters m-t8">
                                 <div class="col-md-12">
                                    <div class="card-header text-center table-heading ">
                                 <h2>App Settings</h2>
                              </div>
                                   <div class="card-body card-body-own">
                                    <form  method ="POST" action="{{route('theme.app_settings.store')}}" enctype="multipart/form-data">
					                @csrf
                                    <div class="form-group">
									@if(Auth::user()->parent_id == 0)  
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->id}}">
								@else
								<input type="hidden" class="inputtemp form-control inputtemp" id="user_id" name="user_id" value="{{ Auth::user()->parent_id}}">     
								@endif            		                </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="template_id" value="{{$themetemplate->id}}">
                                    </div>
									<div class="form-group">
                                        <input type="hidden" class="form-control" name="template_name" value="{{$themetemplate->theme_name}}">
                                    </div>
                                    <div class="form-group">
                                        <div class="row no-gutters app-settings-row no-border">
                                        <div class="col-md-6">
                                        <div class="row no-gutters">
                                        <div class="col-md-12">
                                            <label class="lbh">Nav Background <a class="tooltip-btn" data-tooltip="Navigation background color" data-tooltip-location="right"> ?</a></label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                            <div class="col-md-12">
											<span class="colortitlename">Color</span>
											@if($appsetting == NULL)
												<input type="color" name="nav_bg_color" id="NavBgColor" value="#ffffff" onchange="navbgshow()">
											@elseif($appsetting->nav_bg_color !== "#ffffff")
												<input type="color" name="nav_bg_color" id="NavBgColor" value="{{$appsetting->nav_bg_color}}" onchange="navbgshow()">
											@else
												<input type="color" name="nav_bg_color" id="NavBgColor" value="#ffffff" onchange="navbgshow()">	
											@endif
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                         <div class="col-md-6">
                                         	<div class="row no-gutters">
                                         		<div class="col-md-12">
									    <label class="lbh">Screen Background <a class="tooltip-btn" data-tooltip="Screen background color" data-tooltip-location="right"> ?</a></label>
									   </div>
									   <div class="col-md-12">
									    <div class="row">
										<div class="col-md-12">
										<span class="colortitlename">Color</span>
										@if($appsetting == NULL)
											<input type="color" name="screen_bg_color" id="ScreenBgColor" value="#ffffff" onchange="screenbgshow()">
										@elseif($appsetting->screen_bg_color !== "#ffffff")
											<input type="color" name="screen_bg_color" id="ScreenBgColor" value="{{$appsetting->screen_bg_color}}" onchange="screenbgshow()">
										@else
											<input type="color" name="screen_bg_color" id="ScreenBgColor" value="#ffffff" onchange="screenbgshow()">
										@endif
										</div>
										</div>
									   </div>
                                            </div>
                                         </div>
                                        </div>
                                       
                                   
									<div class="row no-gutters app-settings-row">
									    <div class="col-md-6">
									    <div class="row no-gutters">
										   <div class="col-md-12">
											<label class="lbh">Nav Heading <a class="tooltip-btn" data-tooltip="App Navigation Color and font size" data-tooltip-location="right"> ?</a></label>
										   </div>
										   <div class="col-md-12">
											<div class="row">
											<div class="col-md-6">
											<span class="colortitlename">Color</span>
											@if($appsetting == NULL)
												<input type="color" name="nav_heading_color" id="NavHeadingColor"  onchange="navheadingshow()">
											@elseif($appsetting->nav_heading_color !== "#000000")
												<input type="color" name="nav_heading_color" id="NavHeadingColor" value="{{$appsetting->nav_heading_color}}" onchange="navheadingshow()">	
											@else
											  	<input type="color" name="nav_heading_color" id="NavHeadingColor"  onchange="navheadingshow()">
											@endif  
											</div>
											<div class="col-md-6">
											  <span class="colortitlename">Font Size</span>
											   <select  type="text" class="form-control select-inp" id="nav_heading_font" name="nav_heading_font" placeholder="select Font Size" onchange="navheadingfontshow()"> 
											@if($appsetting == NULL)
												<option selected="selected">20px</option>
													<option>18px</option>
													<option>16px</option>
													<option>14px</option>
													<option>12px</option>
												</select>
											@elseif($appsetting->nav_heading_font !== "20px")
												<option {{$appsetting->nav_heading_font == "20px" ? "selected" : ""}} >20px</option>
												<option {{$appsetting->nav_heading_font == "18px" ? "selected" : ""}} >18px</option>
												<option {{$appsetting->nav_heading_font == "16px" ? "selected" : ""}} >16px</option>
                                                <option {{$appsetting->nav_heading_font == "14px" ? "selected" : ""}} >14px</option>
                                                <option {{$appsetting->nav_heading_font == "12px" ? "selected" : ""}} >12px</option>
											</select>
											@else
											   <option selected="selected">20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option>14px</option>
                                                <option>12px</option>
											  </select>
											@endif
											</div>
											</div>
										   </div>
									   </div>
                                       </div>
                                       
									   <div class="col-md-6">
										<div class="row no-gutters">
										   <div class="col-md-12">
											<label class="lbh">Heading <a class="tooltip-btn" data-tooltip="App heading color and font size" data-tooltip-location="right"> ?</a></label>
										   </div>
										   <div class="col-md-12">
											<div class="row">
											<div class="col-md-6">
                                            <span class="colortitlename">Color</span>
												@if($appsetting == NULL)
													<input type="color" name="heading_color" id="HeadingColor"  onchange="headingshow()"> 
												@elseif($appsetting->heading_color !== "#000000")
													<input type="color" name="heading_color" id="HeadingColor"  value="{{$appsetting->heading_color}}"  onchange="headingshow()"> 
												@else
													<input type="color" name="heading_color" id="HeadingColor"  onchange="headingshow()">   
												@endif
											</div>
											<div class="col-md-6">
											  <span class="colortitlename">Font Size</span>
											   <select  type="text" class="form-control select-inp" placeholder="select Font Size" name="heading_font" id="heading_font" onchange="headingfontshow()">
											@if($appsetting == NULL)
											<option selected="selected">20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option>14px</option>
                                                <option>12px</option>
											  </select>
											@elseif($appsetting->heading_font !== "20px")
												<option {{$appsetting->heading_font == "20px" ? "selected" : ""}} >20px</option>
												<option {{$appsetting->heading_font == "18px" ? "selected" : ""}} >18px</option>
												<option {{$appsetting->heading_font == "16px" ? "selected" : ""}} >16px</option>
                                                <option {{$appsetting->heading_font == "14px" ? "selected" : ""}} >14px</option>
                                                <option {{$appsetting->heading_font == "12px" ? "selected" : ""}} >12px</option>
											</select>
											@else
											   <option selected="selected">20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option>14px</option>
                                                <option>12px</option>
											  </select>
											@endif
											</div>
											</div>
										   </div>
									   </div>
									   </div>
                                    </div>
                                   
                                    <div class="row no-gutters app-settings-row">
									    <div class="col-md-6">
									    <div class="row no-gutters">
										   <div class="col-md-12">
											<label class="lbh">Sub Heading  <a class="tooltip-btn" data-tooltip="App sub heading color and font size" data-tooltip-location="right"> ?</a></label>
										   </div>
										   <div class="col-md-12">
											<div class="row">
											<div class="col-md-6">
											<span class="colortitlename">Color</span>
											@if($appsetting == NULL)
											<input type="color" name="sub_heading_color" id="SubHeadingColor" onchange="subheadingshow()">
											@elseif($appsetting->sub_heading_color !== "#000000")
											<input type="color" name="sub_heading_color" id="SubHeadingColor" value="{{$appsetting->sub_heading_color}}" onchange="subheadingshow()">
											@else
											<input type="color" name="sub_heading_color" id="SubHeadingColor" onchange="subheadingshow()">
											@endif
											</div>
											<div class="col-md-6">
											  <span class="colortitlename">Font Size</span>
											   <select  type="text" class="form-control select-inp" id="sub_heading_font" name="sub_heading_font" placeholder="select Font Size" onchange="subheadingfontshow()">
											@if($appsetting == NULL)
											<option>20px</option>
												<option>18px</option>
												<option selected="selected">16px</option>
                                                <option>14px</option>
                                                <option>12px</option>
											  </select>
											@elseif($appsetting->sub_heading_font !== "16px")
												<option {{$appsetting->sub_heading_font == "20px" ? "selected" : ""}} >20px</option>
												<option {{$appsetting->sub_heading_font == "18px" ? "selected" : ""}} >18px</option>
												<option {{$appsetting->sub_heading_font == "16px" ? "selected" : ""}} >16px</option>
                                                <option {{$appsetting->sub_heading_font == "14px" ? "selected" : ""}} >14px</option>
                                                <option {{$appsetting->sub_heading_font == "12px" ? "selected" : ""}} >12px</option>
											</select>
											@else
											   <option>20px</option>
												<option>18px</option>
												<option selected="selected">16px</option>
                                                <option>14px</option>
                                                <option>12px</option>
											  </select>
											@endif
											</div>
											</div>
										   </div>
									   </div>
                                       </div>
                                      
									   <div class="col-md-6">
										<div class="row no-gutters">
										   <div class="col-md-12">
											<label class="lbh">Paragraph  <a class="tooltip-btn" data-tooltip="App paragraph color and font size" data-tooltip-location="right"> ?</a></label>
										   </div>
										   <div class="col-md-12">
											<div class="row">
											<div class="col-md-6">
											<span class="colortitlename">Color</span>
											@if($appsetting == NULL)
												<input type="color" name="paragraph_color" id="ParagraphColor" onchange="paragraphshow()">
											@elseif($appsetting->paragraph_color !== "#000000")
												<input type="color" name="paragraph_color" value="{{$appsetting->paragraph_color}}" id="ParagraphColor" onchange="paragraphshow()">
											@else
												<input type="color" name="paragraph_color" id="ParagraphColor" onchange="paragraphshow()">
											@endif
											</div>
											<div class="col-md-6">
											  <span class="colortitlename">Font Size</span>
											   <select  type="text" class="form-control select-inp" id="paragraph_font" name="paragraph_font" placeholder="select Font Size" onchange="paragraphfontshow()">
											@if($appsetting == NULL)
												<option>20px</option>
													<option>18px</option>
													<option>16px</option>
													<option selected="selected">14px</option>
													<option>12px</option>
												</select>
											@elseif($appsetting->paragraph_font !== "14px")
												<option {{$appsetting->paragraph_font == "20px" ? "selected" : ""}} >20px</option>
												<option {{$appsetting->paragraph_font == "18px" ? "selected" : ""}} >18px</option>
												<option {{$appsetting->paragraph_font == "16px" ? "selected" : ""}} >16px</option>
                                                <option {{$appsetting->paragraph_font == "14px" ? "selected" : ""}} >14px</option>
                                                <option {{$appsetting->paragraph_font == "12px" ? "selected" : ""}} >12px</option>
											</select>
											@else
											   <option>20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option selected="selected">14px</option>
                                                <option>12px</option>
											  </select>
											@endif
											</div>
											</div>
										   </div>
									   </div>
									   </div>
                                    </div>
                                  
									<div class="row no-gutters app-settings-row">
									   <div class="col-md-12">
									    <label class="lbh">Primary Button <a class="tooltip-btn" data-tooltip="Normal Button Settings" data-tooltip-location="right"> ?</a></label>
									   </div>
									   <div class="col-md-12">
									    <div class="row">
										<div class="col-md-4">
										<span class="colortitlename">Color</span>
										@if($appsetting == NULL)
											<input type="color" name="primary_btn_color" id="PrimaryBtnColor" value="#ffffff" onchange="primarybtnshow()">	
										@elseif($appsetting->primary_btn_color !== "#ffffff")
											<input type="color" name="primary_btn_color" id="PrimaryBtnColor" value="{{$appsetting->primary_btn_color}}" onchange="primarybtnshow()">
										@else
											<input type="color" name="primary_btn_color" id="PrimaryBtnColor" value="#ffffff" onchange="primarybtnshow()">
										@endif
										</div>
										<div class="col-md-4">
										  <span class="colortitlename">Font Size</span>
										   <select  type="text" class="form-control select-inp" id="primary_btn_font" name="primary_btn_font" placeholder="select Font Size" onchange="primarybtnfontshow()">
										   @if($appsetting == NULL)
										   <option>20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option>14px</option>
                                                <option selected="selected" >12px</option>
										  </select>
										   @elseif($appsetting->primary_btn_font !== "12px")
												<option {{$appsetting->primary_btn_font == "20px" ? "selected" : ""}} >20px</option>
												<option {{$appsetting->primary_btn_font == "18px" ? "selected" : ""}} >18px</option>
												<option {{$appsetting->primary_btn_font == "16px" ? "selected" : ""}} >16px</option>
                                                <option {{$appsetting->primary_btn_font == "14px" ? "selected" : ""}} >14px</option>
                                                <option {{$appsetting->primary_btn_font == "12px" ? "selected" : ""}} >12px</option>
											</select>
											@else 
										   		<option>20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option>14px</option>
                                                <option selected="selected" >12px</option>
										  </select>
										  @endif
										</div>
										<div class="col-md-4">
										  <span class="colortitlename">Background Color</span>
										  @if($appsetting == NULL)
										  	<input type="color" name="primary_btnbg_color" id="PrimaryBtnBgColor" value="#545454" onchange="primarybtnbgshow()">
										  @elseif($appsetting->primary_btnbg_color !== "#545454")
										  	<input type="color" name="primary_btnbg_color" id="PrimaryBtnBgColor" value="{{$appsetting->primary_btnbg_color}}" onchange="primarybtnbgshow()">
										  @else
										  <input type="color" name="primary_btnbg_color" id="PrimaryBtnBgColor" value="#545454" onchange="primarybtnbgshow()">
										  @endif
                                          
										</div>
										</div>
									   </div>
                                    </div>
                                    
									<div class="row no-gutters app-settings-row">
									   <div class="col-md-12">
                                        <label class="lbh">Success Button <a class="tooltip-btn" data-tooltip="Submit Button Settings" data-tooltip-location="right"> ?</a></label>		
									   </div>
									   <div class="col-md-12">
									    <div class="row">
										<div class="col-md-4">
										  <span class="colortitlename">Color</span>
										  @if($appsetting == NULL)
										  <input type="color" name="success_btn_color" id="SuccessBtnColor" value="#ffffff" onchange="successbtnshow()">
										  @elseif($appsetting->success_btn_color !== "#ffffff")
										  <input type="color" name="success_btn_color" id="SuccessBtnColor" value="{{$appsetting->success_btn_color}}" onchange="successbtnshow()">
										  @else
										  <input type="color" name="success_btn_color" id="SuccessBtnColor" value="#ffffff" onchange="successbtnshow()">
										  @endif
                                          
										</div>
										<div class="col-md-4">
										  <span class="colortitlename">Font Size</span>
										   <select  type="text" class="form-control select-inp" name="success_btn_font" id="success_btn_font" placeholder="select Font Size" onchange="successbtnfontshow()">
										   @if($appsetting == NULL)
											<option>20px</option>
													<option>18px</option>
													<option>16px</option>
													<option>14px</option>
													<option selected="selected" >12px</option>
											</select>
										   @elseif($appsetting->success_btn_font !== "12px")
												<option {{$appsetting->success_btn_font == "20px" ? "selected" : ""}} >20px</option>
												<option {{$appsetting->success_btn_font == "18px" ? "selected" : ""}} >18px</option>
												<option {{$appsetting->success_btn_font == "16px" ? "selected" : ""}} >16px</option>
                                                <option {{$appsetting->success_btn_font == "14px" ? "selected" : ""}} >14px</option>
                                                <option {{$appsetting->success_btn_font == "12px" ? "selected" : ""}} >12px</option>
											</select>
											@else 
										   		<option>20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option>14px</option>
                                                <option selected="selected" >12px</option>
										  </select>
										  @endif
										</div>
										<div class="col-md-4">
										  <span class="colortitlename">Background Color</span>
										  @if($appsetting == NULL)
										  <input type="color" name="success_btnbg_color" id="SuccessBtnBgColor" value="#65b939" onchange="successbtnbgshow()">
										  @elseif($appsetting->success_btnbg_color !== "#65b939")
										  <input type="color" name="success_btnbg_color" id="SuccessBtnBgColor" value="{{$appsetting->success_btnbg_color}}" onchange="successbtnbgshow()">
										  @else
										  <input type="color" name="success_btnbg_color" id="SuccessBtnBgColor" value="#65b939" onchange="successbtnbgshow()">
										  @endif
										</div>
										</div>
									   </div>
                                    </div>
                                   
									<div class="row no-gutters app-settings-row no-border">
									   <div class="col-md-12">
									    <label class="lbh">Danger Button <a class="tooltip-btn" data-tooltip="Delete Button Settings" data-tooltip-location="right"> ?</a></label>
									   </div>
									   <div class="col-md-12">
									    <div class="row">
										<div class="col-md-4">
										  <span class="colortitlename">Color</span>
										  @if($appsetting == NULL)
										  <input type="color" name="danger_btn_color" id="DangerBtnColor" value="#ffffff" onchange="dangerbtnshow()">
										  @elseif($appsetting->danger_btn_color !== "#ffffff")
										  <input type="color" name="danger_btn_color" id="DangerBtnColor" value="{{$appsetting->danger_btn_color}}" onchange="dangerbtnshow()">
										  @else
										  <input type="color" name="danger_btn_color" id="DangerBtnColor" value="#ffffff" onchange="dangerbtnshow()">
										  @endif
										  
                                            
										</div>
										<div class="col-md-4">
										  <span class="colortitlename">Font Size</span>
										   <select  type="text" class="form-control select-inp" name="danger_btn_font" id="danger_btn_font" placeholder="select Font Size" onchange="dangerbtnfontshow()">
                                           @if($appsetting == NULL)
										   <option>20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option>14px</option>
                                                <option selected="selected" >12px</option>
										  </select>
										   @elseif($appsetting->danger_btn_font !== "12px")
												<option {{$appsetting->danger_btn_font == "20px" ? "selected" : ""}} >20px</option>
												<option {{$appsetting->danger_btn_font == "18px" ? "selected" : ""}} >18px</option>
												<option {{$appsetting->danger_btn_font == "16px" ? "selected" : ""}} >16px</option>
                                                <option {{$appsetting->danger_btn_font == "14px" ? "selected" : ""}} >14px</option>
                                                <option {{$appsetting->danger_btn_font == "12px" ? "selected" : ""}} >12px</option>
											</select>
											@else 
										   		<option>20px</option>
												<option>18px</option>
												<option>16px</option>
                                                <option>14px</option>
                                                <option selected="selected" >12px</option>
										  </select>
										  @endif
										</div>
										<div class="col-md-4">
										  <span class="colortitlename">Background Color</span>
										  @if($appsetting == NULL)
										  <input type="color" name="danger_btnbg_color" id="DangerBtnBgColor" value="#da3c3c" onchange="dangerbtnbgshow()">
										  @elseif($appsetting->danger_btnbg_color !== "#da3c3c")
										  <input type="color" name="danger_btnbg_color" id="DangerBtnBgColor" value="{{$appsetting->danger_btnbg_color}}" onchange="dangerbtnbgshow()">
										  @else
										  <input type="color" name="danger_btnbg_color" id="DangerBtnBgColor" value="#da3c3c" onchange="dangerbtnbgshow()">
										  @endif
										</div>
										</div>
									   </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                       <button class="savebtn savebtnown">Save</button>
                                    </div>
                                    </from>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-4 own-4-col">
                              <div class="preview-box">
                                 <h2 class="text-center preview-title "><img class="" src="{{asset('asset/images/eyeimage.png')}}" alt="eyeimage">Preview</h2>
                                 <div class="tutorial-video-box text-center">
                                    <div class="tutorial-video-box-inner">

									@if(!isset($appsetting))
                                       <div class="preview-right-main-wrapper">
									      <div class="appbgcolor" id="screen_bg"></div>
                                          <div class="previewbox-inner "> 
											<div class="previewbox-inner-changes row no-gutters heading-setting">
												<div class="navheading col-md-12" id="nav_background">
                                                    <h5 id="theme_nav_heading"> Nav Heading </h5>
												</div>
											</div>
											<div class="previewbox-inner-changes row no-gutters heading-setting">
												<div class="heading col-md-12">
                                                    <h4 id="theme_heading"> Heading </h4> 
												</div>		
											</div>
											<div class="previewbox-inner-changes row no-gutters heading-setting">
												<div class="subheading col-md-12">
                                                    <h6 id="theme_sub_heading">Sub Heading</h6>
												</div>	
											</div>
											<div class="previewbox-inner-changes row no-gutters heading-setting">
												<div class="peragraph col-md-12">
                                                    <p id="theme_paragraph"> Paragraph </p>
												</div>												
											</div>
											<div class="previewbox-inner-changes row no-gutters">
												<div class=" col-md-12">
													<button class="primary-button btn-width" id="primary_button">Primary Button</button>
												</div>
												<div class="col-md-12">
												  <button class="seccess-button btn-width" id="success_button">Success Button</button>
												</div>
												<div class="col-md-12">
												   <button class="danger-button btn-width" id="danger_button">Cancel Button</button>
												</div>
											</div>

										  </div>
									   </div>
									@else
									<div class="preview-right-main-wrapper">
									      <div class="appbgcolor" id="screen_bg" style="background-color:{{$appsetting->screen_bg_color}}">
                                          <div class="previewbox-inner "> 
											<div class="previewbox-inner-changes row no-gutters heading-setting">
												<div class="navheading col-md-12" id="nav_background" style="background-color:{{$appsetting->nav_bg_color}}">
                                                    <h5 id="theme_nav_heading" style="color:{{$appsetting->nav_heading_color}};font-size:{{$appsetting->nav_heading_font}};"> Nav Heading </h5>
												</div>
											</div>
											<div class="previewbox-inner-changes row no-gutters heading-setting">
												<div class="heading col-md-12">
                                                    <h4 id="theme_heading" style="color:{{$appsetting->heading_color}};font-size:{{$appsetting->heading_font}};"> Heading </h4> 
												</div>		
											</div>
											<div class="previewbox-inner-changes row no-gutters heading-setting">
												<div class="subheading col-md-12">
                                                    <h6 id="theme_sub_heading" style="color:{{$appsetting->sub_heading_color}};font-size:{{$appsetting->sub_heading_font}};">Sub Heading</h6>
												</div>	
											</div>
											<div class="previewbox-inner-changes row no-gutters heading-setting">
												<div class="peragraph col-md-12">
                                                    <p id="theme_paragraph"  style="color:{{$appsetting->paragraph_color}};font-size:{{$appsetting->paragraph_font}};"> Paragraph </p>
												</div>												
											</div>
											<div class="previewbox-inner-changes row no-gutters">
												<div class=" col-md-12">
													<button class="primary-button btn-width" id="primary_button" style="color:{{$appsetting->primary_btn_color}};font-size:{{$appsetting->primary_btn_font}};background-color:{{$appsetting->primary_btnbg_color}};">Primary Button</button>
												</div>
												<div class="col-md-12">
												  <button class="seccess-button btn-width" id="success_button" style="color:{{$appsetting->success_btn_color}};font-size:{{$appsetting->success_btn_font}};background-color:{{$appsetting->success_btnbg_color}};">Success Button</button>
												</div>
												<div class="col-md-12">
												   <button class="danger-button btn-width" id="danger_button" style="color:{{$appsetting->danger_btn_color}};font-size:{{$appsetting->danger_btn_font}};background-color:{{$appsetting->danger_btnbg_color}};">Danger Button</button>
												</div>
											</div>
										  </div>
									   </div>
									@endif

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
      </main>
@include('admin.template.partials.footer')