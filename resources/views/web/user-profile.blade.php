@extends('layouts.profile')

@section('content')
<!-- <style>
    .active{
        color: #70c745 ;
    }
</style> -->
<section class="text-center">
    <style>
        .bg-image::after{
            background-color: rgba(17, 17, 17, 0.5) !important;
        }
    </style>
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url({{asset('web/img/bg-img/24.jpg')}});height: 350px;">
    </div>
    <!-- Background image -->
  
    <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -225px;background: hsla(0, 0%, 100%, 0.8);backdrop-filter: blur(30px);">
      <div style="padding-top: 40px;padding-bottom:40px; " class="card-body  px-md-5">
        <div class="">
        <div class="row mt-sm-4">
                            <div class="col-12 col-md-12 col-lg-4">
                                    <div class="card-header">
                                        <h4 class="m-0">Personal Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="py-4">
                                                    <p class="clearfix">
                                                        <span class="float-left">
                                                            Phone
                                                        </span>
                                                        <span class="float-right text-muted">
                                                          {{$users->phone}}
                                                        </span>
                                                    </p>
                                            <p class="clearfix">
                                                <span class="float-left">
                                                    Mail
                                                </span>
                                                <span class="float-right text-muted">
                                                {{$users->email}}
                                                </span>
                                            </p>
                                            <p class="clearfix">
                                                <span class="float-left">
                                                    Joined On
                                                </span>
                                                <span class="float-right text-muted">
                                                {{$users->joining_date}}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8">
                                    <div class="padding-20">
                                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                           
                                           @if(auth()->user()->is_admin == 0)
                                           <li class="nav-item">
                                                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                                   aria-selected="true">About</a>
                                            </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                                       aria-selected="false">Setting</a>
                                                </li>
                                            @endif
                                        </ul>
                                        <div class="tab-content tab-bordered" id="myTab3Content">
                                            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                                            <div class="card-header">
                                                            <h4 class="m-0">About Profile</h4>
                                                        </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-3 col-6 b-r ">
                                                        <strong>Full Name</strong>
                                                        <br>
                                                        <p class="text-muted">{{$users->name}}</p>
                                                    </div>
                                                            <div class="col-md-3 col-6">
                                                                <strong>Mobile</strong>
                                                                <br>
                                                                <p class="text-muted">{{$users->phone}}</p>
                                                            </div>
                                                    <div class="col-md-3 col-6 b-r">
                                                        <strong>Email</strong>
                                                        <br>
                                                        <p class="text-muted">{{$users->email}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                                <div class="tab-pane fade " id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                                    <form method="post" action="{{ route('editProfile') }}">
                                                        @csrf
                                                        <div class="card-header">
                                                            <h4 class="m-0">Edit Profile</h4>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{$users->id}}" >
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-12">
                                                                    <label>Name</label>
                                                                    <input required type="text" name="name" class="form-control" value="{{$users->name}}">
                                                                    <div class="invalid-feedback">
                                                                        Name cannot be empty
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6 col-12">
                                                                    <label>Email</label>
                                                                    <input required type="email" name="email" class="form-control" value="{{$users->email}}">
                                                                    <div class="invalid-feedback">
                                                                        Please fill the email
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-12">
                                                                    <label>Password</label>
                                                                    <input type="password" name="password" class="form-control">
                                                                    <div class="invalid-feedback">
                                                                        Please fill the Password
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-6 col-12">
                                                                    <label>Phone</label>
                                                                    <input required type="text" name="phone" class="form-control" value="{{$users->phone}}">
                                                                    <div class="invalid-feedback">
                                                                        Phone Required
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                           
                                                        </div>


                                                        <div class=" text-right">
                                                            <button type="submit" class="btn alazea-btn ">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                               
                                        <!-- <div class="tab-pane fade " id="privacy" role="tabpanel" aria-labelledby="profile-tab3">
                                            <div class="card-header">
                                                <h4>Edit Profile Privacy</h4>
                                            </div>
                                            <div style="padding-left:15px !important;" >
                                                
                                                    <label>Switched : <span >Public</span></label>
                                                
                                            </div>
                                            <div>
                                                
                                                    <div class="col-1 w-100 mt-2">
                                                        <form method="post" action="">
                                                            <input class="w-100" type="hidden" value="0" />
                                                            <button type="submit" class="btn btn-primary">Private</button>
                                                        </form>
                                                    </div>
                                                

                                            </div>
                                        </div> -->
                                            
                                        </div>
                                    </div>
                              
                            </div>
                        </div>
        </div>
      </div>
      
        <div class=" text-left">
            <a href="{{ route('home') }}"><button type="submit" class="btn alazea-btn ">BACK TO HOME</button></a> 
        </div>
    </div>
  </section>
  <!-- Section: Design Block -->
@endsection
