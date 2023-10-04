@extends('appkit_frontend.layouts.main')
@section('content')

<div class="selectplan-container">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2>How would you like to build your app?</h2>
               </div>
               <div class="col-md-4">
                  <div class="selectplan">
                     <div class="selectplan-top">
                        <img class="selectplanimg" src="images/slectplan3.png">
                     </div>
                     <div class="selectplan-inner">
                        <h3>Shopify Mobile App</h3>
                        <h4>Turn your Shopify store into a mobile app. Let our team work magic!</h4>
                        <div class="btn-container mt-5 selectplan-btnbox">
                        @if(Auth::check()) 
                           <div class="btn-container mt-5 selectplan-btnbox">
                              <a class="btn-color btn-style" href="{{ URL::to('shopify_page') }}">Let's talk</a>
                           </div>
                           @else
                           <form method ="GET" action="{{route('register')}}">
                              <input type="hidden" id="name" name="name" value="shopify">
                              <button type="submit" class="btn-color btn-style lt_tk">Let's talk</button>
                           </form>
                           @endif                                                      
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="selectplan">
                     <div class="selectplan-top">
                        <img class="selectplanimg" src="images/slectplan.png">
                     </div>
                     <div class="selectplan-inner">
                        <h3>Select a modern template</h3>
                        <h4>Start building your app with our app builder platform. No coding required</h4>
                        <div class="btn-container mt-5 selectplan-btnbox">
                           <a class="btn-color btn-style" href="{{route('themes.index')}}">Select a Template</a>
                           <!-- <a class="btn-color btn-style" data-toggle="modal" data-target="#template_section">Select a Template</a> -->
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="selectplan">
                     <div class="selectplan-top">
                        <img class="selectplanimg" src="images/slectplan1.png">
                     </div>
                     <div class="selectplan-inner">
                        <h3>Create a custom App</h3>
                        <h4>Have our talented team build you a custom app for your business</h4>

                        <div class="btn-container mt-5 selectplan-btnbox">

                           @if(Auth::check()) 

                              <div class="btn-container mt-5 selectplan-btnbox">
                                 <a class="btn-color btn-style" href="{{ URL::to('home') }}">Let's talk</a>

                              </div>
                              
                           @else
                              <form method ="GET" action="{{route('register')}}">
                                 <input type="hidden" id="name" name="name" value="custom">
                                 <button type="submit" class="btn-color btn-style lt_tk">Let's talk</button>
                              </form>
                           @endif

                        </div>

                     </div>
                  </div>
               </div>
              
            </div>
         </div>
      </div>
      @endsection
     













      