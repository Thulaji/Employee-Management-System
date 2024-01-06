<?php

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

$TId =$_POST["TId"];
$taskName= $_POST["taskName"];
$StartDate= $_POST["StartDate"];
$endDate= $_POST["endDate"];
$nature= $_POST["nature"];


$sql = "INSERT INTO task
        VALUES ('$TId','$taskName','$StartDate','$endDate','$nature')"; 

        if (mysqli_query($conn, $sql)){
            echo "New record has been added successfully";
        }
        else{
            echo "Error: " .$sql . "<br>" . mysqli_error($conn);
            mysqli_error($conn);
        }

        mysqli_close($conn);


?>