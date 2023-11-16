<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_phone = $_POST['customer_phone'];
    $customer_address = $_POST['customer_address'];

    // DB connection
    $conn = new mysqli('localhost', 'root', '', 'aquadb');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO Customers (customer_name, customer_email, customer_phone, customer_address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $customer_name, $customer_email, $customer_phone, $customer_address);
        if ($stmt->execute()) {
            // The insertion was successful
            echo '<script>alert("Customer added successfully!");</script>';
            // You can add more HTML here for further interaction.
        } else {
            // An error occurred during the insertion; display an error message.
            echo '<script>alert("Error: ' . $stmt->error . '");</script>';
        }
        $stmt->close();
        $conn->close();
    }
}




include('session.php');

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    header("location: inventoryhome.php");
    exit();
}

// Create a database connection
$conn = new mysqli("localhost", "root", "", "aquadb");

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch items from the inbuffer table
$sql = "SELECT item_model, quantity, price FROM inbuffer";
$result = $conn->query($sql);

// Initialize an array to store the items
$items = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            'model' => $row['item_model'],
            'quantity' => $row['quantity'],
            'price' => $row['price']
        ];
    }
}

// Calculate the total price
$totalPrice = 0;
foreach ($items as $item) {
    $totalPrice +=  $item['price'];
}

// Insert data into the Quotations table
$quotationDate = date("Y-m-d"); // Get the current date

// Get the customer ID of the recently added customer
$customerQuery = "SELECT customer_id FROM Customers ORDER BY customer_id DESC LIMIT 1";
$customerResult = $conn->query($customerQuery);
if ($customerResult->num_rows > 0) {
    $customerRow = $customerResult->fetch_assoc();
    $customerId = $customerRow['customer_id'];
} else {
    echo "Error: No customer found.";
    exit();
}

$storeId = 1002; // Replace with the actual store ID

// Prepare the JSON representation of the items
$jsonItems = json_encode($items);


// Prepare the SQL statement with placeholders to prevent SQL injection
$sql2 = "INSERT INTO Rents2 (customer_id, items, total_amount, store_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("isdi", $customerId, $jsonItems, $totalPrice, $storeId);

if ($stmt->execute()) {
    // Insert successful, now delete from inbuffer
    $sql3 = "DELETE FROM inbuffer";
    $stmt3 = $conn->prepare($sql3);
    
    if ($stmt3->execute()) {
        echo "Invoice generated successfully!";
    } else {
        echo "Failed to clear inbuffer: " . $stmt3->error;
    }

    // Commit the changes
    $conn->commit();
} else {
    echo "Failed to generate quotation: " . $stmt->error;
}
$rentInfoQuery = "SELECT rent_date, end_date FROM Rents2 WHERE customer_id = $customerId ORDER BY rent_id DESC LIMIT 1";
$rentInfoResult = $conn->query($rentInfoQuery);

if ($rentInfoResult->num_rows > 0) {
    $rentInfoRow = $rentInfoResult->fetch_assoc();
    $rentDate = $rentInfoRow['rent_date'];
    $endDate = $rentInfoRow['end_date'];
} else {
    echo "Error: No rent information found.";
    exit();
}

// Prepare the bill-like string
// Start an HTML table
$bill = "<table border='1'>";
$bill .= "<tr><th colspan='4'>RENTAL INVOICE</th></tr>";
$bill .= "<tr><td >Customer ID:</td><td colspan='3'>$customerId</td></tr>";
$bill .= "<tr><td>Store ID:</td><td colspan='3'>$storeId</td></tr>";
$bill .= "<tr><td>Rent Date:</td><td colspan='3'>$rentDate</td></tr>";
$bill .= "<tr><td>End Date:</td><td colspan='3'>$endDate</td></tr>";
$bill .= "<tr><th colspan='4'>Order Summary</th></tr>";


// Create column headers
$bill .= "<tr><th>Sl No</th><th>Model</th><th>Quantity</th><th>Price</th></tr>";

// Initialize the serial number
$serialNumber = 1;

// Iterate through items
foreach ($items as $item) {
    $model = $item['model'];
    $quantity = $item['quantity'];
    $price = $item['price'];

    // Create a new row for each item
    $bill .= "<tr><td>$serialNumber</td><td>$model</td><td>$quantity</td><td>$price</td></tr>";

    // Increment the serial number
    $serialNumber++;
}

$bill .= "<tr><th>Total Price:</th><td colspan='3' style='text-align: center; color: green;'>₹ $totalPrice</td></tr>";

$bill .= "</table>";

// Print the HTML table
echo $bill;

// Add a "Print" button
echo '<button id="printButton" >Print Quotation</button>';
echo '<a href="inventoryhome.php"><button id="#">HOME</button></a><br>';

// JavaScript to handle the print functionality
echo '<script>
    document.getElementById("printButton").addEventListener("click", function () {
        var printWindow = window.open("", "", "width=600,height=600");
        printWindow.document.open();
        printWindow.document.write(\'<html><head><title>Print Quotation</title></head><body>\');
        printWindow.document.write(\'' . str_replace("'", "\\'", $bill) . '\');
        printWindow.document.write(\'</body></html>\');
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    });
</script>';

// ...



// Close the database connection
$stmt->close();
$stmt3->close();
$conn->close();

?>
