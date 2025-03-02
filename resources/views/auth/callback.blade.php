<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Complete</title>
</head>

<body>
    <script>
        window.opener.postMessage({
        type: 'oauth_success',
        provider: '{{ $provider }}',
        accessToken: '{{ $accessToken }}',
    }, '{{ $origin }}');
    window.close();
    </script>
</body>

</html>