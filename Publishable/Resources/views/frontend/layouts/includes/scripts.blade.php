<!-- for bootstrap working -->
<script type="text/javascript" src="{{asset('vendor/tyondo/biashara/js/bootstrap-3.1.1.min.js')}}"></script>
<!-- //for bootstrap working -->
<script src="{{asset('vendor/tyondo/biashara/js/jquery.countdown.js')}}"></script>
<script src="{{asset('vendor/tyondo/biashara/js/script.js')}}"></script>
<script src="{{asset('vendor/tyondo/biashara/js/jquery.wmuSlider.js')}}"></script>
<script>
    @if(!Auth::check())
        $('#myModal88').modal({
        keyboard:false,
        backdrop:'static'
    });
    @endif
</script>
<script>
    $('.example1').wmuSlider();
</script>
<script type="text/javascript">
    $(window).load(function() {
        $("#flexiselDemo1").flexisel({
            visibleItems: 4,
            animationSpeed: 1000,
            autoPlay: true,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint:480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint:640,
                    visibleItems:2
                },
                tablet: {
                    changePoint:768,
                    visibleItems: 3
                }
            }
        });
    });
</script>
<script type="text/javascript" src="{{asset('vendor/tyondo/biashara/js/jquery.flexisel.js')}}"></script>
<!-- cart-js -->
<script src="{{asset('vendor/tyondo/biashara/js/minicart.js')}}"></script>
<script>
    w3ls.render();

    w3ls.cart.on('w3sb_checkout', function (evt) {
        var items, len, i;

        if (this.subtotal() > 0) {
            items = this.items();

            for (i = 0, len = items.length; i < len; i++) {
            }
        }
    });
</script>
<!-- //cart-js -->