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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>employee Page</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="styleee.css" />
    <script>
        function updateNature(selectElement) {
            const newValue = selectElement.value;
            const TdElement = selectElement.closest('tr').querySelector('td:first-child');
            const TId = TdElement.textContent;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        alert(response.message); // Display success/failure message
                    } else {
                        alert("Update failed"); // Handle any AJAX errors
                    }
                }
            };

            const data = `TId=${TId}&nature=${newValue}`;
            xhr.send(data); // Send the data to the server
        }
    </script>
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
        <!-- <li>
          <a href="employeedetails.php">
            <i class="fa fa-user"></i>
            <span>Employee</span>
          </a>
        </li> -->

        <li>
          <a href="taskDetails.php">
            <i class="fa fa-tasks"></i>
            <span>Task</span>
          </a>
        </li>

        <!-- <li>
          <a href="Assign.php">
            <i class="fa fa-pencil" aria-hidden="true"></i>
            <span>Assign</span>
          </a>
        </li> -->

        <!-- <li>
          <a href="#">
            <i class="fa fa-file-text"></i>
            <span>Report</span>
          </a>
        </li> -->
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
          <span>Task</span>
          <h2>Details</h2>
        </div>
        <div class="user-info">
          <!-- <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="search" />
          </div> -->
          <!-- <img src="5907.jpg" alt="" /> -->
          <!-- <img src="logo.png" class="navbar-logo" alt="logo" /> -->

          <!-- user profile -->
          <?php
            
            $sel="SELECT * FROM users";
            $query=mysqli_query($conn,$sel);
            $result=mysqli_fetch_assoc( $query);
          ?>
          <div class="profile-dropdown">
            <div onclick="toggle()" class="profile-dropdown-btn">
              <div class="profile-img">
                <i class="fa-solid fa-circle"></i>
              </div>
              <span>
              <?php echo $_SESSION["username"];?>
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
        <div class="card-container">
          <h1 class="main-title">Today</h1>
          <div class="card-wrapper">
            
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
              // $dash_employee_query="SELECT task.TId,name,Startdate,Enddate,nature FROM task INNER JOIN assign ON task.TId = assign.TId WHERE nature='Pending' AND username=" $_SESSION["username"]"";
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
            <form id="updateForm">
            <table>
              <thead>
                <tr>
                  <th>TId</th>
                  <!-- <th>Name</th> -->
                  <th>Task name</th>
                  <th>Activity name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                </tr>
                <tbody>
                  <?php
                  if (!isset($_SESSION["EId"])) {
                    header("location: login.php"); // Redirect to the login page if not logged in
                    exit();
                }
                
                    $employeeId = $_SESSION["EId"]; // Retrieve the Employee ID from the session
                    $query = "SELECT task.TId, name, activity, Startdate, Enddate, nature
          FROM users
          INNER JOIN assign ON users.EId = assign.EId
          INNER JOIN task ON task.tId = assign.TId
          INNER JOIN taskactivities ON taskactivities.acivityid = assign.ActivityId
          WHERE users.EId = 'T003' AND users.EId = '$employeeId'";

                    $fire = mysqli_query($conn, $query) or die('query failed'.mysqli_error($conn));
                    if(mysqli_num_rows($fire)>0)
                    {
                      while($result=mysqli_fetch_assoc($fire))
                      {
                        echo "<tr>";
                        echo "<td>".$result['TId']."</td>";
                        echo "<td>".$result['name']."</td>";
                        echo "<td>".$result['activity']."</td>";
                        echo "<td>".$result['Startdate']."</td>";
                        echo "<td>".$result['Enddate']."</td>";
                        // echo "<td>".$result['nature']."</td>";
                        // echo "<td><select name='nature'>";
                        // echo "<td><select class='nature-dropdown' data-task-id='".$result['TId']."'>";
                        // echo "<td><select name='nature' onchange='updateNature(this)'>";
                        // echo "<option hidden>".$result['nature']."</option>";
                        // echo "<option value='Active'>Active</option>";
                        // echo "<option value='Pending'>Pending</option>";
                        // echo "<option value='Completed'>Completed</option>";
                        // echo "</select></td>";
                        // echo "</tr>";
                        ?>
                        <td>
                        <select id="selectNature1" name='nature' onchange='updateNature(this)'>
                            <option hidden><?php echo $result['nature']; ?></option>
                            <option value='Active'>Active</option>
                            <option value='Pending'>Pending</option>
                            <option value='Completed'>Completed</option>
                        </select>

                        </td>
                        <?php
                      }
                    }

                  ?>
                </tbody>
              </thead>
            </table>
            </form>
          </div>
        </div>
      <script>
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
    
      
  </body>
</html>
