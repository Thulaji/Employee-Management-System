<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$query = "SELECT * FROM employee";
$result_set = mysqli_query($conn, $query);

$EId_list = "";
while ($result = mysqli_fetch_assoc($result_set)) {
    $EId_list .= "<option value='{$result['EId']}'>{$result['EId']}</option>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EId = $_POST["EId"];
    $usertype = $_POST["usertype"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    $sql = "INSERT INTO users  VALUES ('$EId','$usertype','$Username','$Password')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("New record has been added successfully");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styl.css" />
    <title>Employee</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Employee</header>
            <form action="" autocompleted="off" method="post">
                <div class="field input">
                    <label for="EId">Employee ID</label>
                    <select type="text" name="EId" id="EId" required>
                        <option value="" selected="selected">Select TID</option>
                        <?php echo $EId_list; ?>
                    </select>
                </div>
                <div class="field input">
                    <label for="usertype">User Type</label>
                    <select type="text" name="usertype" id="usertype">
                        <option value="" selected="selected">Select User Type</option>
                        <option value="Super Admin">Super Admin</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="field input">
                    <label for="Username">Username</label>
                    <input type="text" name="Username" id="Username" required />
                </div>
                <div class="field input">
                    <label for="Password">Password</label>
                    <input type="Password" name="Password" id="Password" required />
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="register" />
                </div>
                <div class="field">
                    <input type="button" class="btn cancel-btn" value="Cancel" />
                </div>
            </form>
        </div>
    </div>
    <script>
        // Add JavaScript to handle the cancel button click event
        document
            .querySelector(".cancel-btn")
            .addEventListener("click", function () {
                window.location.href = "employeedetails.php";
            });
    </script>
</body>
</html>
