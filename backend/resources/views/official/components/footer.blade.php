
<!-- Footer #1
============================================= -->
<footer id="footer" class="footer footer-1">
	<!-- Copyrights
	============================================= -->
	<div class="footer--action">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="footer--action-container">
						<div class="row">
							<div class="col-xs-12 col-sm-7 col-md-6">
								<h3>Soon to be Multi-Platform Accessible</h3>
								<p>Mobile application soon</p>
							</div>
							<div class="col-xs-12 col-sm-5 col-md-6">
								<div class="action-button">
									<a href="#">
										<img src="{{url('assets/images/footer/app-store.png')}}" alt="app store">
									</a>
									<a href="#">
										<img src="{{url('assets/images/footer/google-play.png')}}" alt="app store">
									</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div><!-- .container end -->
	</div><!-- .footer-action end -->

	<!-- Widget Section
	============================================= -->
	<div class="footer-widget">
		<div class="container">
			<div class="row clearfix">
				<div class="col-xs-12 col-sm-4 col-md-4 footer--widget widget-about">
					<div class="widget-content">
                        <p style="font-size: 20px; color: #cc9000;
                        font-weight: bolder;"><strong>Top </strong>  <span>Finance Ltd</span></p>
                        <p>
                            <span><strong>Top </strong></span><span>Finance Ltd</span> the best investment platform.</p>
					</div>
				</div><!-- .col-md-3 end -->
				<div class="col-xs-12 col-sm-4 col-md-4 footer--widget widget-links">
					<div class="widget-title">
						<h5>Information</h5>
					</div>
					<div class="widget-content">
						<ul>
							<li><a href="#">About Us</a>  |
                                <a href="#">How It Works</a>
                                | <a href="#">Latest News</a>
                                | <a href="#">Contact Us</a>
                                | <a href="#">FAQs</a></li>
							{{-- <li><a href="#">How It Works</a></li> --}}
							{{-- <li><a href="#">Latest News</a></li> --}}
							{{-- <li><a href="#">Contact Us</a></li> --}}
							{{-- <li><a href="#">FAQs</a></li> --}}
						</ul>
					</div>
				</div><!-- .col-md-2 end -->
				<div class="col-xs-12 col-sm-4 col-md-4 footer--widget widget-newsletter">
					<div class="widget-title">
						<h5>Stay Updated</h5>
					</div>
					<div class="widget-content">
						<form class="form-newsletter mailchimp">
							<input type="email" name="email" class="form-control" placeholder="Subscribe Our Newsletter">
							<button type="submit"><i class="fa fa-long-arrow-right"></i></button>
						</form>
						<div class="subscribe-alert"></div>
						<div class="clearfix"></div>
						<p>Get the latest updates and offers.</p>
						<div class="footer-social-icon">
							<a class="facebook" href="#">
								<i class="fa fa-facebook"></i><i class="fa fa-facebook"></i>
							</a>
							<a class="twitter" href="#" >
								<i class="fa fa-twitter"></i><i class="fa fa-twitter"></i>
							</a>
							<a class="instagram" href="#">
								<i class="fa fa-instagram"></i><i class="fa fa-instagram"></i>
							</a>
							<a class="linkedin" href="#">
								<i class="fa fa-linkedin"></i><i class="fa fa-linkedin"></i>
							</a>
						</div>
					</div>
				</div><!-- .col-md-3 end -->
				<div class="clearfix"></div>
			</div>
		</div><!-- .container end -->
	</div><!-- .footer-widget end -->

	<!-- Copyrights
	============================================= -->
	<div class="footer--bar">
		<div class="container">
			<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 text--center footer--copyright">
                    <div class="payment--methods text--center">
                        <a href="#" title="Visa"><img src="{{url('assets/images/footer/visa.png')}}" alt="Visa"></a>
                        <a href="#" title="Mastercard"><img src="{{url('assets/images/footer/mastercard.png')}}" alt="Mastercard"></a>
                        <a href="#" title="amex"> <img src="{{url('assets/images/footer/amex.png')}}" alt="amex"></a>
                        <a href="#" title="Delta"><img src="{{url('assets/images/footer/delta.png')}}" alt="Delta"> </a>
                        <a href="#" title="Cirrus"><img src="{{url('assets/images/footer/cirrus.png')}}" alt="Cirrus"></a>
                        <a href="#" title="Paypal"><img src="{{url('assets/images/footer/paypal.png')}}" alt="Paypal"></a>
                    </div>
                </div>
 			</div>
		</div><!-- .container end -->
	</div><!-- .footer-copyright end -->
</footer>


<div id="back-to-top" class="backtop"><i class="fa fa-long-arrow-up"></i></div>
 </div><!-- #wrapper end -->

<!-- Footer Scripts
============================================= -->
<script src="{{url('assets/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{url('assets/js/plugins.js')}}"></script>
{{-- <script src="index.html"></script> --}}
<script src="{{url('assets/js/functions.js')}}"></script>
<!-- RS5.0 Core JS Files -->
<script src="{{url('assets/revolution/js/jquery.themepunch.tools.min838f.js?rev=5.0')}}"></script>
<script src="{{url('assets/revolution/js/jquery.themepunch.revolution.min838f.js?rev=5.0')}}"></script>
<script src="{{url('assets/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{url('assets/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{url('assets/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{url('assets/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{url('assets/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{url('assets/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{url('assets/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{url('assets/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<!-- RS Configration JS Files -->
<script src="{{url('assets/js/rsconfig.js')}}"></script>
<script>
    $("#home").click(function() {
            $('html, body').animate({
                scrollTop: $("#slider").offset().top
            }, 1000
        );
    });
    $("#nav-serv").click(function() {
        $('html, body').animate({
            scrollTop: $("#service").offset().top
        }, 1000);

    });
    $("#nav-faq").click(function() {
        $('html, body').animate({
            scrollTop: $("#news").offset().top
        }, 1000);
    });
    $("#nav-contact").click(function() {
        $('html, body').animate({
            scrollTop: $("#contact").offset().top
        }, 1000);

    });
    $("#nav-plan").click(function() {
        $('html, body').animate({
            scrollTop: $("#plan").offset().top
        }, 1000);

    });
    $("#nav-rank").click(function() {
        $('html, body').animate({
            scrollTop: $("#rank").offset().top
        }, 1000);

    });
</script>
