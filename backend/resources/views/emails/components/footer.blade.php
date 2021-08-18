
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
						<h5 class="text-center">Unsubscribe</h5>
					</div>
				</div><!-- .col-md-2 end -->
				<div class="clearfix"></div>
			</div>
		</div><!-- .container end -->
	</div><!-- .footer-widget end -->

	<!-- Copyrights
	============================================= -->
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
