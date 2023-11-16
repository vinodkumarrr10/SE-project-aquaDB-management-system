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


$sql = "SELECT * FROM RentAnalytics";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Rent Details for Store: $selectedStore</h2>";
    echo "<table border='1'>
            <tr>
               
                <th>Popular Item</th>
                <th>Total Rent Amount</th>
                
              
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['popular_item'] . "</td>";
        echo "<td>" . $row['total_rented_amount'] . "</td>";
       
        echo "</tr>";
    }

    echo "</table>";
}



// Close the connection
$conn->close();
?>

</body>
</html>
