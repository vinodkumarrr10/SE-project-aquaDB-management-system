<?php
$item_model = $_POST['item_model'];
$description = $_POST['description'];
$price = $_POST['price'];
$rent_price = $_POST['rent_price'];
$quantity_in_stock = $_POST['quantity_in_stock'];
$store_id = $_POST['store_id'];

// DB connection
$conn = new mysqli('localhost', 'root', '', 'aquadb');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO Inventory_Items (item_model, description, price, rent_price, quantity_in_stock, store_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $item_model, $description, $price, $rent_price, $quantity_in_stock, $store_id);

if ($stmt->execute()) {
    // Insertion was successful, trigger JavaScript for alert and redirection
    echo '<script language="javascript">';
    echo 'alert("PRODUCT ADDITION SUCCESSFUL");';
    echo 'window.history.back();';  // Go back to the previous page
    echo '</script>';
} else {
    // Insertion failed, display an error alert
    echo '<script language="javascript">';
    echo 'alert("PRODUCT ADDITION FAILED");';
    echo 'window.history.back();';  // Go back to the previous page
    echo '</script>';
}

$stmt->close();
$conn->close();
?>
