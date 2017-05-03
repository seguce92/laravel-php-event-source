<?php

//Setting header for text stream
header('Content-Type: text/event-stream');
header("Cache-Control: no-cache"); 
?>

@if(Session::get('session_id'))
<?php

//After Checking for session, value to stream
$id = Session::get('session_id');
$message = Session::get('message');
echo "data:{\"Sender\": \"{$id}\", \"Message\":\"{$message}\" }\n\n";

flush();
Session::flush();
    ?>
@endif

<?php 
    //Retry time in millisecond
    echo "retry: 4000\n";
    ob_flush();
    flush();
?>
