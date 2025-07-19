<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Santhosh">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login to MilkMate</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Initialize the agent at application startup.
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
            .then(FingerprintJS => FingerprintJS.load())

        // Get the visitor identifier when you need it.
        fpPromise
            .then(fp => fp.get())
            .then(result => {
                // This is the visitor identifier:
                const visitorId = result.visitorId
                console.log(visitorId)
                $('#fingerprint').val(visitorId);
            })
    </script>

    <title>MilkMate</title>
    <?php
    $cssPath = $_SERVER['DOCUMENT_ROOT'] . '/Backend/css/' . basename($_SERVER['PHP_SELF'], ".php") . ".css";
    if (file_exists($cssPath)) { ?>
        <link href="/Backend/css/<?= basename($_SERVER['PHP_SELF'], ".php") ?>.css" rel="stylesheet">
    <?php } ?>


</head>