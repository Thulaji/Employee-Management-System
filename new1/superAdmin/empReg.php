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

$EId =$_POST["EId"];
$telephone= $_POST["telephone"];
$name= $_POST["name"];
$email= $_POST["email"];
$designation= $_POST["designation"];


$sql = "INSERT INTO employee
        VALUES ('$EId','$telephone','$name','$email','$designation')"; 

        // if (mysqli_query($conn, $sql)){
        //     echo "New record has been added successfully";
        // }
        // else{
        //     echo "Error: " .$sql . "<br>" . mysqli_error($conn);
        //     mysqli_error($conn);
        // }

       $query_run= mysqli_query($conn, $sql);
       if($query_run){
        $_SESSION['status']="data inserted successfully";
        header('location:employeedetails.php');
       }
       mysqli_close($conn);
?>

<?php
// <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
// <script>swal({
//     title: "Good job!",
//     text: "You clicked the button!",
//     icon: "success",
//     button: "Aww yiss!",
//   });</script>
?>