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
    <title>Admin Page</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="styleee.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  
  </head>
  <body>
    <div class="slidebar">
      <div class="logo">
        <img src="w.jpeg" alt="">
      </div>
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
          <h2>Admin</h2>
          <span>Dashboard</span>
        </div>
        <div class="user-info">
          
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
                <?php echo $_SESSION["username"];?>
                <!-- <i class="fa-solid fa-angle-down"></i> -->
              </span>
            </div>
          </div>
         <!-- end of user frofile -->
        </div>
      </div>
        <div class="card-container">
          <h1 class="main-title">Today</h1>
          <div class="card-wrapper">
            
            <div class="activetask-card light-purple" onclick="redirectToAnotherPage()">
              <div class="card-header">
                <div class="task">
                  <span class="title"> Employees </span>
                  <!-- <span class="amount-value"></span> -->
                </div>
                <div class="icon">
                  <i class="fa fa-bookmark"></i>
                </div>
              </div>
              <?php
                $dash_employee_query="SELECT * FROM employee";
                $dash_employee_query_run = mysqli_query($conn,$dash_employee_query);

                if($admin_count =  mysqli_num_rows( $dash_employee_query_run)){
                  echo '<h4 class="mb-0">'.$admin_count.'</h4>';
                }
                else{
                  echo '<h4 class="mb-0">No Data</h4>';
                }
              ?>
              <!-- <span class="card-details"> 12</span> -->
            </div>
            <div class="activetask-card light-purple" onclick="redirectToTaskPage()">
              <div class="card-header">
                <div class="task">
                  <span class="title"> Task </span>
                  <span class="amount-value"></span>
                </div>
                <div class="icon">
                  <i class="fa fa-list" aria-hidden="true"></i>
                </div>
              </div>
              <span class="card-details"> 34 </span>
            </div>
            
            <div class="activetask-card light-purple" onclick="redirectToPendingTaskPage()">
              <div class="card-header">
                <div class="task">
                  <span class="title"> Pending tasks </span>
                  <span class="amount-value"></span>
                </div>
                <div class="icon">
                  <i class="fa fa-exclamation" aria-hidden="true"></i>
                </div>
              </div>
              <?php
              $dash_employee_query="SELECT * FROM task WHERE nature='Pending'";
              $dash_employee_query_run = mysqli_query($conn,$dash_employee_query);

              if($admin_count =  mysqli_num_rows( $dash_employee_query_run)){
                echo '<h4 class="mb-0">'.$admin_count.'</h4>';
              }
              else{
                echo '<h4 class="mb-0">No Data</h4>';
              }
              ?>
              <!-- <span class="card-details"> 7</span> -->
            </div>
            <div class="activetask-card light-purple" onclick="redirectToActiveTaskPage()">
              <div class="card-header">
                <div class="task">
                  <span class="title">Active tasks</span>
                  <span class="amount-value"></span>
                </div>
                <div class="icon">
                  <i class="fa fa-bookmark"></i>
                </div>
              </div>
              <?php
              $dash_employee_query="SELECT * FROM task WHERE nature='Active'";
              $dash_employee_query_run = mysqli_query($conn,$dash_employee_query);

              if($admin_count =  mysqli_num_rows( $dash_employee_query_run)){
                echo '<h4 class="mb-0">'.$admin_count.'</h4>';
              }
              else{
                echo '<h4 class="mb-0">No Data</h4>';
              }
              ?>
              <!-- <span class="card-details">10 </span> -->
            </div>
            <div class="activetask-card light-purple" onclick="redirectToCompleteTaskPage()">
              <div class="card-header">
                <div class="task">
                  <span class="title"> Completed tasks </span>
                  <span class="amount-value"></span>
                </div>
                <div class="icon">
                  <i class="fa fa-check" aria-hidden="true"></i>
                </div>
              </div>
              <?php
              $dash_employee_query="SELECT * FROM task WHERE nature='Complete'";
              $dash_employee_query_run = mysqli_query($conn,$dash_employee_query);

              if($admin_count =  mysqli_num_rows( $dash_employee_query_run)){
                echo '<h4 class="mb-0">'.$admin_count.'</h4>';
              }
              else{
                echo '<h4 class="mb-0">No Data</h4>';
              }
              ?>
              <!-- <span class="card-details"> 6 </span> -->
            </div>
          </div>
        </div>
        <div class="tabular-wrapper">
          <h3 class="main-title">Report</h3>
          <div class="table-container">
            <table>
              <thead>
                <tr>
                <th>EId</th>
                <th>Telephone</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <!-- <th>Action</th> -->
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
                $query = "SELECT * FROM employee";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                      echo "<tr>";
                      echo "<td>" . $row['EId'] . "</td>";
                      echo "<td>" . $row['Telephone'] . "</td>";
                      echo "<td>" . $row['Name'] . "</td>"; // Assuming these are your column names
                      echo "<td>" . $row['Email'] . "</td>";
                      echo "<td>" . $row['Designation'] . "</td>";
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
    function redirectToAnotherPage() {
        // Change the URL to the desired page
        window.location.href = 'employee.php';
    }
    function redirectToAdminPage() {
        // Change the URL to the desired page
        window.location.href = 'admin.php';
    }
    function redirectToTaskPage() {
        // Change the URL to the desired page
        window.location.href = 'Tasks.php';
    }
    function redirectToPendingTaskPage() {
        // Change the URL to the desired page
        window.location.href = 'pendingTask.php';
    }
    function redirectToActiveTaskPage() {
        // Change the URL to the desired page
        window.location.href = 'activetask.php';
    }
    function redirectToCompleteTaskPage() {
        // Change the URL to the desired page
        window.location.href = 'completetask.php';
    }
    
</script>


      <script>
       
        const toggle = () => profileDropdownList.classList.toggle("active");

        window.addEventListener('click',function (e) {
          if(!btn.contains(e.target))profileDropdownList.classList.remove("active");
        });
      </script>
  </body>
</html>
