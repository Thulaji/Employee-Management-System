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
$acivityid_options = getOptions($conn, "taskactivities", "acivityid");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $EId = $_POST['EId'];
    $TId = $_POST['TId'];
    $acivityid = $_POST['acivityid'];
    $input1 = $_POST['input1']; // This is assumed to be the 'dateassign' for demonstration purposes.
    $input2 = $_POST['input2']; // This is assumed to be the 'remark' for demonstration purposes.

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO assign (EId, Tid, dateassign, ActivityId, remark) VALUES (?, ?, ?, ?, ?)");
    
    // Bind the parameters
    $stmt->bind_param("sssss", $EId, $TId, $input1, $acivityid, $input2);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "New record created successfully";
        $_SESSION['status']="data inserted successfully";
        header('location:AssignDetails.php');
    }

    // } else {
    //     echo "Error: " . $stmt->error;
    // }
    // $query_run= mysqli_query($conn,  $stmt);
    //    if($query_run){
    //     $_SESSION['status']="data inserted successfully";
    //     header('location:AssignDetails.php');
    //    }

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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <style>
      
        .form-box form .input small {
        font-size: 15px;
        color: red;
        visibility: hidden;
      }
      .form-box form .input  i {
        /* position: absolute; */
        right: 10px;
        top: 35px;
        visibility: hidden;
      }
    
      .field {
        position: relative;
        margin-bottom:-45px;
      }
      .form-box form .success input {
        border: 3px green solid;
      }

      .form-box form .error input {
        border: 3px red solid;
      }

      .form-box form .error small {
        visibility: visible;
      }

      .form-box form .success .fa-circle-check {
        visibility: visible;
        color: #5bcd8c;
      }

      .form-box form .error  .fa-circle-exclamation {
        visibility: visible;
        color: #ca4e4e;
      }
      .form-box form .input:last-child{
       
      }
      label[for="input2"], input#input2 {
    /* Your styles for both label and input go here */
}
.form-box form .input:last-child {
    margin-bottom: 20px; /* Adjust the value to increase or decrease the gap */
}
      
    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <center><header>Assign Task</header></center>
            <form  
            action=""
            method="post"
            id="form"
            onsubmit="return validateForm(event)"
            autocomplete="off"
            novalidate>
                <!-- Dropdown 1 - EId -->
                <div class="field input">
                    <label for="EId">Select EId:</label>
                    <select name="EId" id="EId">
                    <option hidden>Select EId</option>
                        <?php echo $EId_options; ?>
                    </select>
                        <!-- <i class="fa-solid fa-circle-check"></i> -->
                        <i class="fa-sharp fa-solid fa-circle-exclamation"></i>
                        <small>Error Message</small>
                </div>
                <br><br>
                <!-- Dropdown 2 - TId -->
                <div class="field input">
                    <label for="TId">Select TId:</label>
                    <select name="TId" id="TId">
                    <option hidden>Select TId</option>
                        <?php echo $TId_options; ?>
                    </select>
                    <!-- <i class="fa-solid fa-circle-check"></i> -->
                        <i class="fa-sharp fa-solid fa-circle-exclamation"></i>
                        <small>Error Message</small>
                </div>
                <br><br>

                  <!-- Normal Input 1 -->
                  <div class="field input">
                    <label for="input1">Assign Date</label>
                    <input type="date" id="input1" name="input1">
                    <!-- <i class="fa-solid fa-circle-check"></i> -->
                        <i class="fa-sharp fa-solid fa-circle-exclamation"></i>
                        <small>Error Message</small>
                </div>
                <br><br>
                <!-- Dropdown 3 - ActivityID -->
                <div class="field input">
                    <label for="acivityid">Select ActivityID:</label>
                    <select name="acivityid" id="acivityid">
                    <option hidden>Select ActivityID</option>
                        <?php echo $acivityid_options; ?>
                    </select>
                    <!-- <i class="fa-solid fa-circle-check"></i> -->
                        <i class="fa-sharp fa-solid fa-circle-exclamation"></i>
                        <small>Error Message</small>
                </div>
                <br><br>

                <!-- Normal Input 2 -->
                <div class="field input">
                    <label for="input2">Remark</label>
                    <input type="text" id="input2" name="input2">
                    <!-- <i class="fa-solid fa-circle-check"></i> -->
                        <i class="fa-sharp fa-solid fa-circle-exclamation"></i>
                        <small>Error Message</small>
                <br><br>
                </div>
                <!-- <div class="field">
                    <input type="submit" class="btn" value="Submit" required>
                </div> -->
                <div class="field">
                <button type="submit" class="btn" name="submit">Save</button>
                <button type="button" class="btn cancel-btn">Cancel</button>
            
          </div>
          <!-- <div class="field">
            <button type="button" class="btn cancel-btn">Cancel</button>
          </div> -->
            </form>
        </div>
    </div>
    <script src="assignJscript.js"></script>
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