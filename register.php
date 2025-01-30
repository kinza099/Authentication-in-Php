<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

include 'config.php';

// Initialize variables with empty values
$username = $email = $password = $confirm_password = $phone = "";
$field_errors = [
    'username' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'phone' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    // Validation for required fields
    if (empty($username)) {
        $field_errors['username'] = "Username is required.";
    } else {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $field_errors['username'] = "Username already registered.";
        }
        $stmt->close();
    }

    if (empty($email)) {
        $field_errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $field_errors['email'] = "Invalid email format.";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $field_errors['email'] = "Email already registered.";
        }
        $stmt->close();
    }

    if (empty($password)) {
        $field_errors['password'] = "Password is required.";
    }
    if (empty($confirm_password)) {
        $field_errors['confirm_password'] = "Confirm password is required.";
    } elseif ($password !== $confirm_password) {
        $field_errors['confirm_password'] = "Passwords do not match.";
    }
    if (empty($phone)) {
        $field_errors['phone'] = "Phone number is required.";
    } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
        $field_errors['phone'] = "Phone number must be 10 digits.";
    }

    // If no errors, register the user
    if (array_filter($field_errors) === []) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO user (username, email, password, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $phone);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Registration successful! Please log in.";
            header('Location: login.php');
            exit();
        } else {
            $field_errors['email'] = "An error occurred. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-danger {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                                <small class="text-danger"><?php echo htmlspecialchars($field_errors['username']); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                <small class="text-danger"><?php echo htmlspecialchars($field_errors['email']); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="text-danger"><?php echo htmlspecialchars($field_errors['password']); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                <small class="text-danger"><?php echo htmlspecialchars($field_errors['confirm_password']); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                                <small class="text-danger"><?php echo htmlspecialchars($field_errors['phone']); ?></small>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>Already have an account? <a href="login.php">Login here</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>