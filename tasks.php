<?php
require_once("db.php");
require_once("navbar.php");

$sql = "SELECT * FROM tasks";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- زر إضافة مهمة جديدة -->
        <div class="mb-3">
            <a href="add_tasks.php" class="btn btn-success">
                <i class="bi bi-plus-circle-fill me-2"></i>Add New Task
            </a>
        </div>

        <!-- Card for Tasks -->
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4 text-primary">Tasks</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td class='text-wrap'>" . htmlspecialchars($row['title']) . "</td>";
                            echo "<td class='text-wrap'>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "<td>";
                            echo "<a href='update.php?id=" . urlencode($row['id']) . "' class='btn btn-primary btn-sm me-2'><i class='bi bi-pencil-fill'></i> Edit</a>";   
                            echo "<a href='delete.php?id=" . urlencode($row['id']) . "' class='btn btn-danger btn-sm'><i class='bi bi-trash-fill'></i> Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No tasks found.</td></tr>";
                    }
                    mysqli_close($con); // إغلاق الاتصال بقاعدة البيانات
                    ?>
                </tbody>
            </table>
        </div>
    </div>        

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body> 
</html>
