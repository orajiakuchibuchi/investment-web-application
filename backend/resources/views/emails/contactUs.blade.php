<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    @include('emails.components.head')
<body>
    <div class="preloader">
        <div class="signal"></div>
    </div>
	<div id="wrapper" class="wrapper clearfix">
        @include('emails.components.header')
        <h3 class="center">@lang('You are here!')</h3>
        <h6 class="little">@lang('Thank you signing up to Top Finance!')</h6>
        <p>@lang('You’ve made the first right choice, out of a whole lot more you will be making by sticking with us on this rewarding experience.')</p>
        <p>@lang('At Top Finance we are sure to give you your money’s worth [wink].  We just don’t want to be your financial Midas; we want to take you to the next level by keeping informed with up-to-date information and newsworthy stories.')</p>
        <p>@lang('If you would like to know more already visit ') <a href="https://topfinanceltd.com">@lang('our website')</a> @lang('for further updates')</p>
        <p>@lang('I will be saying hello again soon. Until then, goodbye!')</p>
        <p>@lang('Best,')</p>

        <p>@lang('Top Finance LTD')</p>
        @include('emails.components.footer')
    </div>
</body>

</html>
