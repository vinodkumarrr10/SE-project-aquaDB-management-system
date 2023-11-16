<?php
// Include your database connection code here
$conn = mysqli_connect("localhost", "root", "", "aquadb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['store'])) {
    $selectedStore = $_GET['store'];

    $sql = "SELECT * FROM Quotations2 WHERE store_id = '$selectedStore'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Quotation Details for Store: $selectedStore</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Quotation ID</th>
                    <th>Customer ID
                    <th>Quotation Date</th>
                    <th>Items</th>
                    <th>Price</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['quotation_id'] . "</td>";
            echo "<td>" . $row['customer_id'] . "</td>";
            echo "<td>" . $row['quotation_date'] . "</td>";
            echo "<td >" . $row['items'] . "</td>";
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
