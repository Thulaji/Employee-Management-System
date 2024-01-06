<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check connection
if(!$conn){
    die("connection failed:".mysqli_connect_error());
}
error_reporting(0);

$act=$_GET['act'];

$query = "DELETE FROM taskactivities  WHERE acivityid   ='$act'";


$data = mysqli_query($conn,$query);

if ($data){
    $_SESSION['status'] = "Record Delete from Database";
    header('location: activitydetails.php');
}
else {
    echo "some thing went wrong";
}
?>
