<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
<script>
    fetch('/api/users') // Call your API
        .then(response => response.json()) // Convert response to JSON
        .then(data => {
            let userList = document.getElementById("users-list");
            data.forEach(user => {
                let li = document.createElement("li");
                li.innerHTML = `<strong>${user.nama}</strong> (${user.nik}) - ${user.agama}`;
                userList.appendChild(li);
            });
        })
        .catch(error => console.error("Error fetching users:", error));
</script>

</html>