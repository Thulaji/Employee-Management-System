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
$EId = $_GET['Ed'];
$telephone = $_GET['Tel'];
$name=$_GET['na'];
$email = $_GET['em'];
$designation= $_GET['de'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $EId =$_POST["EId"];
    $telephone= $_POST["telephone"];
    $name= $_POST["name"];
    $email= $_POST["email"];
    $designation= $_POST["designation"];

   
    // Prepare the SQL statement for updating the record
    // $query = "UPDATE assign SET EId='$EId', Tid='$TId', dateassign='$input1', ActivityId='$acivityid', remark='$input2' WHERE EId='$EId'";
    $query = "UPDATE employee SET EId='$EId', Telephone='$telephone', Name='$name', Email='$email', Designation='$designation' WHERE EId='$EId'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['status'] = "Data updated successfully";
        header('location: employeedetails.php');
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
            <center><header>Update Employee</header></center>
            <form action="" method="post">
          <div class="field input">
            <label for="EId">Employee ID</label>
            <input type="text" name="EId" id="EId" value="<?php echo $EId; ?>" />
          </div>
          <div class="field input">
            <label for="telephone">Telephone</label>
            <input type="number" name="telephone" id="telephone" value="<?php echo $telephone; ?>" />
          </div>
          <div class="field input">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?> "/>
          </div>
          <div class="field input">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" />
          </div>
          <div class="field input">
            <label for="designation">Designation</label>
            <input type="text" name="designation" id="designation" value="<?php echo $designation; ?> "/>
          </div>
          <div class="field">
            <input type="submit" class="btn" name="submit" value="Updater" />
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
