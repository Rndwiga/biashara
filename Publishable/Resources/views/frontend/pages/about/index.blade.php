@extends(config('biashara.views.layouts.master'))
@section('content')
    <!-- banner -->
        {{--Activate on availablity of graphics--}}
            {{--<div class="banner banner10">
                <div class="container">
                    <h2>About Us</h2>
                </div>
            </div>--}}
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container">
            <ul>
                <li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- about -->
    <div class="about">
        <div class="container">
            <div class="w3ls_about_grids">
                <div class="col-md-6 w3ls_about_grid_left">
                    <p>Click Away hardware is an online store for construction materials specialized in supply
                    of raw materials finished products and machinery. The Click Away hardware team ha gone around
                    the country and seen the disconnect between consumers and suppliers of construction materials,
                    we are your solution, we are what you need, we are click away from your dream house, dream
                    palace, dream office space and dream project.</p>
                    <div class="col-xs-2 w3ls_about_grid_left1">
                        <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-10 w3ls_about_grid_left2">
                        <p>Click Away hardware also provides a marketing platform for business that engages in supply of
                        construction materials like; stones, steel, san, ballast, hardcore, red soil, paints etc.</p>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="col-xs-2 w3ls_about_grid_left1">
                        <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-10 w3ls_about_grid_left2">
                        <p>If you are a supplier, sign up with Click Away hardware and let's build the nation's best
                        buildings together.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-6 w3ls_about_grid_right">
                    <img src="{{asset('vendor/tyondo/biashara/images/biashara/hardware.jpg')}}" alt=" " class="img-responsive" />
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //about -->
    <!-- team -->
    {{--Activate when needed--}}
        {{--@include('frontend.pages.about.partials.team')--}}
    <!-- //team -->
    <!-- team-bottom -->
    {{--Activate when needed--}}
        {{--@include('frontend.pages.about.partials.team-advert')--}}
    <!-- //team-bottom -->

@endsection
