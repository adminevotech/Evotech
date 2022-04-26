<!DOCTYPE html>
<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>
    <h1>{{ $data['name'] }}</h1>
    <p>{{ $data['email'] }}</p>
    <p>{{ $data['subject'] }}</p>
    <p>{{ $data['message'] }}</p>

    <p>Thank you</p>
</body>
</html>
