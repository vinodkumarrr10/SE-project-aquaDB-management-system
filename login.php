<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submitq']))
 {
if (empty($_POST['lspass']) || empty($_POST['lsid'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username = $_POST['lsid'];
$password = $_POST['lspass'];

// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "root", "", "aquadb");

// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT employee_id,employee_password From Employees Where employee_id =? and employee_password =? and job_title='sm' Limit 1";

// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$stmt->bind_result($username, $password);
$stmt->store_result();

if($stmt->fetch()) //fetching the contents of the row
        {
          $_SESSION['login_user'] = $username; // Initializing Session
          header("location: inventoryhome.php"); // Redirecting To Profile Page
        }
else {
       $error = "Username or Password is invalid";
     }
mysqli_close($conn); // Closing Connection
}
}
?>
