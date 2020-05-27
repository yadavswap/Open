<head>
<meta charset="utf-8" />
<title>Page Not Found | {{ $project_title }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="{{ $gsetting->meta_data_desc }}" />
<meta name="keywords" content="{{ $gsetting->meta_data_keyword }}">
<meta name="author" content="Media City" />
<meta name="MobileOptimized" content="320" />
<link rel="icon" type="image/icon" href="{{ asset('images/favicon/'.$gsetting->favicon) }}"> <!-- favicon-icon -->
<!-- theme styles -->
<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700" rel="stylesheet"><!--  google fonts -->
<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"> <!-- google fonts -->
<link rel="stylesheet" href="{{ url('vendor/fontawesome/css/all.css') }}" /> <!--  fontawesome css -->
<link rel="stylesheet" href="{{ url('vendor/font/flaticon.css') }}" /> <!--  fontawesome css -->
<link rel="stylesheet" href="{{ url('vendor/navigation/menumaker.css') }}" /> <!-- navigation css -->
<link rel="stylesheet" href="{{ url('vendor/owl/css/owl.carousel.min.css') }}" /> <!-- owl carousel css -->
<link rel="stylesheet" href="{{ url('vendor/protip/protip.css') }}" /> <!-- menu css -->
<link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/> <!-- custom css -->
<link rel="stylesheet" href="{{ URL::asset('css/pace.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('css/protip.css') }}" /> <!-- protip css -->
<link rel="manifest" href="{{url('manifest.json')}}">
<!-- end theme styles -->
</head>
<body>
<!-- error page -->
<section id="error" class="error-page-main-block">
    <div class="container-fluid">
        <div class="error-block text-center "> 
            <h1 class="error-heading"><span>404 </span></br>page not found!</h1>
            <p>This page isn't avalible. sorry about that.</p>
            <p class="btm-40">Try searching for something else.</p>
            <div class="nav-bar-btn btm-20">
                <a href="{{ url('/') }}" class="btn btn-secondary" title="instructor"><i class="fa fa-chevron-left"></i>Back to Home</a>
            </div>
        </div>
    </div>
</section>
<!-- error page end -->
<script src="{{ url('js/jquery-2.min.js') }}"></script> <!-- jquery library js -->
<script src="{{ url('js/colorbox.js') }}"></script>
<script src="{{ url('js/bootstrap.bundle.js') }}"></script> <!-- bootstrap js -->
<script src="{{ url('vendor/counter/waypoints.min.js') }}"></script> <!-- facts count js required for jquery.counterup.js file -->
<script src="{{ url('vendor/counter/jquery.counterup.js') }}"></script> <!-- facts count js-->
<script src="{{ url('vendor/owl/js/owl.carousel.min.js') }}"></script> <!-- owl carousel js -->	
<script src="{{ url('vendor/smoothscroll/smooth-scroll.js') }}"></script> <!-- smooth scroll js -->
<script src="{{ url('vendor/popup/jquery.magnific-popup.min.js')}}"></script> <!-- popup js-->
<script src="{{ url('vendor/navigation/menumaker.js') }}"></script> <!-- navigation js--> 
<script src="{{ url('vendor/mailchimp/jquery.ajaxchimp.js') }}"></script> <!-- mail chimp js --> 
<script src="{{ url('vendor/protip/protip.js') }}"></script> <!-- protip js -->
<script src="{{ url('js/theme.js') }}"></script> <!-- custom js -->
<script src="{{ url('js/FWDUVPlayer.js') }}"></script> <!-- player js --> 
<script src="{{ url('js/jquery.owl-filter.js') }}"></script> <!-- filter js --> 
<script src="{{ url('js/fontawesome-iconpicker.js')}}"></script><!-- iconpicker js -->
<script src="{{ url('js/tinymce.min.js')}}"></script>
<script src="{{ url('js/protip.js') }}"></script> <!-- protip js -->
<script src="{{ URL::asset('js/pace.min.js') }}"></script>

</body>

