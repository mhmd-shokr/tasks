<?php
$host="localhost";
$user="root";
$pass="";
$db="tasks";
$con=mysqli_connect($host,$user,$pass,$db);
if($con){
    echo "";
}else{
    echo "Not Connected";
}
?>