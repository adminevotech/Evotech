<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
    <h1>Hello, {{ $data['first_name'] }}</h1>
    <h2>Reset Password Link: {{ $data['reset_password_link'] }}</h2>
    <p>Thank you</p>
</body>
</html>
