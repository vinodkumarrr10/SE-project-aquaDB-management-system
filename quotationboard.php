<?php
include('session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: inventoryhome.php"); // Redirecting To Home Page
}

// Create a database connection
$conn = mysqli_connect("localhost", "root", "", "aquadb");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch items from the Inventory_Items table
$sql = "SELECT item_id, item_model, description, price FROM Inventory_Items";
$result = $conn->query($sql);

// Initialize an array to store the items
$items = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = array(
            'id' => $row['item_id'],
            'model' => $row['item_model'],
            'price' => $row['price']
        );
    }
}


// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <script src="https://kit.fontawesome.com/e8fa2e31b4.js" crossorigin="anonymous"></script>
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
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
       
        .sidebar {
            width: 25%;
            border: 1px solid #eee;
            border-radius: 3px;
            padding: 15px;
            height: 92vh;
            box-shadow: 0px 0px 3px gray;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow:scroll;
        }
        .fa-circle {
            color: orangered;
        }
        .searchBar {
           
            width: 100%;
            background-color:whitesmoke;
            border: 3px solid steelblue;
            border-radius: 3px;
            padding: 3px;
            display: flex;
            align-items: center;
            border-radius: 30px;
            justify-content: space-between;
        }
        input {
            border: none;
            outline: none;
            background: none;
        }
        .glass:hover {
            color: steelblue;
            cursor: pointer;
        }
        .social-icons {
            display: flex;
            align-items: center;
            justify-content: center;
        }/*
        .fa-brands {
            font-size: 25px;
            margin: 0 10px;
            color: #333;
            cursor: pointer;
        }
        .fa-brands:hover {
            color: orangered;
        }*/
        
        .data {
            width: 73%;
            border-radius: 3px;
            height: 92vh;
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
            height: 0px;
            border-radius: 3px;
            background-color: transparent;
            margin: 3vh 0px;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .header p {
            font-size: 40px;
            font-weight: bold;
            color: white;
            
        }
        #searchResults {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }
        .box {
            margin: 1px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            border: 1px solid grey;
            border-radius: 5px;
            padding: 15px;
        }
        .img-box {
            width: 100%;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .description {
            max-height: 90%;
            max-width: 90%;
            object-fit: cover;
            object-position: center;
        }
        .add-to-cart{
            margin-top: 20px;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 40px;
        }
        h2 {
            font-size: 25px;
            font-weight: 100;
            color: black;
        }
        button {
            width: 100%;

            position: relative;
            border: 2px solid #F4C430;
            border-radius: 5px;
            background-color: #F4C430;
            padding: 7px 25px;
            cursor: pointer;
            color: black;
        }
        button:hover {
            background-color: transparent;
            border: 2px solid  #F4C430;
            color: black ;
        }
        ::-webkit-scrollbar {
            display: none;
        }
        .carthead{
            background-color: steelblue;
            border-radius: 3px;
            height: 40px;
            padding: 10px;
            margin-bottom: 20px;
            color: white;
            display: flex;
            align-items: center;
        }
        .foot{
            display: flex;
            justify-content: space-between;
            margin: 20px 0px;
            padding: 10px 0px;
            border-top: 1px solid black;
        }

        #cart-item-name{
            display:flexbox;
            
            
            justify-content: flex-start;
        }
        #x
        {
            display:flex;
            justify-content:space-between;
            
        }
        .cart-item{
            display:flex;
            justify-content:flex-end;
            align-items: center;
            padding-bottom: 10px;
            background-color: transparent;
            border-bottom: 1px solid transparent;
            border-radius: 3px;
            
        }
        .remove-from-cart{
            cursor: pointer;
            color: red;
            font-size: 15px;
            font-weight: 100;
            
            

        }
        
        .remove-from-cart:hover{
            cursor: pointer;
            color: black;
            font-size: 15px;
            font-weight: 100;
            

        }

        .btnlogin-popup{
            width: 130px;
            height: 50px;
            background: transparent;
            border: 2px solid black;
            outline: none;
            border-radius: 6px;
            cursor:pointer;
            font-size: 1.1em;
            color:black;
            font-weight: 500;
            margin-left: 0px;
            transition: 0.5s;
            }

        .btnlogin-popup:hover{
          background: lightsteelblue;
          color:black;
          border: 2px solid black;
        }

        .popup-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        #close-popup {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }




    </style>
    <style>
        /* for customer form*/
        
        .form-group {
            margin-bottom: 20px;
            
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        
    </style>
</head>



<body>
    <div class="container">


        <div class="data">
            <div class="top">
                <h1 style="font-size: 2em;font-weight: 100;">AquaDB</h1>
                <p   style="font-size: 3em;color: lightslategrey;">Quotation</p>
                <a href="inventoryhome.php"><button class="btnlogin-popup">Home</button></a>
            </div>
            <div class="popup-form" id="popup-form" >
                    <div class="form-container">
                        <h2>Enter Customer Details</h2><br>
                        <form id="customerForm" action="customerconnect.php" method="post">
                            <div class="form-group">
                                <label for="customer_name" >Customer Name</label>
                                <input type="text" id="customer_name" name="customer_name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="customer_email" name="customer_email" placeholder="optional" style="font-style: italic; font-weight: 100; ">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" id="customer_phone" name="customer_phone" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="customer_address" name="customer_address" rows="4" required></textarea>
                            </div>
                            <p style="color:steelblue; font-weight: 100; font: size 50px;" >SELECT PAYMENT MODE</p><br>
                            <label>
                                <input type="radio" name="option" value="card" style="font-size: 2em;" required>
                                    Card 
                                </label>
                            
                                <label>
                                    <input type="radio" name="option" value="upi">
                                    UPI
                                </label>
                            
                                <label>
                                    <input type="radio" name="option" value="cod">
                                    COD
                            </label>
                            <button type="submit" onclick="reload">place</button>
                        </form>
                        
                        
                        <button id="close-popup">Close</button>
                        
                    </div>
                </div>
        
                    
            <div class="header">
                <p></p>
            </div>
            <div class="body">
                <div id="searchResults"></div>
                
            </div>
        </div>
        
        <div class="sidebar">
            <div class="sidehead">
                
               
            
            <div class="sidebody" style="height: 69vh;">
                <div class="searchBar">
                <input type="text" id="searchInput" placeholder="Search..." style=" border: none;outline: none;background: none;">
                <i class="fa-solid fa-magnifying-glass glass" id="searchButton"></i>
                </div>
                <div class="#">
                    <br>
                    <!--div class="carthead">items-added</div>
                    <div id="cart">Empty Cart</div>
                    <div class="foot">
                        <h3>Total</h3>
                         <h2 id="total">₹ 0.00</h2>
                     </div-->
                    <div class="carthead">Order Summary</div>
                     
                        <ol id="cartList" name="cartList" action="inbuffer.php" method="post"></ol>
                    <div class="foot">
                        <p>Total: ₹ &nbsp;<span id="totalPrice">0.00</span></p>
                    </div>
                </div>
                
            </div>
            <div class="sidefoot"><br><br><br><br>
                <hr style="margin: 15px 0; border: 1px solid #eee">
                <div class="social-icons">
                
                    <section id="product-form">
                         <button class="add-btn">Checkout</h2></button>
                        
                    </section> 
                </div>
                
            </div>

        </div>
    </div>
    

    <script>
        document.addEventListener("DOMContentLoaded", () => {
        const items = <?php echo json_encode($items); ?>;
        const cart = [];
        const searchInput = document.getElementById("searchInput");
        const searchButton = document.getElementById("searchButton");
        const searchResults = document.getElementById("searchResults");
        const cartList = document.getElementById("cartList");
        const totalPrice = document.getElementById("totalPrice");
        const checkoutButton = document.querySelector(".add-btn");
        const popupForm = document.getElementById("popup-form");
        const closePopupButton = document.getElementById("close-popup");

        checkoutButton.addEventListener("click", () => {
            if (cart.length === 0) {
                alert("Your cart is empty.");
            } else {
                showPopupForm();
            }
        });

        searchButton.addEventListener("click", renderResults);
        searchInput.addEventListener("input", renderResults);

        document.addEventListener("click", (e) => {
            if (e.target.classList.contains("add-to-cart")) {
                addToCart(
                    parseInt(e.target.getAttribute("data-id")),
                    e.target.getAttribute("data-model"),
                    parseFloat(e.target.getAttribute("data-price"))
                );
            } else if (e.target.classList.contains("remove-from-cart")) {
                removeFromCart(parseInt(e.target.getAttribute("data-id")));
            }
        });

        function renderResults() {
            searchResults.innerHTML = "";
            const searchQuery = searchInput.value.toLowerCase();
            const results = items.filter(item => item.model.toLowerCase().includes(searchQuery));

            if (results.length === 0) {
                searchResults.innerHTML = "<h2>Item Not Found :(</h2>";
            } else {
                results.forEach(item => {
                    const resultElement = document.createElement("div");
                    resultElement.innerHTML = `
                        <div class='box'>
                            <div class='img-box'>
                                <p class='description'>${item.model}</p>
                            </div>
                            <div class='bottom'>
                                <h2>₹${item.price}</h2>
                            </div> 
                            <button class="add-to-cart" data-id="${item.id}" data-model="${item.model}" data-price="${item.price}">Add</button>
                        </div>
                    `;
                    searchResults.appendChild(resultElement);
                });
            }
        }

        function addToCart(itemId, itemModel, itemPrice) {
            const itemIndex = cart.findIndex(item => item.id === itemId);
            if (itemIndex !== -1) {
                cart[itemIndex].quantity++;
            } else {
                const newItem = {
                    id: itemId,
                    model: itemModel,
                    price: itemPrice,
                    quantity: 1,
                };
                cart.push(newItem);
            }
            updateCartDisplay();
        }

        function removeFromCart(itemId) {
            const itemIndex = cart.findIndex(item => item.id === itemId);
            if (itemIndex !== -1) {
                cart.splice(itemIndex, 1);
                updateCartDisplay();
            }
        }

        function updateCartDisplay() {
            cartList.innerHTML = "";
            let total = 0;

            // Initialize variables to store the data
            let itemModel = "";
            let quantity = 0;
            let price = 0;

            cart.forEach(item => {
                const cartItem = document.createElement("li");
                cartItem.innerHTML = `
                    <div id="x">
                        <p style='font-size:1em;' id='cart-item-name'>${item.model}</p>
                        <div class='cart-item'>
                            <h2 style='font-size:15px;'> ₹${item.price} x ${item.quantity}&nbsp</h2>
                            <a href="#" class="remove-from-cart" data-id="${item.id}">Delete</a>
                        </div>
                    </div>
                `;

                cartList.appendChild(cartItem);

                // Extract information from the item and log it
                const jsonString = `${item.model} ₹${item.price} x ${item.quantity}`;
                const parts = jsonString.split(' ');
                itemModel = parts.slice(0, 2).join(' ');
                price = parseFloat(parts[2].replace('₹', ''));
                quantity = parseInt(parts[4]);
                                

                // Log the extracted information
                console.log('Item Model:', itemModel);
                console.log('Price:', price * quantity);
                console.log('Quantity:', quantity);

                total += item.price * item.quantity;
            });

            totalPrice.textContent = total.toFixed(2);
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "inbuffer.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Send the data as part of the request
            const data = new URLSearchParams({
                itemModel: itemModel,
                quantity: quantity,
                price: price * quantity
            }).toString();
            xhr.send(data);
        }

        function showPopupForm() {
            popupForm.style.display = "flex";
        }

        closePopupButton.addEventListener("click", () => {
            popupForm.style.display = "none";
        });
    });

    </script>
    
</body>

</html>


