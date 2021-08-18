<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification: New contact message from Worldwide Picon</title>
</head>
<body>
    <h3>Notification!</h3>
    <h4>New contact message from Worldwide Picon.</h4>
    <h5>Information</h5>
    <p>Name: {{$name}}</p>
    <p>Email: <a href="mailto:{{$email}}">{{$email}}</a></p>
    <p>Phone: <a href="tel:+{{$phone}}">{{$phone}}</a></p>
    <p style="text-align: center;"><strong>Comments</strong></p>
    <p>{{$message}}</p>
    <span>We have received your message and we will be in touch shortly.</span><br>
</body>
</html>
