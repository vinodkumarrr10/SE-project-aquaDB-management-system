<?php
// mysqli_connect() function opens a new connection to the MySQL server.
require 'connection2.php';
$conn = Connect();

session_start();// Starting Session

// Storing Session
$user_check=$_SESSION['login_customer'];

// SQL Query To Fetch Complete Information Of User
$query = "SELECT customer_phone FROM rent_customers WHERE customer_phone = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['customer_phone'];
?>