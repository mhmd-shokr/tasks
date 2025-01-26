<?php
require_once("db.php");
require_once("navbar.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($name)) {
        echo "Name is required";
        exit;
    }
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        echo "Name must contain only letters and spaces";
        exit;
    }

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
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long";
        exit;
    }

    $name = mysqli_real_escape_string($con, $name);
    $email = mysqli_real_escape_string($con, $email);

    $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
    $email_check_result = mysqli_query($con, $email_check_sql);

    if (mysqli_num_rows($email_check_result) > 0) {
        echo "Email already exists";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
    if (mysqli_query($con, $sql)) {
        echo "Registration successful!";
        header("Location: login.php");
        exit;
    } else {
        echo "Error: Could not register. Please try again.";
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Card for Form -->
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4 text-primary">Register</h2>
            <!-- Registration Form -->
            <form action="register.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">
                        <i class="bi bi-person-fill me-2"></i>Name
                    </label>
                    <input type="text" autocomplete="off" class="form-control" id="exampleInputName" placeholder="Enter your name" name="name">
                </div>
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
                <button type="submit" class="btn btn-primary w-100" name="register">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Register
                </button>
            </form>
            <div class="text-center mt-3">
                <p>Already have an account? <a href="login.php" class="text-decoration-none text-primary">Login here</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>