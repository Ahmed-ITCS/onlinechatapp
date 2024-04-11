<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #25D366; /* WhatsApp Green */
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .message-icon {
            width: 20px;
            height: 20px;
            cursor: pointer;
            margin-left: 5px;
        }
        .message-icon:hover {
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <h1>User List</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Actions</th> <!-- Added a new column for actions -->
            </tr>
        </thead>
        <tbody>
            hello {{$currentUser->name}}
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->age }}</td>
                    <td>
                        <a href="javascript:void(0);" onclick="openMessageWindow('{{ $user->id }}')">
                            <img class="message-icon" src="https://static-00.iconduck.com/assets.00/message-icon-512x463-tqzmxrt7.png" width=25/>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function openMessageWindow(userId) {
            // Replace the URL below with the URL of your chatbox HTML file
            var url = 'chatbox?user=' + userId;
            window.open(url, '_blank', 'width=600,height=400');
        }
    </script>
</body>
</html>
