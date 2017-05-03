/**
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
                body: 'Message: ' + data,
                icon: '../img/icon.jpg'
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
    //If Event source doesn't support your browser.
    alert("event source does not work in this browser, author a fallback technology");
}



