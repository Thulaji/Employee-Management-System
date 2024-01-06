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

?>
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Emploee Page</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="styleee.css" />
  <style>
      .Ebtn, .Dbtn {
   font-family: Arial, sans-serif;  
   padding: 8px 16px;  
   border-radius: 4px;  
   cursor: pointer;  
   transition: background-color 0.3s ease; 
   margin: 0 5px;  
}


.Ebtn {
   background-color: #000000;  
   color: #ffffff;  
}

.Ebtn:hover {
   background-color: #45a049;  
}


.Dbtn {
   background-color: #000000;  
   color: #ffffff;  
}

.Dbtn:hover {
   background-color: #da190b;  
}
    </style>
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
          <h2>Activity</h2>
          <span>Details</span>
        </div>
        <div class="user-info">
          <!-- <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="search" />
          </div> -->
          <!-- <img src="5907.jpg" alt="" /> -->
          <!-- <img src="logo.png" class="navbar-logo" alt="logo" /> -->

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
                <i class="fa-solid fa-angle-down"></i>
              </span>
            </div>

            <ul class="profile-dropdown-list">
              <li class="profile-dropdown-list-item">
                <a href="#">
                  <i class="fa-regular fa-user"></i>
                    Edit Profile
                </a>
              </li>
              <li class="profile-dropdown-list-item">
                <a href="#">
                  <i class="fa-regular fa-envelope"></i>
                    Inbox
                </a>
              </li>

              <li class="profile-dropdown-list-item">
                <a href="#">
                  <i class="fa-solid fa-chart-line"></i>
                    Analytics
                </a>
              </li>
              <li class="profile-dropdown-list-item">
                <a href="#">
                  <i class="fa-solid fa-sliders"></i>
                    Settings
                </a>
              </li>

              <li class="profile-dropdown-list-item">
                <a href="#">
                  <i class="fa-regular fa-circle-question"></i>
                    Help & Support
                </a>
              </li>
              <hr />

              <li class="profile-dropdown-list-item">
                <a href="#">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i>
                  Log out
                </a>
              </li>
            </ul>
          </div>
         <!-- end of user frofile -->
        </div>
      </div>
 
        <div class="tabular-wrapper">
        <div class="top-right">
        <button class="my-button" id="my-button">Add Activity</button>
      </div>
      <br>
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
                <th>Activity Id</th>
                <th>TID</th>
                <th>Activity</th>
                <th>Action</th>
                
                  <!-- <th>EId</th>
                  <th>Name</th>
                  <th>Project name</th>
                  <th>task name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th> -->
                </tr>
                <tbody>
                <?php 
                $query = "SELECT * FROM taskactivities";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                      echo "<tr>";
                      echo "<td>" . $row['acivityid'] . "</td>";
                      echo "<td>" . $row['TId'] . "</td>";
                      echo "<td>" . $row['activity'] . "</td>"; // Assuming these are your column names
                      // echo "<td><a href='updateActivity.php?act=" . $row['acivityid'] . "$ Td=" . $row['TId'] . "$ nm=" . $row['acivity'] . "'>Edit</a> / <a href='deleteActivity.php?act=" . $row['acivityid'] . "'>Delete</a></td>";
                      echo "<td><a href='updateActivity.php?act=" . $row['acivityid'] . "&Td=" . $row['TId'] . "&nm=" . $row['activity'] . "'>Edit</a> / <a href='deleteActivity.php?act=" . $row['acivityid'] . "'>Delete</a></td>";

                      // echo "<td>" . $row['Action'] . "</td>";
                      echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='7'>No records found</td></tr>";
                }
                ?>
                </tbody>
              </thead>
            </table>
          </div>
        </div>
      
    
      <script>
            document.getElementById("my-button").addEventListener("click", function() {
            window.location.href = "activity.php"; // Replace with your desired URL or path
        });
        let profileDropdownList = document.querySelector(".profile-dropdown-list");
        let btn = document.querySelector(".profile-dropdown-btn");

        const toggle = () => profileDropdownList.classList.toggle("active");

        window.addEventListener('click',function (e) {
          if(!btn.contains(e.target))profileDropdownList.classList.remove("active");
        });
      </script>
  </body>
</html>
