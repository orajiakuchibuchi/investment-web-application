<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    @include('emails.components.head')
<body>
    <div class="preloader">
        <div class="signal"></div>
    </div>
	<div id="wrapper" class="wrapper clearfix">
        @include('emails.components.header')
        <h6 class="little">@lang('Forgot your password?')</h6>
        <p>@lang('It happens to all of us and that’s why we are here to help')</p>
        <p>@lang('Below is your new password')</p>
        <p><strong>@lang($newpassword)</strong></p>
        <p>@lang('If you did not request for a password reset please ignore this email.')</p>
        <p>@lang('For further questions please reach out to us.')</p>

        <p>@lang('Top Finance LTD')</p>
        @include('emails.components.footer')
    </div>
</body>

</html>
