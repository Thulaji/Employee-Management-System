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

$EId=$_GET['Ed'];

$query = "DELETE FROM employee WHERE EId  ='$EId'";


$data = mysqli_query($conn,$query);

if ($data){
    $_SESSION['status'] = "Record Delete from Database";
    header('location: employeedetails.php');
}
else {
    echo "some thing went wrong";
}
?>
