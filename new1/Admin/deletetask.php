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


$TId = $_GET['TId'];



// Assuming there is a foreign key relationship
$delete_assign_query = "DELETE FROM task WHERE TId ='$TId' ";
$delete_assign_data = mysqli_query($conn, $delete_assign_query);

if ($delete_assign_data) {
    // Continue with deleting from the task table
    $query = "DELETE FROM task WHERE TId ='$TId' ";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['status'] = "Record Deleted from Database";
        header('location: taskDetails.php');
    } else {
        echo "Something went wrong with the task deletion query.";
    }
} else {
    echo "Something went wrong with the assign deletion query.";
}

?>
