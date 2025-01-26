<?php
require_once("db.php");
require_once("navbar.php");
session_start(); // Start the session to access session variables
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        echo "Email is required";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    if (empty($password)) {
        echo "Password is required";
        exit;
    }

    $email = mysqli_real_escape_string($con, $email);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id']; // Store user session data
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            header("Location: add_tasks.php");
            exit;
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "Invalid email or password";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Card for Form -->
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4 text-primary">Log in</h2>
            <!-- Login Form -->
            <form action="login.php" method="post">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">
                        <i class="bi bi-envelope-fill me-2"></i>Email Address
                    </label>
                    <input type="email" autocomplete="off" class="form-control" id="exampleInputEmail1" placeholder="example@gmail.com" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">
                        <i class="bi bi-lock-fill me-2"></i>Password
                    </label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password" name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100" name="login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>
            <div class="text-center mt-3">
                <p> Don't have an account? <a href="register.php" class="text-decoration-none text-primary">Register here</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>