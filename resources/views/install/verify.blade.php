<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('installer/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('installer/css/shards.min.css') }}">
    <link rel="stylesheet" href="{{ url('installer/css/custom.css') }}">
    <title>Installing App - Step - Envato Purchase Details</title>    
  </head>
  <body>
      
      <div class="preL display-none">
        <div class="preloader3 display-none"></div>
      </div>

      <div class="container">
        <div class="card">
          <div class="card-header">
              <h3 class="m-3 text-center text-dark ">
                  Enter Your Purchase code Detail
              </h3>
          </div>
          <div class="card-body" id="stepbox">
               <form action="{{url('verifycode')}}" id="stepvform" method="POST" class="needs-validation" novalidate>                  
                  {{ csrf_field() }}
                   <h3>Envato Purchase details</h3>
                   <hr>
                  <div class="form-row">
                   
                    <br>
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom01">Envato User Name:</label>
                      <input name="user_id" type="text" class="form-control" id="validationCustom01" placeholder="Username" value="" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                          Please fill name.
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom02">Purchase Code:</label>
                      <input name="code" type="password" class="form-control" id="validationCustom02" placeholder="Please enter valid purchase code" value="" autocomplete="off" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                      </div>                          
                        @if($errors->any())
                          <h6 class="text-danger alert alert-error">{{$errors->first()}}</h6>
                        @endif

                        <br>
                        <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where Is My Purchase Code ??</a>
                    </div>                    
                  </div>
                <button class="float-right step1btn btn btn-primary" type="submit">Continue to Next Step...</button>
              </form>
          </div>
        </div>
        <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | eClass - Learning Management System | Installer v1.0 | <a class="text-white" href="http://mediacity.co.in">Mediacity</a></p>
      </div>
      
      <div class="corner-ribbon bottom-right sticky green shadow">License</div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ url('installer/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('installer/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('installer/js/additional-methods.min.js') }}"></script>
    <script src="{{ url('installer/js/ej.web.all.min.js') }}"></script>
    <script src="{{ url('installer/js/popper.min.js') }}"></script>
    <script src="{{ url('installer/js/bootstrap.min.js') }}"></script>

    <script src="{{ url('installer/js/shards.min.js') }}"></script>
    <script src="{{ url('js/shards.min.js') }}"></script>
    @yield('script-zone')
    <script>
      
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          var forms = document.getElementsByClassName('needs-validation');
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();

    

  </script>

  <script>
  $(document).ready(function() 
  { 
      $("form").submit(function () {
        
        if($(this).valid()){
            $('.preL').fadeIn('fast');
            $('.preloader3').fadeIn('fast');
            $('.container').css({ '-webkit-filter':'blur(5px)'});
            $('body').attr('scroll','no');
            $('body').css('overflow','hidden');
          }
      });
  });


</script>

</body>
</html>