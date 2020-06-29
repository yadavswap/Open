@section('title', 'Login')
@include('theme.head')

@include('admin.message')

<!-- end head -->
<!-- body start-->
<body>
<!-- top-nav bar start-->
<section id="nav-bar" class="nav-bar-main-block nav-bar-main-block-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                
            </div>
            <div class="col-lg-4">
                <div class="logo text-center btm-10">
                    @php
                        $logo = App\Setting::first();
                    @endphp

                    @if($logo->logo_type == 'L')
                        <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$logo->logo) }}" class="img-fluid" alt="logo"></a>
                    @else()
                        <a href="{{ url('/') }}"><b><div class="logotext">Login To Portal</div></b></a>
                    @endif
                </div>
            </div>
          
        </div>
    </div>
    <hr>
</section>

<!-- top-nav bar end-->
<!-- Signup start-->
<section id="signup" class="signup-block-main-block">
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="signup-heading">
                {{ __('frontstaticword.LogIntoYour') }} {{ __('frontstaticword.Account') }}!
            </div>

            <div class="signup-block">

               

                <form method="POST" class="signup-form" action="{{ route('login') }}">
                    @csrf
                 
                    <div class="form-group">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter Your E-Mail"   name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter Your Password" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit"  class="btn btn-primary">
                            {{ __('frontstaticword.Login') }}
                        </button>
                        <br>
                        <br>

                        <div class="forgot-password text-center btm-20"><a href="{{ 'password/reset' }}" title="sign-up">{{ __('frontstaticword.ForgotPassword') }}</a>
                        </div>

                    </div>


                  
                    <hr>
                   
                    <div class="row mt-2">
                        <div class="col-md-4">
                        </div>

                       <div class="col-md-4">
                <div class="nav-bar-btn btm-20">
                    <a href="{{ url('/') }}" class="btn btn-secondary" title="Home"><i class="fa fa-chevron-left"></i>{{ __('frontstaticword.Backtohome') }}</a>
                </div>
            </div>
            <div class="col-md-4">
            </div>
        </div>
                            
                </form>
            </div>
        </div>
    </div>

</section>
<!--  Signup end-->
<!-- jquery -->
@include('theme.scripts')
<!-- end jquery -->
</body>
<!-- body end -->
</html> 






