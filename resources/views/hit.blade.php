<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Send Notification</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section class="welcome-page">
            <h1>Send notification</h1>
            {{Form::open(['method'=>'post', 'url'=>'send-data', 'class' => 'notification-form'])}}
            {{ Form::label('name', 'Your Name') }}
            {{Form::text('sid', '', ['class' => 'form-control']) }}
            {{ Form::label('name', 'Message') }}
            {{Form::text('message', '', ['class' => 'form-control'])}}
            {{Form::submit('Send', ['class' => 'btn btn-primary form-button'])}}
            {{Form::close()}}
        </section>
    </body>
    <script src="../js/notification.js"></script>
</html>


