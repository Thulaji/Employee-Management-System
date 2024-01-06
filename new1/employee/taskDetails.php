<?php
session_start();
// if (!isset($_SESSION["EId"])) {
//   header("location: login.php"); // Redirect to the login page if not logged in
//   exit();
// }

$employeeId = $_SESSION["EId"];
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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>task Page</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="styleee.css" />
  </head>
  <body>
    <div class="slidebar">
      <div class="logo"></div>
      <ul class="menu">
        <li class="active">
          <a href="adminSuper.php">
            <i class="fas fa fa-tachometer"></i>
            <span>Dashboad</span>
          </a>
        </li>
        <li>
          <a href="taskDetails.php">
            <i class="fa fa-tasks"></i>
            <span>Task</span>
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
          <span>primary</span>
          <h2>Dashboad</h2>
        </div>
        <div class="user-info">
          <!-- <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="search" />
          </div> -->

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
                <?php echo $result['username'];?>
                <!-- <i class="fa-solid fa-angle-down"></i> -->
              </span>
            </div>

            <!-- <ul class="profile-dropdown-list">
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
            </ul> -->
          </div>
         <!-- end of user frofile -->
        </div>
      </div>
 
        <div class="tabular-wrapper">
          <h3 class="main-title">Report</h3>
          <div class="table-container">
          <?php


// Check if the user is logged in
if (!isset($_SESSION["EId"])) {
    header("location: login.php"); // Redirect to the login page if not logged in
    exit();
}

$employeeId = $_SESSION["EId"]; // Retrieve the Employee ID from the session

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "project";

// Create a database connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// Query to fetch data from the "assign" table for the specific employee
$sql = "SELECT * FROM assign WHERE EId = '$employeeId'";

$result = mysqli_query($conn, $sql);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

echo "<table>
        <thead>
            <tr>
                <th>EId</th>
                <th>Tid</th>
                <th>dateassign</th>
                <th>ActivityId</th>
                <th>remark</th>
            </tr>
        </thead>
        <tbody>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>" . $row["EId"] . "</td>
            <td>" . $row["Tid"] . "</td>
            <td>" . $row["dateassign"] . "</td>
            <td>" . $row["ActivityId"] . "</td>
            <td>" . $row["remark"] . "</td>
          </tr>";
}

echo "</tbody></table>";

?>
<!DOCTYPE html>
<html lang="en">
<!-- Rest of your HTML code -->

            <!-- <table>
              <thead>
                <tr>
                  <th>TId</th>
                  <th>name</th>
                  <th>Startdate</th>
                  <th>Enddate</th>
                  <th>nature</th>
                </tr>
              </thead>
              
            </table> -->
          </div>
        </div>
      
    
      <script>
        let profileDropdownList = document.querySelector(".profile-dropdown-list");
        let btn = document.querySelector(".profile-dropdown-btn");

        const toggle = () => profileDropdownList.classList.toggle("active");

        window.addEventListener('click',function (e) {
          if(!btn.contains(e.target))profileDropdownList.classList.remove("active");
        });
      </script>
  </body>
</html>
