<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 100px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to the Dashboard</h1>
        <a href="{{ route('register.form') }}" class="btn">Go to Register Page</a>
        <a href="{{ route('users.index') }}" class="btn">View All Users</a>
        <a href="{{ url('/api/users') }}" class="btn">API</a>
    </div>
</body>

</html>