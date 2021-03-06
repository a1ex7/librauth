<!DOCTYPE html>
<html>
    <head>
        <title>Chat on WebSocket</title>

        {!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') !!}
        <link href='https://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Roboto', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 46px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Chat on WebSocket</div>
                <div id="chat">

                </div>
                <div class="send-message input-group">
                    <input type="text" id="message" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-info" onclick="send()">Send</button>
                    </span>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-git2.min.js"></script>

        <script>
//            var conn = new WebSocket('ws://localhost:8080');
//            conn.onopen = function(e) {
//                console.log("Connection established!");
//            };
//
//            conn.onmessage = function(e) {
//                console.log(e);
//                $('#chat').append('<div class="alert alert-info text-left">' + e.data + '</div>');
//            };
//
            send = function() {
                message = $('#message').val();
                $.ajax({
                    method: "POST",
                    url: "/send_message",
                    data: {'message': message}
                });
                $('#message').val('');
            }

        </script>

        <script src="http://autobahn.s3.amazonaws.com/js/autobahn.min.js"></script>
        <script>
            var conn = new ab.connect(
                    'ws://localhost:8080',
                    function(session) {
                        session.subscribe('onNewMessage', function(topic, data) {
                            console.log('New Message "' + topic + '" : ' + data.data);
                            $('#chat').append('<div class="alert alert-info text-left">' + data.data + '</div>');
                        });
                    },
                    function(code, reason, detail) {
                        console.warn('WebSocket connection closed (code, reason, detail): ', code, reason, detail);
                    },
                    {
                        'maxRetries': 60,
                        'retryDelay': 4000,
                        'skipSubprotocolCheck': true
                    }
            );
        </script>

    </body>
</html>
