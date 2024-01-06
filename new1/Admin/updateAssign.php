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

function getOptions($conn, $tableName, $columnName) {
    $allowedTables = [
        'employee' => 'EId',
        'task' => 'TId',
        'taskactivities' => 'acivityid'
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
$acivityid_options = getOptions($conn, "taskactivities", "ActivityId");

// Retrieve the data from the URL parameters
$EId = $_GET['Ed'];
$TId = $_GET['Td'];
$dateassign = $_GET['da'];
$ActivityId = $_GET['Act'];
$remark = $_GET['re'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $EId = $_POST['EId'];
    $TId = $_POST['TId'];
    $acivityid = $_POST['acivityid'];
    $input1 = $_POST['input1'];
    $input2 = $_POST['input2'];

    // Prepare the SQL statement for updating the record
    // $query = "UPDATE assign SET EId='$EId', Tid='$TId', dateassign='$input1', ActivityId='$acivityid', remark='$input2' WHERE EId='$EId'";
    $query = "UPDATE assign SET EId='$EId', Tid='$TId', dateassign='$input1', ActivityId='$acivityid', remark='$input2' WHERE EId='$EId'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['status'] = "Data updated successfully";
        header('location: AssignDetails.php');
    } else {
        echo "Failed to update record: " . mysqli_error($conn);
    }
}
?>

<!-- Your HTML code for the update form -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Form</title>
    <link rel='stylesheet' href='sty.css' />

   
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <center><header>Update Task</header></center>
            <form action="" method="post">
                <!-- Dropdown 1 - EId -->
                <div class="field input">
                    <label for="EId">Select EId:</label>
                    <select name="EId" id="EId">
                        <option hidden value="<?php echo $EId; ?>"><?php echo $EId; ?></option>
                        <?php echo $EId_options; ?>
                    </select>
                </div>
                <br><br>
                <!-- Dropdown 2 - TId -->
                <div class="field input">
                    <label for="TId">Select TId:</label>
                    <select name="TId" id="TId">
                        <option hidden value="<?php echo $TId; ?>"><?php echo $TId; ?></option>
                        <?php echo $TId_options; ?>
                    </select>
                </div>
                <br><br>
                <!-- Normal Input 1 -->
                <div class="field input">
                    <label for="input1">Assign Date</label>
                    <input type="date" id="input1" name="input1" value="<?php echo $dateassign; ?>">
                </div>
                <br><br>
                <!-- Dropdown 3 - ActivityID -->
                <div class="field input">
                    <label for="acivityid">Select ActivityID:</label>
                    <select name="acivityid" id="acivityid">
                        <option hidden value="<?php echo $ActivityId; ?>"><?php echo $ActivityId; ?></option>
                        <?php echo $acivityid_options; ?>
                    </select>
                </div>
                <br><br>

                <!-- Normal Input 2 -->
                <div class="field input">
                    <label for "input2">Remark</label>
                    <input type="text" id="input2" name="input2" value="<?php echo $remark; ?>">
                    <br><br>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="Update" value="Update" />
                    <button type="button" class="btn cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script>
      // Add JavaScript to handle the cancel button click event
      document
        .querySelector(".cancel-btn")
        .addEventListener("click", function () {
          window.location.href = "AssignDetails.php";
        });
        var date = new Date();
      var tdate = date.getDate();
      if (tdate < 10) {
        tdate = "0" + tdate;
      }
      var month = date.getMonth() + 1;
      if (month < 10) {
        month = "0" + month;
      }
      var year = date.getFullYear();
      var minDate = year + "-" + month + "-" + tdate;
      document.getElementById("input1").setAttribute("min", minDate);
      
    </script>
</body>
</html>
