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
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                        cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum.</p>
                    <div class="col-xs-2 w3ls_about_grid_left1">
                        <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-10 w3ls_about_grid_left2">
                        <p>Sunt in culpa qui officia deserunt mollit
                            anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="col-xs-2 w3ls_about_grid_left1">
                        <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-10 w3ls_about_grid_left2">
                        <p>Sunt in culpa qui officia deserunt mollit
                            anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-6 w3ls_about_grid_right">
                    <img src="{{asset('vendor/tyondo/biashara/images/52.jpg')}}" alt=" " class="img-responsive" />
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
