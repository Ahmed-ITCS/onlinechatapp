<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Box</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-y: scroll;
            max-height: 400px; /* Adjust as needed */
        }
        .message-container {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            background-color: #DCF8C6; /* Adjust to match WhatsApp */
        }
        .message-input {
            width: calc(100% - 80px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            margin-right: 10px;
            resize: none;
        }
        .send-button {
            padding: 10px 20px;
            background-color: #25D366; /* WhatsApp Green */
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }
        .send-button:hover {
            background-color: #128C7E; /* Darker shade of WhatsApp Green */
        }
    </style>
</head>
<body>
    <div class="chat-container" id="chatContainer">
        <!-- Display messages from the database -->
        @foreach($messages as $message)
            <div class="message-container">{{ $message->content }}</div>
        @endforeach
    </div>
    <div>
        <form action="{{ route('chatbox.send-message', ['userId' => $userId]) }}" method="POST">
            @csrf
            <textarea name="message" class="message-input" placeholder="Type your message..."></textarea>
            <button type="submit" class="send-button">Send</button>
        </form>
    </div>
    <script>
        // Function to scroll to the bottom of the chat container
        function scrollToBottom() {
            var chatContainer = document.getElementById('chatContainer');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
        
        // Call the scrollToBottom function when the page loads
        window.onload = function() {
            scrollToBottom();
        };

        // Function to reload the page every 10 seconds
        function refreshPage() {
            window.location.reload();
        }

        // Call the refreshPage function every 10 seconds
        setInterval(refreshPage, 10000); // 10000 milliseconds = 10 seconds
    </script>
</body>
</html>
