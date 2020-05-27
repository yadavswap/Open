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
    <link rel="stylesheet" href="{{url('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <title>Installing App - Step 3 - Basic Settings</title>
    
  </head>
  <body>
   	  
      <div class="preL display-none">
        <div class="preloader3 display-none"></div>
      </div>

   		<div class="container">
   			<div class="card">
          <div class="card-header">
              <h3 class="m-3 text-center text-dark ">
                  Welcome To Setup Wizard - Basic Site Setting
              </h3>
          </div>
   				<div class="card-body" id="stepbox">
               <form autocomplete="off" enctype="multipart/form-data" action="{{ route('store.step3') }}" id="step3form" method="POST" class="needs-validation" novalidate>
                  @csrf
                   <h3>Site Setting</h3>
                   <hr>
                  <div class="form-row">
                   
                    <br>
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom01">Project Title:</label>
                      <input name="project_name" type="text" class="form-control" id="validationCustom01" placeholder="eClass - Learning Management System" value="" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                          Please enter project title.
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom01">Project Description:</label>
                      <input name="project_desc" type="text" class="form-control" id="validationCustom01" placeholder="this is our project" value="">
                      
                    </div>

                     <div class="col-md-6 mb-3">
                      <label for="validationCustom01">Choose Logo:</label>
                      <input name="logo" type="file" class="form-control" id="logo" value="" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                          Please choose app logo.
                      </div>
                    </div>

                    <div class="col-md-6 p-3">
                      Logo Preview:
                      <br>
                       <img id="logo-prev" align="center" class="img-fluid" src="" alt="">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="validationCustom01">Choose Favicon:</label>
                      <input name="favicon" type="file" class="form-control" id="favicon" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                          Please choose favicon.
                      </div>
                    </div>

                    <div class="col-md-6 p-3">
                      Favicon Preview:
                      <br>
                       <img id="fav-prev" align="center" class="img-fluid" src="" alt="">
                    </div>
                    
                  </div>
                
                  <hr>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom02">Default Email:</label>
                      <input name="email" type="text" class="form-control" id="validationCustom02" placeholder="user@info.com" value="" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                          Please enter email.
                      </div>
                      <br>
                      <label for="validationCustom03">Mobile No.:</label>
                      <input name="mobile" type="text" class="form-control" id="validationCustom03" autocomplete="off" placeholder="1234567890" required>
                      <div class="invalid-feedback">
                        Please enter mobile no.
                      </div>

                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom04">Address:</label>
                      <textarea rows="5" cols="30" name="address" class="form-control" id="validationCustom04" autocomplete="off" placeholder="Please enter address" required></textarea>
                      <div class="invalid-feedback">
                        Please enter address.
                      </div>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                  </div>
                  <hr>
               
                  
                <button class="float-right step1btn btn btn-primary" type="submit">Continue to Step 4...</button>
              </form>
   				</div>
   			</div>
        <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | eClass - Learning Management System | Installer v1.0 | <a class="text-white" href="http://mediacity.co.in">Mediacity</a></p>
   		</div>
      
      <div class="corner-ribbon bottom-right sticky green shadow">Step 3 </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ url('installer/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('installer/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('installer/js/additional-methods.min.js') }}"></script>
    <script src="{{ url('installer/js/ej.web.all.min.js') }}"></script>
    <script src="{{ url('installer/js/popper.min.js') }}"></script>
    <script src="{{ url('installer/js/bootstrap.min.js') }}"></script>

    <script src="{{ url('installer/js/shards.min.js') }}"></script>

    @yield('script-zone')

    <script>
     
      function readURL1(input) {

        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#logo-prev').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#logo").change(function() {
        readURL1(this);
      });

      function readURL2(input) {

        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#fav-prev').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#favicon").change(function() {
        readURL2(this);
      });

    </script>


</body>
</html>