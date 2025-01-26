<?php
require_once("db.php");
require_once("navbar.php");
if(isset($_GET['id'])){
$id= $_GET['id'];

$sql= "DELETE FROM tasks WHERE id=$id";
if(mysqli_query($con,$sql)){
    header("Location: tasks.php");
    exit;
}else{
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

}