<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    @include('emails.components.head')
<body>
    <div class="preloader">
        <div class="signal"></div>
    </div>
	<div id="wrapper" class="wrapper clearfix">
        @include('emails.components.header')
        <h6 class="little">@lang('Withdrawal Confirmation')</h6>
        <p>@lang('We endorse this message!')</p>
        <p>@lang('We have taught you how to fish and now it’s time to take those fishes home.')</p>
        <p>@lang('This email is to confirm your withdrawal of ' . $amount . ' to the ' . $method . ' address: ' . $address . ' , you shall receive your funds shortly.')</p>
        <p>@lang('Don’t forget to invest wisely with top finance ltd')</p>
        <p>@lang('Kind Regards,')</p>

        <p>@lang('Top Finance LTD')</p>
        @include('emails.components.footer')
    </div>
</body>

</html>
