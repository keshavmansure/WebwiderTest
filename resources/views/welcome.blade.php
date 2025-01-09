<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

 
</head>

<body>
    <div class="d-flex justify-content-center align-items-center bg-light" style="height: 100vh;">
        <div class="text-center p-4 shadow rounded bg-white" style="min-width: 300px;">
            <h1 class="mb-4 text-primary">Welcome</h1>
            <p class="mb-4 text-muted">Please select your login option:</p>
            <a href="{{ route('users.index') }}" class="btn btn-primary btn-lg mb-3 w-100">
                Users Login
            </a>
            <a href="{{ route('admins.index') }}" class="btn btn-primary btn-lg w-100">
                Admin Login
            </a>
        </div>
    </div>
</body>

</html>
