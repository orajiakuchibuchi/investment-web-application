<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    @include('emails.components.head')
<body>
    <div class="preloader">
        <div class="signal"></div>
    </div>
	<div id="wrapper" class="wrapper clearfix">
        @include('emails.components.header')
        <h6 class="little">@lang('Investment Request')</h6>
        <p>@lang('Hello,')</p>
        <p>@lang('We have received your investment request currently pending.')</p>
        <p>@lang('In the meantime visit our ') <a href="https:topfinanceltd.com">@lang('our website')</a>@lang(' for very exciting deals.')</p>
        <p>@lang('Best,')</p>

        <p>@lang('Top Finance LTD')</p>
        @include('emails.components.footer')
    </div>
</body>

</html>
