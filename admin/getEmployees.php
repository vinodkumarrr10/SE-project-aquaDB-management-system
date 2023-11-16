<?php
// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "aquadb");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch employees from the database
$sql = "SELECT * FROM Employees";
$result = $conn->query($sql);

$employees = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return employees data as JSON
echo json_encode($employees);
?>
