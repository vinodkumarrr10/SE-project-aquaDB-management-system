<?php
// Include your database connection code here
$conn = mysqli_connect("localhost", "root", "", "aquadb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['store'])) {
    $selectedStore = $_GET['store'];

    $sql = "SELECT * FROM rentpro";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Rent Details for Store: $selectedStore</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Rent ID</th>
                    <th>Customer Phone
                    <th>Items ID</th>
                    <th>Rent Date</th>
                    <th>valid upto</th>
                    <th>returned on</th>
                    
                    <th>Price</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['customer_phone'] . "</td>";
            echo "<td >" . $row['item_id'] . "</td>";
            echo "<td>" . $row['rent_start_date'] . "</td>";
            echo "<td>" . $row['rent_end_date'] . "</td>";
            echo "<td>" . $row['item_return_date'] . "</td>";
            
            echo "<td>" . $row['total_amount'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No orders found for Store: $selectedStore</p>";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
