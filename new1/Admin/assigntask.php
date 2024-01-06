<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check for connection error
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['hidden_TId_name']) && isset($_POST['hidden_Activity_name'])) {

    // Loop through the array of Task IDs and Activity names
    for($i=0; $i < count($_POST['hidden_TId_name']); $i++) {

        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO taskactivities (TId,activity) VALUES (?, ?)");

        // Bind the parameters to the statement
        $stmt->bind_param("ss", $_POST['hidden_TId_name'][$i], $_POST['hidden_Activity_name'][$i]);

        // Execute the statement
        $stmt->execute();
    }
    
    $stmt->close();

    echo "Data Inserted Successfully";
} else {
    echo "Error: Required data not received.";
}

$conn->close();

?>