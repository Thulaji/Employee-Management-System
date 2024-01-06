
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
       
        'task' => 'TId',
       
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


$TId_options = getOptions($conn, "task", "TId");


// Retrieve the data from the URL parameters
$act = $_GET['act'];
$TId = $_GET['Td'];
$activity = $_GET['nm'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $activityId = $_POST['activityid'];
    $TId = $_POST['TId'];
    $acivity = $_POST['activity'];
   

    // Prepare the SQL statement for updating the record
    // $query = "UPDATE assign SET EId='$EId', Tid='$TId', dateassign='$input1', ActivityId='$acivityid', remark='$input2' WHERE EId='$EId'";
    $query = "UPDATE taskactivities SET TId='$TId', activity='$activity' WHERE acivityId='$activityId'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['status'] = "Data updated successfully";
        header('location: activitydetails.php');
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
                    <label hidden for="activityId">Activity Id:</label>
                    <input hidden name="activityId" id="activityId" value="<?php echo $activityId; ?>"/>

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
                
                <!-- Dropdown 3 - ActivityID -->
                <div class="field input">
                    <label for="activity">Activity Name:</label>
                    <input name="activity" id="activity" value="<?php echo $activity; ?>" />
                        
                </div>
                <br><br>
                
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
          window.location.href = "activitydetails.php";
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

