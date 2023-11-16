<?php
// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "aquadb");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch productss from the database
$sql = "SELECT * FROM Inventory_Items";
$result = $conn->query($sql);

$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return products data as JSON
echo json_encode($products);
?>
