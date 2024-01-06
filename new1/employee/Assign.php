<?php
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

function getOptions($conn, $tableName, $columnName) {
    $allowedTables = [
        'employee' => 'EId',
        'task' => 'TId',
        'takactivitites' => 'acivityid'
    ];
    
    // Check if the table and column are allowed
    if (!array_key_exists($tableName, $allowedTables) || $allowedTables[$tableName] != $columnName) {
        return ""; 
    }

    $options = "";
    $query = "SELECT $columnName FROM $tableName";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row[$columnName] . "'>" . $row[$columnName] . "</option>";
    }

    return $options;
}

$EId_options = getOptions($conn, "employee", "EId");
$TId_options = getOptions($conn, "task", "TId");
$acivityid_options = getOptions($conn, "takactivitites", "acivityid");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $EId = $_POST['EId'];
    $TId = $_POST['TId'];
    $acivityid = $_POST['acivityid'];
    $input1 = $_POST['input1']; // This is assumed to be the 'dateassign' for demonstration purposes.
    $input2 = $_POST['input2']; // This is assumed to be the 'remark' for demonstration purposes.

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO assign (Eid, Tid, dateassign, ActivityId, remark) VALUES (?, ?, ?, ?, ?)");
    
    // Bind the parameters
    $stmt->bind_param("sssss", $EId, $TId, $input1, $acivityid, $input2);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
    <link rel='stylesheet' href='sty.css' />

    <!-- <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3ebf6; /* Light purple background */
            color: #5a3a63; /* Dark purple text for contrast */
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #b19cd9; /* Border color as light purple */
            border-radius: 5px;
            background-color: white;
        }

        label, input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #b19cd9; /* Light purple border */
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #b19cd9; /* Light purple background */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #9575a8; /* A slightly darker shade for hover */
        }
    </style> -->
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <center><header>Assign Task</header></center>
            <form action="" method="post">
                <!-- Dropdown 1 - EId -->
                <div class="field input">
                    <label for="EId">Select EId:</label>
                    <select name="EId" id="EId">
                    <option hidden>Select EId</option>
                        <?php echo $EId_options; ?>
                    </select>
                </div>
                <br><br>
                <!-- Dropdown 2 - TId -->
                <div class="field input">
                    <label for="TId">Select TId:</label>
                    <select name="TId" id="TId">
                    <option hidden>Select TId</option>
                        <?php echo $TId_options; ?>
                    </select>
                </div>
                <br><br>

                  <!-- Normal Input 1 -->
                  <div class="field input">
                    <label for="input1">Assign Date</label>
                    <input type="date" id="input1" name="input1">
                </div>
                <br><br>
                <!-- Dropdown 3 - ActivityID -->
                <div class="field input">
                    <label for="acivityid">Select ActivityID:</label>
                    <select name="acivityid" id="acivityid">
                    <option hidden>Select ActivityID</option>
                        <?php echo $acivityid_options; ?>
                    </select>
                </div>
                <br><br>

                <!-- Normal Input 2 -->
                <div class="field input">
                    <label for="input2">Remark</label>
                    <input type="text" id="input2" name="input2">
                <br><br>
                </div>
                <div class="field">
                    <input type="submit" class="btn" value="Submit" required>
                </div>
            </form>
        </div>
    </div>
</body>
</html>