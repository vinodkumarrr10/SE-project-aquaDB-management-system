
<html>
<style>
    /* Basic styling for the product management */
body {
    font-family: Arial, sans-serif;
}



main {
    padding: 20px;
}

section {
    margin-bottom: 20px;
}

table {
    border-collapse: collapse;
    width: 100%;
}

table, th, td {
    border: 1px solid black;
}

th, td {
    padding: 10px;
    text-align: left;
}

form {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    margin: 0 auto;
}

label {
    margin-bottom: 5px;
}

input[type="text"], input[type="number"] {
    padding: 5px;
    margin-bottom: 10px;
}

button {
    padding: 10px;
    background-color: steelblue;
    color: white;
    border: none;
    border-radius: 40px;
    cursor: pointer;
}
</style>
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
            font-size: 30px;
            color: steelblue;
            border: 1px solid black;
            margin-bottom: 5px;
            padding: 15px;
        }
        

        .btnlogin-popup{
            width: 300px;
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
          background: lightsteelblue;
          color:#162938;
        }

        .add-btn{
            width: 300px;
            border-radius: 50px;
            background-color: steelblue;
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
<body>
    
    <div class="container">

        <div class="data">
            <div class="top">
                <h1 style="font-size: 2em;font-weight: 100;">AquaDB</h1>
                <p class="header"  style="font-size: 3em;">Inventory Management</p>
                <a href="adminhome.php"><button class="btnlogin-popup" style="width: 130px;margin-top: 40px;">Home</button></a>
            </div><br>
            <center class="#">
              <nav>
                <main>
                <div class="popup-form" id="popup-form">
                    <div class="form-container">
                        <h2>Enter Details</h2>
                        <form id="add-product-form" style="width: 150%;" action="iiconnect.php" method="post">
                    
                        <label for="item_model">ITEM MODEL</label><br>
                        <input type="text" id="item_model" name="item_model" style="border:2px solid lightsteelblue " required>
                        <label for="description">ITEM DESCRIPTION</label><br>
                        <textarea id="description" name="description" rows="1" style="border:2px solid lightsteelblue" ></textarea>
                        <label for="price">ITEM PRICE</label><br>
                        <input type="number" id="price" name="price" style="border:2px solid lightsteelblue" required>
                        <label for="rent_price">RENT PRICE (if 0 not eligible)</label><br>
                        <input type="number" id="rent_price  " name="rent_price" style="border:2px solid lightsteelblue" default="0" required>
                        <label for="quantity_in_stock">QTY</label><br>
                        <input type="number" id="quantity_in_stock" name="quantity_in_stock" style="border:2px solid lightsteelblue" required>
                        <label for="store_id">STORE ID</label><br>
                        <input type="number" id="store_id" name="store_id" style="border:2px solid lightsteelblue" required>
                            <!--label for="advances">Advances Taken:</label>
                            <input type="number" id="advances" name="advances" required-->
                        <button type="submit" onclick="reload">Add </button>
                        </form>
                        <button id="close-popup">Close</button>
                    </div>
                </div>
        
                    <section id="product-form">
                        <button class="add-btn">Add New Product</h2></button>
                        
                    </section>
                    <section id="product-list">
                        <h2>Product List</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Model</th>
                                    <th>description</th>
                                    <th>Price</th>
                                    <th>Rent Price</th>
                                    <th>store_id</th>
                                    
                                    <!--th>Advances</th-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- product list goes here -->
                            </tbody>
                        </table>
                    </section>
                    
                </main>
                
              </nav>
            </center>
        </div>

      
        
    </div>
    


    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const productList = document.querySelector("#product-list tbody");
        const addproductForm = document.querySelector("#add-product-form");

        // Function to display products
        function displayproducts() {
            // Make an AJAX request to fetch products data from PHP script
            fetch("getProducts.php")
                .then(response => response.json())
                .then(data => {
                    // Clear the existing table data
                    productList.innerHTML = "";

                    // Iterate through the fetched data and populate the table
                    data.forEach(product => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${product.item_id}</td>
                            <td>${product.item_model}</td>
                            <td>${product.description}</td>
                            <td>${product.price}</td>
                            <td>${product.rent_price}</td>
                            <td>${product.store_id}</td>
                    
                            <td><button class="advance-button" data-id="${product.id}">edit stock</button>
                            <button class="delete-button" data-id="${product.id}">Delete</button></td>
                        `;
                        productList.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                });
        }

        // Call the displayproducts function to populate the table when the page loads
        displayproducts();

    

    });


        document.addEventListener("DOMContentLoaded", function () {
            // ... (your existing code)

            // Function to show the popup form
            function showPopupForm() {
                const popupForm = document.getElementById("popup-form");
                popupForm.style.display = "flex";
            }

            // Function to close the popup form
            function closePopupForm() {
                const popupForm = document.getElementById("popup-form");
                popupForm.style.display = "none";
            }

            // Event listener for the "Add product" button
            const addproductButton = document.querySelector(".add-btn");
            addproductButton.addEventListener("click", showPopupForm);

            // Event listener for the "Close" button in the popup form
            const closePopupButton = document.getElementById("close-popup");
            closePopupButton.addEventListener("click", closePopupForm);

            // ... (your existing code)
        })

    </script>
</body>
</html>