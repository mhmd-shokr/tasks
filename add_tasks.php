<?php
require_once("db.php");
require_once("navbar.php");
session_start();
if (!isset($_SESSION['id'])) { // Check if user is logged in
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $title = mysqli_real_escape_string($con, $title);
    $description = mysqli_real_escape_string($con, $description);
    $status = mysqli_real_escape_string($con, $status);

    $sql = "INSERT INTO tasks (title, description, status) VALUES ('$title', '$description', '$status')";

    if (mysqli_query($con, $sql)) {
        header("Location: tasks.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }   
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4 text-primary">Add Task</h2>
            <form action="add_tasks.php" method="post">
                <div class="mb-3">
                    <label for="taskTitle" class="form-label">
                        <i class="bi bi-pencil-fill me-2"></i>Task Title
                    </label>
                    <input type="text" class="form-control" id="taskTitle" placeholder="Enter task title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="taskDescription" class="form-label">
                        <i class="bi bi-textarea-resize me-2"></i>Task Description
                    </label>
                    <textarea class="form-control" id="taskDescription" placeholder="Enter task description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="taskStatus" class="form-label">
                        <i class="bi bi-clipboard-check me-2"></i>Task Status
                    </label>
                    <select class="form-select" id="taskStatus" name="status" required>
                        <option value="" selected disabled>Choose status</option>
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="add_task">
                    <i class="bi bi-plus-circle-fill me-2"></i>Add Task
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>