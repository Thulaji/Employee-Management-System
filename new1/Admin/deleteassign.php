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

$EId = $_GET['Ed'];
$TId = $_GET['Td'];

$ActivityId = $_GET['Act'];

$query = "DELETE FROM assign WHERE EId='$EId' AND Tid ='$TId' AND ActivityId='$ActivityId'";
$data = mysqli_query($conn,$query);
if ($data){
    $_SESSION['status'] = "Record Delete from Database";
    header('location: AssignDetails.php');
    // header('location: taskDetails.php');
}
else {
    echo "some thing went wrong";
}
?>
