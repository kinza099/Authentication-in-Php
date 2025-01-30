<?php

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentication in PHP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .auth-container {
            text-align: center;
        }
        .auth-container h1 {
            margin-bottom: 20px;
        }
        .auth-container a {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h1>Authentication in PHP</h1>
        <div class="btn-container">
            <a href="register.php" class="btn btn-primary">Register</a>
            <a href="login.php" class="btn btn-primary">Login</a>
        </div>
    </div>
</body>
</html>
