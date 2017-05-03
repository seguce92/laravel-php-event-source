<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use View;

class ApiController extends Controller
{
    /**
    * Returns the home view and code snippets
    */
    public function Welcome(){
        $streamCode = 
        '<?php
            //Setting header for text stream
            header("Content-Type: text/event-stream");
            header("Cache-Control: no-cache"); 
            ?>

            @if(Session::get("session_id"))
            <?php
            //After Checking for session, value to stream
            $id = Session::get("session_id");
            $message = Session::get("message");
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
        ?>';

        $jsCode = 
        '/**
        * Display the notification after getting data from stream
        * @param {Title of the notification} title 
        * @param {Data or message to be display} data 
        */
        function notifyMe(title, data) {
                var notificationTitle = "Sender: " + title;
                //Checking whether browser has permission to display notification or not
                if (window.Notification && Notification.permission !== "denied") {
                    //Requesting permission from browser
                    Notification.requestPermission(function (status) {
                        //Creating new Notification
                        var n = new Notification(notificationTitle, {
                            body: "Message: " + data,
                            icon: "../img/icon.jpg"
                        });
                    });
                }
            }

            /**
            * Streaming unidirectionally to the defined url.
            */
            if (window.EventSource) {
                //Change stream url according to your need.
                var streamURL = "stream";

                //Creating new instance of event source api
                source = new EventSource(streamURL);
                source.onmessage = function (event) {
                    var data = JSON.parse(event.data);
                    console.log(event.data);
                    if (data.Sender != "") {
                        notifyMe(data.Sender, data.Message);
                    }
                };
            } else {
                //If Event source doesn\'t support your browser.
                alert("event source does not work in this browser, author a fallback technology");
            }';
        return view("welcome",['streamCode' => $streamCode, 'jsCode' => $jsCode]);
    }

    /**
    * Returns the view of form to send notification
    */
    public function Hit()
    {
        return view("hit");
    }

    /**
    * Adds the notification in queue, and creates a session
    */
    public function HitData(Request $request)
    {
        $data = Input::get();
        $message = $data['message'];
        $session_id = $data['sid'];
        \Session::put('session_id', $session_id);
        DB::table('queue')->insert(
            ['session_id' => $session_id, 'message' => $message]
        );
        return "Notification added in queue";
    }

    /**
    * Streams the data. Extracts the last message from queue, sends it to stream and then removes it from queue.
    */
    public function Stream()
    {
        $value = Session::get('session_id');
        if($value!=null)
        {
            $data = DB::table('queue')->first();
            if($data!=null)
            {
                \Session::put('message', $data->message);
                $notificationId = $data->id; 
                DB::table('queue')->where('Id', '=', $notificationId)->delete();
            }
        }    
        return View::make('stream');
    }
}
