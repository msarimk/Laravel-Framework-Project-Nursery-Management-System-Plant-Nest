@extends('layouts.auth')

@section('content')
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="
          background-image: url({{asset('web/img/bg-img/24.jpg')}});
          height: 350px;
          "></div>
    <!-- Background image -->
  
    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
          margin-top: -225px;
          background: hsla(0, 0%, 100%, 0.8);
          backdrop-filter: blur(30px);
          ">
          @if($errors->has('permission'))
          <ul class="list-unstyled l-social">
              <li><a class="text-white">{{ $errors->first('permission') }}</a></li>
          </ul> 
  @endif
      <div style="padding-top: 40px;padding-bottom:40px; " class="card-body  px-md-5">
        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <h2 class="fw-bold mb-5">Reset Password</h2>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row d-flex justify-content-center">

                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                      <label class="form-label" for="form3Example2">Email Address</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                </div>
              </div>

           
              
              
              <!-- Submit button -->
              <div class="d-flex  p-0 justify-content-center" >
                 <div>
                    <button type="submit" class="btn alazea-btn mb-4">
                        Send Password Reset Link
                      </button>
                      
                 </div>
              </div>

             </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
@endsection
