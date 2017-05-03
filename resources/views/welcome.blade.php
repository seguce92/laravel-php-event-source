<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Notification page</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section class="welcome-page">
            <h1>Event Source with Laravel</h1>
            <p>To get notification, <a class="btn btn-info" href="hit" target="_blank">send data</a>
            <h3>Stream Code-</h3>
            <pre>{{$streamCode}}</pre>
            <h3>Event Source-</h3>
            <pre>{{$jsCode}}</pre>
        </section>
    </body>
    <script src="../js/notification.js"></script>
</html>
