<?php
require_once("db.php");
require_once("navbar.php");
if(isset($_GET['id'])){
$id= $_GET['id'];
$sql= "SELECT * FROM tasks WHERE id=$id";
$result= mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){

$task= mysqli_fetch_assoc($result);
}else{
    echo "No Task Found";
    exit;
}
}else{
    echo "No Task ID Found";
    exit;
}
if(isset($_POST['update'])){
    $title= $_POST['title'];
    $description= $_POST['description'];
    $status= $_POST['status'];
    if(empty($title)||empty($description)||empty($status)){
        echo "Please Fill All Fields";
        exit;
    }
    $sql= "UPDATE tasks SET title='$title',description='$description',status='$status' WHERE id=$id";
    if(mysqli_query($con,$sql)){
        header("Location: tasks.php");
        exit;
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }   

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4 text-primary">Update Task</h2>
            <form action="update.php?id=<?php echo $id; ?>" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Task Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($task['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Task Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required><?php echo htmlspecialchars($task['description']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Pending" <?php echo $task['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Completed" <?php echo $task['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-primary w-100">Update Task</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>