@extends('layouts/app')
@section('content')
@include('layouts/navbar_one')

<!---- Style to override emojiOneArea plugin ---->
<style>
  .custom-textarea {
      font-size: 12px;
      width:100%;
    height: 60px!important;
    border: 1px solid rgb(77, 213, 255, 0.8);
    border-radius: 5px;
      background-color:rgb(0, 141, 228, 0.1);
      padding-top:3px;
  }
  </style>
  <!----------------------------------------------->

<body>
  <section class="settings-section container">
    
    @if(session()->has('message'))
      <div class="pl-2" style="margin-top:-32px; margin-bottom:7px; height:25px;">
        <a href="{{ route('dashboard') }}" style="font-family:'montserrat',sans-serif; text-decoration:none; font-size:14px;">
          <i class="fas fa-angle-double-left mr-2"></i>Return to Dashboard
        </a>
        <a class="float-right" href="{{ $user->username }}" style="font-family:'montserrat',sans-serif; text-decoration:none; font-size:14px;">
        <i class="far fa-eye mr-2"></i>View my Page
        </a>
      </div>
    @endif

    <div class="wrapper border">
      
      <!-- acoordion start -->
      <div id="accordion">
        
        <!-- collapse one start -->
        <div class="card">

          <div class="accordion-card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="accordion-header-btn btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Basic information
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">

              <form class="main-form" action="{{ url('save_one') }}" method="post" enctype="multipart/form-data">
              @csrf
                <!-- change avatar start-->
                <div class="change-avatar-box" id="change-avatar">
                  <label class="label">
                  <input type="file" name="avatar" id="avatar">
                    <figure class="avatar-figure">

                      <img src="{{ Auth::user()->avatar_url }}" class="current-avatar">
                      <img src="" class="preview-new-avatar">
                    
                      <figcaption class="personal-figcaption">
                        <img src="{{ asset('images/upload-icon.png') }}">
                      </figcaption>

                    </figure>
                  </label>
                </div>
                @error('avatar')
                <div class="mb-2" style="text-align:center!important;">  
                <span style="color:red; font-size:13px;">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                  </span>
                </div>
                @enderror

                <script>
                  // avatar change script (edit profile) //
                  const file = document.getElementById("avatar");
                  const preview_container = document.getElementById("change-avatar");
                  const current_avatar = preview_container.querySelector(".current-avatar");
                  const preview_new_avatar = preview_container.querySelector(".preview-new-avatar");

                  avatar.addEventListener("change", function(){
                      const file = this.files[0];

                      if(file){
                          const reader = new FileReader();

                          current_avatar.style.display = "none";
                          preview_new_avatar.style.display = "block";

                          reader.addEventListener("load", function(){
                              preview_new_avatar.setAttribute("src",this.result);
                          });

                          reader.readAsDataURL(file);

                      }else{
                          current_avatar.style.display = null;
                          preview_new_avatar.style.display = null;
                          preview_new_avatar.setAttribute("src", "");
                      }
                  });

                </script>  
                <!-- change avatar end -->

                <div class="row">
                  
                  <!-- username input start -->
                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label for="username">Username</label>
                      <div class="input-group mb-1">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon3">http://tipmedash.com/</span>
                        </div>
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}" />
                      </div>
                      @error('username')
                          <span class="mt-1" style="color:red; font-size:13px;">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                          </span>
                      @enderror
                    </div>
                  </div>
                  <!-------------------------->

                  <!-- location input start -->
                  <div class="col-md-6">
                    <div class="form-group mb-1">
                      <label for="location">Location</label>
                      <input class="form-control" type="text" name="location" value="{{ $user->location }}"> 
                    </div>
                    @error('location')
                          <span style="color:red; font-size:13px;">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                          </span>
                    @enderror 
                  </div>
                  <!-------------------------->

                </div>
                
                <!--------------------- dash wallet address input ------------------------>
                <div class="form-group">
                  <label for="wallet_address">Dash wallet address </label>
                  <div class="input-group mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><img class="dash-icon" width="20" src="{{ asset('images/blue-dash-icon.png') }}"></span>
                    </div>

                    <!-- If user has a wallet address ---->
                    @if(Auth::user()->wallet_address)
                      <input class="form-control" type="text" name="wallet_address" value="{{ Auth::user()->wallet_address }}"/>
                    
                        <!-------------------
                        -- If user does not have a wallet address show the last one enetered 
                        -- (to avoid re-typing in case of form validation error).
                        -------------------->
                    @else
                      <input class="form-control" type="text" name="wallet_address" value="{{ old('wallet_address') }}"/>
                    @endif
                    <!----------------------------------->

                  </div>   
                  @error('wallet_address')
                    <span style="color:red; font-size:13px;">
                      <i class="fas fa-exclamation-circle"></i>
                      {{ $message }}
                    </span>
                  @enderror
                </div>
                <!------------------------------------------------------------------------->

                <button type="submit" class="save-changes-btn shadow-none btn btn-outline-primary"><i class="far fa-save mr-2"></i>Save changes</button>
              </form> 
            </div>
          </div>
        </div>
        <!-- collapse one end -->

        <!-- collapse two start -->
        <div class="card" >
          
          <div class="accordion-card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="accordion-header-btn btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                About me
              </button>
            </h5>
          </div>

          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
              
              <form class="main-form" action="{{ url('save_two') }}" method="post" enctype="multipart/form-data" >
              @csrf     
              
                <div class="row">

                  <!-- website input start -->
                  <div class="col-md-6">
                    <div class="form-group mb-1">
                      <label for="website">Website</label>
                      <input class="form-control" type="text" name="website" value="{{ $user->website }}">
                    </div>
                    @error('website')
                      <span style="color:red; font-size:13px;">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                      </span>
                    @enderror   
                  </div>  
                  <!---------------------------------->

                    <!-- passionate about input start -->
                    <div class="col-md-6">
                      <div class="form-group mb-1">
                        <label for="passionate_about">Passionate About</label>
                        <input class="form-control" type="text" name="passionate_about" value="{{ $user->passionate_about }}">
                      </div>  
                      @error('passionate_about')
                            <span style="color:red; font-size:13px;">
                              <i class="fas fa-exclamation-circle"></i>
                              {{ $message }}
                            </span>
                      @enderror        
                    </div>
                    <!------------------------->
                    
                </div><!-- end of first row -->

                <div class="row mt-2">

                  <!-- twitter input start -->
                  <div class="col-md-6">
                    <div class="form-group mb-1">
                      <label for="twitter">Twitter Username</label>
                      <div class="input-group mb-1">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1" style="padding-right:16px;">@</span>
                        </div>
                        <input class="form-control" type="text" name="twitter" value="{{ $user->twitter }}"> 
                      </div>
                    </div>
                    @error('twitter')
                          <span style="color:red; font-size:13px;">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                          </span>
                    @enderror 
                  </div>
                  <!-------------------------->  

                  <!-- github input start -->
                  <div class="col-md-6">
                    <div class="form-group mb-1">
                      <label for="github">Github Username</label>
                        <input class="form-control" name="github" type="text" value="{{ $user->github }}"> 
                    </div>
                    @error('github')
                          <span style="color:red; font-size:13px;">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                          </span>
                    @enderror 
                  </div>
                  <!--------------------------> 

                </div><!-- END of row -->
              
                <div class="row mt-2">

                  <!-- youtube input start -->
                  <div class="col-md-12">
                    <div class="form-group mb-1">
                      <label for="youtube">Youtube Channel</label>
                      <div class="input-group mb-1">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1" style="padding-right:16px;">
                            www.youtube.com/channel/
                          </span>
                        </div>
                        <input class="form-control" type="text" name="youtube" value="{{ $user->youtube }}"> 
                      </div>
                    </div>
                    @error('youtube')
                          <span style="color:red; font-size:13px;">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                          </span>
                    @enderror 
                  </div>
                  <!--------------------------> 

                </div><!-- END of row -->

                <div class="row mt-2">

                  <!-- about textarea -->
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="about">About</label>
                      
                      <!--------------------
                      remembers last text entered in 
                      about textarea (to avoid annoying re-typing in case of error)
                      -------------------->
                      @if(old('about'))
                        <textarea class="custom-textarea form-control" id="about-textarea" name="about" height="100">{{ old('about') }}</textarea>
                      @else
                        <textarea class="custom-textarea form-control" id="about-textarea" name="about" height="100">{{ $user->about }}</textarea>
                      @endif
                      @error('about')
                        <span style="color:red; font-size:13px;">
                          <i class="fas fa-exclamation-circle"></i>
                          {{ $message }}
                        </span>
                      @enderror 
                      <!------------------->

                      <!-- emoji plugin -->
                      <script>
                        $("#about-textarea").emojioneArea({
                            shortnames: true,
                            tones:false,
                            search:false,
                            pickerPosition: "top",
                            placeholder: "Type something here",
                            filters: {
                            flags : false,
                            animals_nature: false,
                            activity: false,
                            travel_places: false
                            }
                        });
                      </script>
                      <!------------------>
                    
                    </div>
                  </div><!-- END of about textarea -->
                </div><!-- END of row -->
               
                <button type="submit" class="save-changes-btn shadow-none btn btn-outline-primary"><i class="far fa-save mr-2"></i>Save changes</button>

              </form><!-- END of second form -->

            </div><!-- END of card body -->
          </div>
        </div><!-- END of collapse 2 -->
        

        <!-- collapse three start -->
        <div class="card">
          <div class="accordion-card-header" id="headingThree">
            <h5 class="mb-0">
              <button class="accordion-header-btn btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                
                @if($user->password === null)
                  Create password
                @else
                  Change password
                @endif
                
              
            </button>
            </h5>
          </div>

          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">
              
              @if($user->password === null)                  
                <div class="alert alert-primary" role="alert" style="font-size:13px;">
                <i class="fas fa-bell mr-2" style="font-size:17px;"></i> 
                You registered with google, that means you still haven't created
                a password for your account. 
                </div>                  
              @endif

              <form class="main-form" action="{{ route('change_password') }}" method="post">
              @csrf
                
              @if(Auth::user()->password != null)
                <div class="form-group">
                  <div class="input-group mt-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text pr-3" id="basic-addon3"><i class="fas fa-key mr-2"></i>Enter current password</span>
                    </div>
                    <input type="password" class="form-control" name="password" style="font-size:17px;">
                  </div>
                </div>
              @endif

                <div class="row">
                  <!-- new password input -->
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">New password</label>
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                    </div>
                    @error('new_password')
                          <span style="color:red; font-size:13px;">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                          </span>
                    @enderror
                  </div>
                  <!------------------------>

                  <!-- comfirm password input -->
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Retype new password</label>
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                    </div>
                    @error('new_confirm_password')
                          <span style="color:red; font-size:13px;">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                          </span>
                    @enderror
                  </div>  
                  <!---------------------------->

                </div><!-- end of row -->

                <button type="submit" class="save-changes-btn shadow-none btn btn-outline-primary"><i class="far fa-save mr-2"></i>Save changes</button>
                
              </form>

            </div>
          </div>
        </div>
        <!-- collapse three end -->

        <!-- collapse four start -->
        <div class="card">
          
          <div class="accordion-card-header" id="headingFour">
            <h5 class="mb-0">
              <button class="accordion-header-btn btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Change email
              </button>
            </h5>
          </div>

          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
            <div class="card-body">

              <!-- change email -->
              <form action="{{ route('change_email') }}" method="post">
              @csrf  
                
                <div class="row">
                 
                  <div class="col-md-6">
                    <div class="form-group mb-1">
                      <label for="new_email">New email address</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon3"><i class="far fa-envelope pr-1 pl-1"></i></span>
                        </div>
                        <input type="text" class="form-control" name="email"/>
                      </div>
                    </div>
                    @error('email')
                      <div class="mb-2" style="color:red; font-size:13px;">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group mb-1">
                        <label for="confirm_new_email">Retype email</label>
                        <input id="confirm_new_email" type="text" class="form-control" name="confirm_new_email">
                    </div>
                    @error('confirm_new_email')
                    <div class="mb-2" style="color:red; font-size:13px;">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                      </div>
                    @enderror
                  </div>  

                </div>

                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text pr-3" id="basic-addon3"><i class="fas fa-key mr-2"></i>Enter password</span>
                    </div>
                    <input type="password" class="form-control" name="password">
                </div>                

                <button type="submit" class="save-changes-btn shadow-none btn btn-outline-primary mt-4">
                  <i class="far fa-envelope mr-2"></i>Change email
                </button>

                <div class="alert alert-warning mt-3" role="alert" style="font-size:13px;">
                  <b>Warning</b>: once the email is changed, you won't have access 
                  to your account until you've verified the new email address. Make
                  sure all the information is correct, this action cannot be undone.
                </div>
              
              </form>
              <!--end of change email --->

            </div>
          </div>
        </div>
        <!-- collapse four end -->                        

        <!-- collapse five start -->
        <div class="card">
          
          <div class="accordion-card-header" id="headingFive">
            <h5 class="mb-0">
              <button class="accordion-header-btn btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                Delete account
              </button>
            </h5>
          </div>

          <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
            <div class="card-body">

              <!-- delete acc -->
              <form action="{{ route('delete_acc') }}" method="post" enctype="multipart/form-data">
              @csrf

                <div class="form-group mt-0 mb-2">
                  <label>Want to delete your account?</label>
                  <div class="input-group mt-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text pr-3" id="basic-addon3"><i class="fas fa-key mr-2"></i>Enter password</span>
                    </div>
                    <input type="password" class="form-control" name="password" style="font-size:17px;"/>
                  </div>
                </div>
               
                <button type="submit" class="btn btn-danger mt-3" id="other-settings-btns">
                  <i class="fas fa-trash-alt mr-2"></i>Delete account
                </button>
              
                <div class="alert alert-warning mt-3" role="alert" style="font-size:13px;">
                  <b>Warning</b>: account deletion cannot be undone.
                </div>

              </form>
              <!---- end of delete acc ---------->      

            </div>
          </div>
        </div>
        <!-- collapse five end -->       
                                
      </div>
      <!-- accordion end -->
    
      <!-- accordion scripts start -->
      <script>
       
        $(document).ready(function() {
          var last=Cookies.get('activeAccordionGroup');
          if (last!=null) {
              //remove default collapse settings
              $("#accordion .collapse").removeClass('show');
              //show the last visible group
              $("#"+last).collapse("show");
          }
        });

        //when a group is shown, save it as the active accordion group
        $("#accordion").bind('shown.bs.collapse', function() {
            var active=$("#accordion .show").attr('id');
            Cookies.set('activeAccordionGroup', active);
        });

      </script>
      <!-- accordion scripts end -------->                            

    </div>
    <!-- wrapper end -->

                              

  </section>
</body>
@endsection