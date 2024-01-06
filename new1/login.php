<?php
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
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["username"];
    $password= $_POST["password"];
    // $_SESSION["myuser"] = $row['EId'];

    // // Prepare the SQL statement
    // $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    // $stmt->bind_param("ss", $username, $password);

    // // Execute the statement
    // $stmt->execute();

    // // Get the result
    // $result = $stmt->get_result();
    // $row = $result->fetch_assoc();

    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    
    
    $result=mysqli_query($conn,$sql);

    $row=mysqli_fetch_array($result);
    

    if($row["userType"]=="Super Admin"){
        $_SESSION["username"]=$row['username'];
        header("location:superAdmin\adminSuper.php");
    }

    else if($row["userType"]=="Admin"){
        $_SESSION["username"]=$row['username'];
        header("location:Admin\adminSuper.php");
    }

    else if($row["userType"]=="User"){
        $_SESSION["username"]=$row['username'];
        $_SESSION["EId"] = $row['EId'];
        header("location:employee\adminSuper.php");
        
    }

    else{
        echo "username or password incorect";
    }

    
}
?>
 <!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <!-- <div class="employeereg">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username"> username: </label><br>
            <input type="text" name="username" id="username" placeholder="username" required><br>

            <label for="Password"> Password: </label><br>
            <input type="password" name="Password" id="Password" placeholder="Password" required><br>


            <button type="submit"> Login </button> 
            
            

        </form>

    </div> -->

    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="login.php" method="POST">
                    <h2>Login</h2>
                    <div class="input-box">
                        <ion-icon name="contact"></ion-icon>
                        <input type="text" name="username" required>
                        <label for="">username</label>
                    </div>

                    <div class="input-box">
                        <ion-icon name="eye-off"></ion-icon>
                        <input type="password" name="password"  required>
                        <label for="">Password</label>
                    </div>

                    <div class="forget">
                        <label for="">
                            <input type="checkbox">Remember Me
                            <a href="#">Forget Password</a>
                        </label>
                    </div>

                    <button>Login</button>

                    <!-- <div class="register">
                        <label for="">
                            Don't have an account
                            <a href="#">Register </a>
                        </label>
                    </div> -->
                </form>
            </div>
        </div>
    </section>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

</body>
</html>