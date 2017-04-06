@extends(config('biashara.views.layouts.master'))
@section('content')
    <!-- modal-windows -->
    @include(config('biashara.views.pages.home.modal.mobile'))
    @include(config('biashara.views.pages.home.modal.home'))
    @include(config('biashara.views.pages.home.modal.computer'))
    @include(config('biashara.views.pages.home.modal.household'))
    @include(config('biashara.views.pages.home.modal.kitchen'))
    @include(config('biashara.views.pages.home.modal.vaccum'))
    @include(config('biashara.views.pages.home.modal.dinning'))
    <!-- //modal-windows -->
    <!-- banner -->
        {{--Activate banner when we grow and are advertising--}}
            {{--<div class="banner">
                <div class="container">
                    <h3>Electronic Store, <span>Special Offers</span></h3>
                </div>
            </div>
            --}}
    <!-- //banner -->
    <!-- banner-top -->
        {{--Activate me when we grow bigger --}}
            {{--@include('frontend.pages.home.list-categories')--}}
    <!-- //banner-top -->
        <!-- banner- hot deals -->
           {{--Activate me when we grow bigger --}}
            {{--<div class="banner-bottom1">
                <div class="agileinfo_banner_bottom1_grids">
                    <div class="col-md-7 agileinfo_banner_bottom1_grid_left">
                        <h3>Grand Opening Event With flat<span>20% <i>Discount</i></span></h3>
                        <a href="products.html">Shop Now</a>
                    </div>
                    <div class="col-md-5 agileinfo_banner_bottom1_grid_right">
                        <h4>hot deal</h4>
                        <div class="timer_wrap">
                            <div id="counter"> </div>
                        </div>
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </div>--}}
        <!-- //banner-hot deals -->
    <!-- special-deals -->
        {{--Activate me when we grow bigger --}}
            {{--@include('frontend.pages.home.special-deals')--}}
    <!-- special-deals -->
    <!-- new-products -->
    @include(config('biashara.views.pages.home.new-products'))
    <!-- new-products -->
    <!-- top-brands -->
        {{--Activate me when we grow bigger --}}
            {{--@include('frontend.pages.home.top-brand')--}}
    <!-- top-brands -->
    <!-- banner-bottom -->
@endsection
