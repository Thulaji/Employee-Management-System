<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["TId"]) && isset($_POST["nature"])) {
        $TId = $_POST["TId"];
        $nature = $_POST["nature"];

        // Use prepared statements to update the "nature" column
        $updateQuery = "UPDATE task SET nature = ? WHERE TId = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "si", $nature, $TId);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["message" => "Update successful"]);
        } else {
            echo json_encode(["message" => "Update failed"]);
        }
    }
}
?>
