<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    @include('emails.components.head')
<body>
	<div id="wrapper" class="wrapper clearfix">
        @include('emails.components.header')
        <h6 class="little">@lang('Time is money')</h6>
        <p>@lang('Time truly is money and that’s why we are asking you to bear with us while we get the necessary approvals for your withdrawal.')</p>
        <p>@lang('We want to make sure every penny counts!')</p>
        <p>@lang('This email is to confirm your withdrawal request of ' . $amount . ' to the ' . $method . ' address: ' . $address)</p>
        <p>@lang('In the meantime visit our ') <a href="https:topfinanceltd.com">@lang('our website')</a>@lang(' for very exciting deals.')</p>
        <p>@lang('Warm regards,')</p>

        <p>@lang('Top Finance LTD')</p>
        @include('emails.components.footer')
    </div>
</body>

</html>
