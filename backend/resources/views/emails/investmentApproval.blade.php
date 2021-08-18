<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    @include('emails.components.head')
<body>
    <div class="preloader">
        <div class="signal"></div>
    </div>
	<div id="wrapper" class="wrapper clearfix">
        @include('emails.components.header')
        <h6 class="little">@lang('Investment Confirmation')</h6>
        <p>@lang('Hello,')</p>
        <p>@lang('We have confirmed your order and we expect to see good things happening in the coming days. With us its “more money, less problems”.')</p>
        <p>@lang('Thank you for your order, we have attached a receipt to this email.')</p>
        <p>@lang('Best,')</p>

        <p>@lang('Top Finance LTD')</p>
        @include('emails.components.footer')
    </div>
</body>

</html>
