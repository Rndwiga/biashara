@extends(config('biashara.views.layouts.master'))
@section('content')
    <!-- banner -->
    {{--Activate when have more graphics--}}
    {{--    <div class="banner banner10">
        <div class="container">
            <h2>Mail Us</h2>
        </div>
    </div>
    --}}

    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
                <li>Mail Us</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- mail -->
    <div class="mail">
        <div class="container">
            <h3>Mail Us</h3>
            <div class="agile_mail_grids">
                <div class="col-md-5 contact-left">
                    <h4>Address</h4>
                    <ul>
                        <li>Telephone :+254 720 891 500</li>
                        <li><a href="mailto:info@clickawayhardware.co.ke">info@clickawayhardware.co.ke</a></li>
                    </ul>
                </div>
                <div class="col-md-7 contact-left">
                    <h4>Contact Form</h4>
                    {{Form::open( ['route' => 'biashara.auth.login'])}}
                        <input type="text" name="name" placeholder="Your Name" required="">
                        <input type="email" name="email" placeholder="Your Email" required="">
                        <input type="text" name="mobile_number" placeholder="Telephone No" required="">
                        <textarea name="message" placeholder="Message..." required=""></textarea>
                        <input type="submit" value="Submit" >
                    {{Form::close() }}
                </div>
                <div class="clearfix"> </div>
            </div>
              {{--Activate when have physical shop--}}
            {{--
            <div class="contact-bottom">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d96908.54934770924!2d-73.74913540000001!3d40.62123259999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sanimal+rescue+service+near+Inwood%2C+New+York%2C+NY%2C+United+States!5e0!3m2!1sen!2sin!4v1436335928062" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            --}}
        </div>
    </div>
    <!-- //mail -->

@endsection
