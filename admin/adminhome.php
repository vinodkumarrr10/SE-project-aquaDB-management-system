<?php
include('session1.php');
if(!isset($_SESSION['login_user'])){
header("location: index.php"); // Redirecting To Home Page
}
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


    

    

    </style>
</head>



<body>
    
    <div class="container">
        <div class="data">
            <div class="top">
                <h1 style="font-size: 2em;font-weight: 100;">AquaDB</h1>
                <p class="header"  style="font-size: 3em;">Manager Dashboard</p>
                <a href="logout1.php"><button class="btnlogin-popup" style="width: 130px;margin-top: 40px;">Logout</button></a>
            </div><br><br><br>
            <center class="#">
              <nav>
                <a href="adminhome.php"><button class="btnlogin-popup">Home</button></a><br>
                <a href="inventoryman.php" ><button class="btnlogin-popup">Inventory Management</button></a><br> <!--billing-->
                <a href="emp_manage.php"><button class="btnlogin-popup">Employee Management</button></a><br> <!--preorder-->
                <a href="storeman.php"><button class="btnlogin-popup">Store Management</button></a><br>    <!--rent-->
              </nav>
            </center>
        </div>

      
        
    </div>
    
          
    

        


            

</body>

</html>