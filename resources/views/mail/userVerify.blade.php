<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
<body>
<p><img src="{{$src}}" alt="E-shopper"></p>
<h2>Welcome {{ $user->name }} </h2>
<br/>
Your registered email is {{ $user->email }} , Please click on the below link to verify your email account
<br/>
<a href="{{route('verify',['token'=>$user->verifyUser()->first()->token])}}">Verify Email</a>
</body>
</html>