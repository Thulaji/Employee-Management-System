<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$TId = $_POST["TId"];
$taskName = $_POST["taskName"];
$StartDate = $_POST["StartDate"];
$endDate = $_POST["endDate"];
$nature = $_POST["nature"];

$sql = "INSERT INTO task (TId, name, Startdate, Enddate, nature)
        VALUES ('$TId','$taskName','$StartDate','$endDate','$nature')";

$query_run = mysqli_query($conn, $sql);

if ($query_run) {
    // Rest of your code...
    $username = $_SESSION["username"];

    // Check if the employee exists in the employee table
    $check_employee_query = "SELECT EId FROM users WHERE username = '$username'";
    $check_employee_result = mysqli_query($conn, $check_employee_query);

    if (mysqli_num_rows($check_employee_result) > 0) {
        $employee_data = mysqli_fetch_assoc($check_employee_result);
        $EId = $employee_data['EId'];

        // Insert into the tuser table to associate the task with the user who created it
        $sql_tuser = "INSERT INTO tuser (EId, TId) VALUES ('$EId', '$TId')";
        $query_run_tuser = mysqli_query($conn, $sql_tuser);

        if ($query_run_tuser) {
            $_SESSION['status'] = "Data inserted successfully";
            header('location: taskDetails.php');
        } else {
            $_SESSION['status'] = "Error inserting data into tuser table: " . mysqli_error($conn);
            header('location: taskDetails.php');
        }
    } else {
        $_SESSION['status'] = "Employee with ID '$EId' does not exist";
        header('location: taskDetails.php');
    }
} else {
    $_SESSION['status'] = "Error inserting data into task table: " . mysqli_error($conn);
    header('location: taskDetails.php');
}

mysqli_close($conn);
?>
