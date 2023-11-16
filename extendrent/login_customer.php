<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['customer_phone'])) {
        $error = "New Customer";
    } else {
        // Define $customer_username and $customer_password
        $customer_username = $_POST['customer_phone'];
        // $customer_password=$_POST['customer_password'];
        // Establishing Connection with Server by passing server_name, user_id, and password as a parameter
        require 'connection2.php';
        $conn = Connect();

        // SQL query to fetch information of registered users and find user match.
        $query = "SELECT customer_phone FROM rent_customers WHERE customer_phone=? LIMIT 1";

        // To protect MySQL injection for Security purpose
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $customer_username); // Bind the parameter correctly
        $stmt->execute();
        $stmt->bind_result($customer_phone);
        $stmt->store_result();

        if ($stmt->fetch())  // Fetching the contents of the row
        {
            $_SESSION['login_customer'] = $customer_phone; // Initializing Session
            header("location: index.php"); // Redirecting To Other Page
        } else {
            $error = "alpha beta gamma";
        }
        $stmt->close(); // Close the prepared statement
        $conn->close(); // Closing Connection
    }
}
?>
