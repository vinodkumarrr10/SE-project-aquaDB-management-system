<?php
include('session1.php');

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    header("location: index.php"); // Redirect to the login page
    exit(); // Stop further execution of the script
}

// Rest of your existing code...

if (isset($_POST['store'])) {
    $selectedStore = $_POST['store'];

    $conn = mysqli_connect("localhost", "root", "", "aquadb");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Stores WHERE store_id = '$selectedStore'";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storeName = $row['store_name'];
        $branch = $row['branch'];
        // You can fetch more data as needed

        // Display notifications
       
        // Close the database connection
        $conn->close();
    } else {
        $storeName = "Store not found";
        $branch = "Branch not found";
    }
} else {
    $storeName = "Select a store";
    $branch = "";
}


?>
<!DOCTYPE html>
<html>

<head>
    
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
            background: url('marble.jpg') no-repeat;
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
  
        .data {
            font-size: 40px;
            width: 100%;
            border-radius: 3px;
            height: 100vh;
            overflow-y: auto;
            background-color: transparent;
        }
        .top {
            height: 60px;
            border-radius: 3px;
            
           
            background-color: transparent;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
        }
        .header {
            height: 75px;
            background-color:transparent;
            color: lightslategrey;
            margin: 3vh 0px;
            padding: 0px;
            display: flex;
            align-items: center;
            justify-content: center;
           
        }
        .header p {
            font-size: 40px;
            font-weight: bold;
            color: white;

        }
        
      
        
        h2 {
            font-size: 20px;
            color: orangered;
        }
        

        .btnlogin-popup{
            width: 220px;
            height: 50px;
            background: transparent;
            border: 2px solid black;
            outline: none;
            border-radius: 6px;
            cursor:pointer;
            font-size: 1.1em;
            color:black;
            font-weight: 500;
            margin-bottom: 40px;
            transition: 0.5s;
            }

        .btnlogin-popup:hover{
          width: 450px;
          background: lightsteelblue;
          color:#162938;
        }
        .btnlogin-popup2{
            width: 300px;
            height: 50px;
            background: lightsteelblue;
            border: 2px solid black;
            outline: none;
            border-radius: 6px;
            cursor:pointer;
            font-size: 1.1em;
            color:black;
            font-weight: 500;
            margin-bottom: 5px;
          
            transition: 0.5s;
            }

        .btnlogin-popup2:hover{
          background: transparent;
          color:#162938;
        }

        .closebtn{
            width:75%; color:black ;
            background:lightsteelblue; 
            border:none

        }
        .closebtn:hover{
            width: 75%; color:white ;
            background:slategrey; 
            border:none

        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .popup-content {
            background-color: whitesmoke;
            width: 75%;
           
            margin-top: 0vh auto;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

    

    

    </style>
</head>

<body>
    <div class="container">
        <div class="data">
            <div class="top">
                <h1 style="font-size: 2em; font-weight: 100;">AquaDB</h1>
                <p class="header" style="font-size: 3em;">Store Management</p>
                <a href="storeman.php"><button class="btnlogin-popup" style="width: 130px; margin-top: 40px;">Back</button></a>
                
            </div>
            <br><br>
            <center>
            <nav>
                    <label for="storeSelect" style="font-size: 1.5em; font-weight: 100; color: steelblue">SELECTED STORE</label><br><br>
                    <p>STORE NAME: <?php echo $storeName; ?></p>
                    <p>BRANCH: <?php echo $branch; ?></p><br>

                    <button class="btnlogin-popup" onclick="toggleButtons()">Get Inventory Report</button>
                    <!-- Hidden buttons -->
                    <div id="reportButtons" style="display: none;">
                        <button class="btnlogin-popup2" onclick="openReport('report1')">Quotations Report</button><br>
                        <button class="btnlogin-popup2" onclick="openReport('report2')">Orders Report</button><br>
                        <button class="btnlogin-popup2" onclick="openReport('report3')">Rent Report</button><br>
                    </div>
                    <div class="popup" id="popup">
                        <div class="popup-content" id="orderPopup">
                            <!-- Data fetched from the database will be displayed here -->
                        </div>
                        <button class="closebtn" onclick="closePopup()">close</button>
                    </div>
                    <div class="popup" id="popup2">
                        <div class="popup-content" id="quotationPopup">
                            <!-- Data fetched from the database will be displayed here -->
                        </div>
                        <button class="closebtn" onclick="closePopup()">close</button>
                    </div>
                    <div class="popup" id="popup3">
                        <div class="popup-content" id="rentPopup">
                            <!-- Data fetched from the database will be displayed here -->
                        </div>
                        <button class="closebtn" onclick="closePopup()">close</button>
                    </div>
                </nav>
            </center>
        </div>
    </div>

    <script>
        function toggleButtons() {
            var reportButtons = document.getElementById('reportButtons');
            reportButtons.style.display = 'block';
        }

        function openReport(reportType) {
            if (reportType === 'report1') {
                // Fetch and display quotation data
                fetchQuotationData('<?php echo $selectedStore; ?>');
                var popup2 = document.getElementById('popup2');
                popup2.style.display = 'block';
            } else if (reportType === 'report2') {
                // Fetch and display order data
                fetchOrderData('<?php echo $selectedStore; ?>');
                var popup = document.getElementById('popup');
                popup.style.display = 'block';
            }
            else if (reportType === 'report3') {
                // Fetch and display order data
                fetchRentData('<?php echo $selectedStore; ?>');
                var popup = document.getElementById('popup3');
                popup.style.display = 'block';
            }
        }

        function fetchOrderData(selectedStore) {
            // AJAX request to get order data
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getorderdata.php?store=' + selectedStore, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var orderPopup = document.getElementById('orderPopup');
                    orderPopup.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function fetchQuotationData(selectedStore) {
            // AJAX request to get quotation data
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getquotationdata.php?store=' + selectedStore, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var quotationPopup = document.getElementById('quotationPopup');
                    quotationPopup.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        function fetchRentData(selectedStore) {
            // AJAX request to get quotation data
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getrentdata.php?store=' + selectedStore, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var rentPopup = document.getElementById('rentPopup');
                    rentPopup.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }


        function closePopup() {
            var popup = document.getElementById('popup');
            var popup2 = document.getElementById('popup2');
            var popup3 = document.getElementById('popup3');
            popup.style.display = 'none';
            popup2.style.display = 'none';
            popup3.style.display = 'none';
        }
    </script>
  

</body>

</html>

