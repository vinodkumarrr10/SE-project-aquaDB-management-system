

<style>
    /* Basic styling for the employee management */
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
    padding: 7px;
    text-align: left;
}

form {
    display: flex;
    flex-direction: column;
    max-width: 500px;
    margin: 0 auto;
}

label {
    margin-bottom: 5px;
}

input[type="text"], input[type="number"] {
    padding: 5px;
    margin-bottom: 1px;
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
                <p class="header"  style="font-size: 3em;">Employee Management</p>
                <a href="adminhome.php"><button class="btnlogin-popup" style="width: 130px;margin-top: 40px;">Home</button></a>
            </div><br>
            <center class="#">
              <nav>
                <main>
                <div class="popup-form" id="popup-form">
                    <div class="form-container">
                        <h2>Enter Details</h2>
                        <form id="add-employee-form" style="width: 150%;" action="connect.php" method="post">
                            <label for="employee_id" style="text-align: left;">ID:<input type="number" id="employee_id" name="employee_id" required></label>
                            
                            <label for="employee_password" style="text-align: left;">pwd:<input type="number" id="employee_password" name="employee_password" required>
                            </label>
                            
                            <label for="employee_name" style="text-align: left;">Name: <input type="text" id="employee_name" name="employee_name" required></label>
                           
                            <label for="employee_email" style="text-align: left;">mail-ID:<input type="text" id="employee_email" name="employee_email" required></label>
                            
                            <label for="employee_phone" style="text-align: left;">mobile:<input type="number" id="employee_phone" name="employee_phone" required></label>
                            

                            <label for="job_title" style="text-align: left;">Designation: <input type="text" id="job_title" name="job_title" required></label>
                           
                            <label for="hire_date" style="text-align: left;">Hire-date:<input type="text" id="hire_date" name="hire_date" required></label>
                            
                            <label for="salary" style="text-align: left;">Payroll: <input type="number" id="salary" name="salary" required></label>
                           

                            <label for="store_id" style="text-align: left;">store ID: <input type="number" id="store_id" name="store_id" required></label>
                           

                            <label for="admin_id" style="text-align: left;">Admin ID:<input  type="number" id="admin_id" name="admin_id" required></label>
                            
                            <!--label for="advances">Advances Taken:</label>
                            <input type="number" id="advances" name="advances" required-->
                            <button type="submit">Add </button>
                        </form>
                        <button id="close-popup">Close</button>
                    </div>
                </div>
        
                    <section id="employee-form">
                        <button class="add-btn">Add Employee</h2></button>
                        
                    </section>
                    <section id="employee-list">
                        <h2>Employee List</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PWD</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Designation</th>
                                    <th>hire_date</th>
                                    <th>Payroll</th>
                                    <th>store_id</th>
                                    <th>admin_id</th>
                                    <!--th>Advances</th-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Employee list goes here -->
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
        const employeeList = document.querySelector("#employee-list tbody");
        const addEmployeeForm = document.querySelector("#add-employee-form");

        // Function to display employees
        function displayEmployees() {
            // Make an AJAX request to fetch employee data from PHP script
            fetch("getEmployees.php")
                .then(response => response.json())
                .then(data => {
                    // Clear the existing table data
                    employeeList.innerHTML = "";

                    // Iterate through the fetched data and populate the table
                    data.forEach(employee => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${employee.employee_id}</td>
                            <td>${employee.employee_password}</td>
                            <td>${employee.employee_name}</td>
                            <td>${employee.employee_email}</td>
                            <td>${employee.employee_phone}</td>
                            <td>${employee.job_title}</td>
                            <td>${employee.hire_date}</td>
                            <td>${employee.salary}</td>
                            <td>${employee.store_id}</td>
                            <td>${employee.admin_id}</td>
                            <td><button class="advance-button" data-id="${employee.id}">Advance</button>
                            <button class="delete-button" data-id="${employee.id}">Delete</button></td>
                        `;
                        employeeList.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                });
        }

        // Call the displayEmployees function to populate the table when the page loads
        displayEmployees();

    

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

            // Event listener for the "Add Employee" button
            const addEmployeeButton = document.querySelector(".add-btn");
            addEmployeeButton.addEventListener("click", showPopupForm);

            // Event listener for the "Close" button in the popup form
            const closePopupButton = document.getElementById("close-popup");
            closePopupButton.addEventListener("click", closePopupForm);

            // ... (your existing code)
        })

    </script>
</body>