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
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <h2 class="fw-bold mb-5">Login now</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                      <label class="form-label" for="form3Example1">Email</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                      <label class="form-label" for="form3Example2">Password</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                </div>
              </div>
  

              <div class="row">
                
                <div class="col-md-6 mb-4 ml-4 ">
                  <div class="form-outline d-flex justify-content-start ">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>
           
              
              
              <!-- Submit button -->
              <div class="d-flex  p-0 justify-content-start" >
                 <div>
                    <button type="submit" class="btn alazea-btn mb-4">
                       Login
                      </button>
                      
                 </div>
              </div>

              <div class="d-flex  p-0 justify-content-start" >
                <div>
                    @if (Route::has('password.request'))
                        <a class=" text-success btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a class="ml-2 text-success btn-link" href="{{ route('register') }}">
                            {{ __('Don\'t have an Account?  Register') }}
                        </a>
                    @endif
                </div>
             </div>
  
              <!-- Register buttons -->
              {{-- <div class="text-center">
                <p>or sign up with:</p>
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>
  
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-google"></i>
                </button>
  
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>
  
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-github"></i>
                </button>
              </div> --}}
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
@endsection
