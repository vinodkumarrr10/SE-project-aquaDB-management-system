<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overdue Rentals</title>
</head>
<body>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;
            font-size: 18px;
        }
        body {
            margin: 4vh;
            background: url('marble.jpg') ;
           
            background-size: auto;
            background-position: center;
        }
</style>
<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aquadb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current date
$currentDate = date("Y-m-d");

// SQL query to retrieve relevant rental information with nested query for item_model
$sql = "SELECT r.customer_phone, r.item_id, i.item_model
        FROM rentpro r
        JOIN Inventory_Items i ON r.item_id = i.item_id
        WHERE r.rent_end_date <= '$currentDate'
        AND r.item_return_date IS NULL";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Overdue Rentals</h2>";
    echo "<ol>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $customerPhone = $row["customer_phone"];
        $customer_name= $row["customer_name"];
        $itemId = $row["item_id"];
        $itemModel = $row["item_model"];

        // Display rental information in list format
        echo "<li>Customer Phone: $customerPhone , Product Details: $itemId ($itemModel) - Overdue</li>";
    }

    echo "</ol>";
} else {
    echo "<p>No overdue rentals found.</p>";
}

// Close the connection
$conn->close();
?>

</body>
</html>
