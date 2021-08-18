<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    @include('emails.components.head')
<body>
    <div class="preloader">
        <div class="signal"></div>
    </div>
	<div id="wrapper" class="wrapper clearfix">
        @include('emails.components.header')
        <h6 class="little">@lang('New investment plan')</h6>
        <p>@lang('Hello,')</p>
        <p>@lang(
        'Our new '. $name . ' plan is tailored to fit your needs with attractive
        plan interest ('. $interest . '%) and maturity (' . $maturity . ' hours) period
        all for max amount to invest (' . $$max_amount . ') and minimum amount of '. $min_amount .' $')</p>
        <p>@lang('So sit back and relax, let’s do the work for you.')</p>
        <p>@lang('Best')</p>
        <p>@lang('Top Finance LTD')</p>
        @include('emails.components.footer')
    </div>
</body>

</html>
