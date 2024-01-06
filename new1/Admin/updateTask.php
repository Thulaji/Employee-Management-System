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




// Retrieve the data from the URL parameters
$TId = $_GET['Td'];
$taskName =$_GET["nm"];
$startDate =$_GET["sd"];
$EndDate =$_GET["ed"];
$nature =$_GET["nt"];





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $TId =$_POST["TId"];
    $taskName= $_POST["taskName"];
    $StartDate= $_POST["StartDate"];
    $endDate= $_POST["endDate"];
    $nature= $_POST["nature"];

   
    // Prepare the SQL statement for updating the record
    // $query = "UPDATE assign SET EId='$EId', Tid='$TId', dateassign='$input1', ActivityId='$acivityid', remark='$input2' WHERE EId='$EId'";
    $query = "UPDATE task SET TId='$TId', name='$taskName', Startdate='$StartDate', Enddate='$endDate', nature='$nature' WHERE TId='$TId'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['status'] = "Data updated successfully";
        header('location: taskDetails.php');
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
          <div class="field input">
            <label for="TId">Task ID</label>
            <input type="text" name="TId" id="TId" value="<?php echo $TId; ?>" required />
          </div>
          <div class="field input">
            <label for="taskName">Task Name</label>
            <input type="text" name="taskName" id="taskName" value="<?php echo $taskName; ?>" required />
          </div>
          <div class="field input">
            <label for="StartDate">Start Date</label>
            <input type="date" name="StartDate" id="StartDate" value="<?php echo $startDate; ?>" required />
          </div>
          <div class="field input">
            <label for="endDate">End Date</label>
            <input type="date" name="endDate" id="endDate" value="<?php echo $EndDate; ?>" required />
          </div>
          <div class="field input">
            <label for="nature">Nature</label>
            <input type="text" name="nature" id="nature"  value="<?php echo $nature; ?>" required />
          </div>
          <div class="field">
            <input type="submit" class="btn" name="submit" value="Update" />
          </div>
          <div class="field">
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
          window.location.href = "taskDetails.php";
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
