<?php
// Assuming you have a database connection established in your PHP script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $itemModel = $_POST['itemModel'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Perform database insertion or update
    // Replace the following code with your database connection and logic
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "aquadb";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the item_model already exists
    $check_sql = "SELECT * FROM inbuffer WHERE item_model = '$itemModel'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        // If the item_model exists, update quantity and price
        $update_sql = "UPDATE inbuffer SET quantity =  $quantity, price = $price WHERE item_model = '$itemModel'";
        if ($conn->query($update_sql) === FALSE) {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // If the item_model doesn't exist, insert a new row
        $insert_sql = "INSERT INTO inbuffer (item_model, quantity, price) VALUES ('$itemModel', $quantity, $price)";
        if ($conn->query($insert_sql) === FALSE) {
            echo "Error inserting record: " . $conn->error;
        }
    }

    $conn->close();
}
?>
