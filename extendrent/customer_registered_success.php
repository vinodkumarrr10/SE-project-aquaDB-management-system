<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "aquadb";

    // Create a database connection
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize form data
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $customer_phone = $conn->real_escape_string($_POST['customer_phone']);
    $customer_email = $conn->real_escape_string($_POST['customer_email']);
    $customer_address = $conn->real_escape_string($_POST['customer_address']);

    // SQL query to insert data into the table
    $query = "INSERT INTO rent_customers (customer_name, customer_phone, customer_email, customer_address) VALUES ('$customer_name', $customer_phone, '$customer_email', '$customer_address')";

    if ($conn->query($query) === TRUE) {
        // Data inserted successfully
        echo "Registration successful. You can now log in.";
    } else {
        // Handle insertion error
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form wasn't submitted, redirect to the registration page
    header("Location: customersignup.php"); // Change this to the actual URL of your registration page
    exit();
}
?>
