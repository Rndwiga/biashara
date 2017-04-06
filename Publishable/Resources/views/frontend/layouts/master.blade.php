<!DOCTYPE html>
<html lang="en">
<head>
    <title>Electronic Store a Ecommerce Online Shopping Category Bootstrap Responsive Website Template | Home :: w3layouts</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Electronic Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
	SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <!-- Custom Theme files -->
    <link href="{{asset('vendor/tyondo/biashara/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('vendor/tyondo/biashara/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('vendor/tyondo/biashara/css/fasthover.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('vendor/tyondo/biashara/css/popuo-box.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- font-awesome icons -->
    <link href="{{asset('vendor/tyondo/biashara/css/font-awesome.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="{{asset('vendor/tyondo/biashara/js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('biashara')}}" /> <!-- countdown -->
    <!-- //js -->
    <!-- web fonts -->
    <link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <!-- //web fonts -->
    <!-- start-smooth-scrolling -->
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
</head>
<body>

<!-- header modal -->
@include(config('biashara.views.layouts.includes.header-users-access'))
<!-- header modal -->
<!-- header -->
@include(config('biashara.views.layouts.includes.header'))
<!-- //header -->
<!-- navigation -->
@include(config('biashara.views.layouts.includes.navigation'))
<!-- //navigation -->
<!-- banner-bottom -->
<!-- //Content -->
@yield('content')
<!-- //Content -->

    <!-- newsletter -->
        {{--Activate me when we grow bigger and write my logic--}}
            {{--@include('frontend.layouts.includes.newsletter')--}}
    <!-- //newsletter -->

<!-- footer -->
@include(config('biashara.views.layouts.includes.footer'))
<!-- //footer -->
<!-- cart-js -->
@include(config('biashara.views.layouts.includes.scripts'))
<!-- //cart-js -->
</body>
</html>