<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-blue-500 p-4">
            <h1 class="text-white font-bold">Real-time Chat</h1>
        </div>

        <div id="chat-box" class="h-80 p-4 overflow-y-auto border-b">
            <!-- Messages will appear here -->
        </div>

        <div class="p-4 flex gap-2">
            <input type="text" id="username" placeholder="Name" class="w-1/4 border p-2 rounded">
            <input type="text" id="message" placeholder="Type message..." class="flex-grow border p-2 rounded">
            <button onclick="send()" class="bg-blue-500 text-white px-4 py-2 rounded">Send</button>
        </div>
    </div>

    <script>
        // 1. Pusher Setup
        Pusher.logToConsole = true;

        // config() use korar somoy nishchit hon jate cache error na hoy.
        // Debug korar somoy proyojone sorasori key/cluster boshie dekhun.
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            forceTLS: true
        });

        const channel = pusher.subscribe('chat-channel');

        // Connection success check
        pusher.connection.bind('connected', function() {
            console.log('Pusher-er sathe connect hoyeche!');
        });

        // Binding the event
        // Laravel-e broadcastAs() use korle namer age '.' deya lagte pare
        channel.bind('message-event', function(data) {
            console.log('Data peyechi:', data);
            appendMessage(data.username, data.message, 'bg-gray-200');
        });

        function send() {
            const username = $('#username').val();
            const message = $('#message').val();

            if(message == '') return;

            $.ajaxSetup({
                headers: {
                    'X-Socket-ID': pusher.connection.socket_id
                }
            });

            $.post('/send-message', {
                _token: '{{ csrf_token() }}',
                username: username,
                message: message
            }, function(response) {
                console.log('Server response:', response);
                // toOthers() use korle local screen-e manually append korte hobe
                appendMessage('Me', message, 'bg-blue-100 text-right');
                $('#message').val('');
            }).fail(function(err) {
                console.error('Error sending message:', err);
            });
        }

        function appendMessage(user, msg, bgColor) {
            $('#chat-box').append(`
                <div class="mb-2 p-2 rounded ${bgColor}">
                    <strong class="block text-xs text-gray-600">${user}</strong>
                    <span>${msg}</span>
                </div>
            `);
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        }
    </script>
</body>
</html>
