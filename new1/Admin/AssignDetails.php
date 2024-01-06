<?php
session_start();
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

// $query = "SELECT * FROM assign";
// $stmt = $pdo->query($query);
// $assign = $stmt->fetchAll();
// ?>
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link rel="stylesheet" href="styleee.css" />

</head>
<body>
<div class="slidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li <?php echo ($current_page == 'adminSuper.php') ? 'class="active"' : ''; ?>>
          <a href="adminSuper.php">
            <i class="fas fa fa-tachometer"></i>
            <span>Dashboad</span>
          </a>
        </li>
        <li <?php echo ($current_page == 'employeedetails.php') ? 'class="active"' : ''; ?>>
          <a href="employeedetails.php">
            <i class="fa fa-user"></i>
            <span>Employee</span>
          </a>
        </li>

        <li <?php echo ($current_page == 'taskDetails.php') ? 'class="active"' : ''; ?>>
          <a href="taskDetails.php">
            <i class="fa fa-tasks"></i>
            <span>Task</span>
          </a>
        </li>

        <li <?php echo ($current_page == 'activitydetails.php') ? 'class="active"' : ''; ?>>
          <a href="activitydetails.php">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            <span>Activity</span>
          </a>
        </li>
        <li <?php echo ($current_page == 'AssignDetails.php') ? 'class="active"' : ''; ?>>
          <a href="AssignDetails.php">
          <i class="fa fa-bookmark" aria-hidden="true"></i>
            <span>Assign</span>
          </a>
        </li>

        <li>
          <a href="#">
            <i class="fa fa-file-text"></i>
            <span>Report</span>
          </a>
        </li>
        <li class="logout">
          <a href="../logout.php">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="main-content">
      <div class="header-wrapper">
        <div class="header-title">
          <h2>Assign</h2>
          <span>Details</span>
        </div>
        
          <?php
            $sel="SELECT * FROM users";
            $query=mysqli_query($conn,$sel);
            $result=mysqli_fetch_assoc( $query);
          ?>


          <!-- user profile -->
          <div class="profile-dropdown">
            <div onclick="toggle()" class="profile-dropdown-btn">
              <div class="profile-img">
                <i class="fa-solid fa-circle"></i>
              </div>
              <span>
                <?php echo  $_SESSION["username"];?>
                
              </span>
            </div>

            
         <!-- end of user frofile -->
        </div>
    </div>
    <br>
       
      
      <div class="tabular-wrapper">
      <div class="top-right">
        <button class="my-button" id="my-button">Assign Details</button>
      </div>
        <h3 class="main-title">Report</h3>
        <?php
          if(isset($_SESSION['status']))
          {
          ?>
              
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!</strong><?php echo $_SESSION['status'];?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
          <?php
              unset($_SESSION['status']);
          }
        ?>
        <div class="table-container">
        <table>
        <thead>
            <tr>
                <th>Eid</th>
                <th>Tid</th>
                <th>dateassign</th>
                <th>ActivityId</th>
                <th>remark</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
                $query = "SELECT * FROM assign";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                      echo "<tr>";
                      echo "<td>" . $row['EId'] . "</td>";
                      echo "<td>" . $row['TId'] . "</td>";
                      echo "<td>" . $row['dateassign'] . "</td>"; // Assuming these are your column names
                      echo "<td>" . $row['ActivityId'] . "</td>";
                      echo "<td>" . $row['remark'] . "</td>";
                      // echo "<td>" . $row['Action'] . "</td>";
                      // echo "<td><a href='updateAssign.php? Ed=" . $row['EId'] ."    Td=". $row['Tid'] ." &  da= ". $row['dateassign'] ." &  Act=". $row['ActivityId'] ." &  re=". $row['remark'] ." '>Edit</a> / <a href='deleteTask.php?TId=" . $row['Tid'] . "'>Delete</a></td>";
                         echo "<td><a href='updateAssign.php? Ed=" . $row['EId'] . "& Td=" . $row['TId'] . "& da=" . $row['dateassign'] . "& Act=" . $row['ActivityId'] . "&re=" . $row['remark'] . "'>Edit</a> / 
                         <a href='deleteassign.php?Ed=" . $row['EId'] . " & Td=" . $row['TId'] . " & Act=" . $row['ActivityId'] . "'>Delete</a></td>";

                      echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='7'>No records found</td></tr>";
                }
                ?>
        </tbody>
    </table> 
        </div>
      </div>
    </div>
    <script>
        document.getElementById("my-button").addEventListener("click", function() {
            window.location.href = "Assign .php"; // Replace with your desired URL or path
        });

       
    </script>
    
</body>
</html>