<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    @include('emails.components.head')
<body>
    <div class="preloader">
        <div class="signal"></div>
    </div>
	<div id="wrapper" class="wrapper clearfix">
        @include('emails.components.header')
        <h6 class="little">@lang('New Investment Request')</h6>
        <p>@lang('Hello,')</p>
        <p>@lang('Kindly confirm the payment of: ')</p>
        <ul>
            <li>Investment plan: {{$name}}</li>
            <li>Payment method: {{$coin}}</li>
            <li>Address: {{$address}}</li>
            <li>Amount: {{$amount}}</li>
            <li><button class="btn btn-primary" onclick="copy({{$address}})">
                Copy address
            </button></li>
        </ul>
        <p>@lang('Best,')</p>

        <p>@lang('Top Finance LTD')</p>
        @include('emails.components.footer')
    </div>
    <script>
        function copy(address){
            navigator.clipboard.writeText(address)
            .then(text => {
                alert('Copied');
            })
            .catch(err => {
                alert('Failed to copy contents to clipboard: ' + JSON.stringify(err, null, 4));
                console.error('Failed to read clipboard contents: ', err);
            });
        }
    </script>
</body>

</html>
