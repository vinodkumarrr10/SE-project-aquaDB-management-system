<?php
include('session.php');
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
            margin-left: 40px;
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
                <p class="header"  style="font-size: 3em;">&nbsp;&nbsp;&nbsp;&nbsp;Inventory Dashboard</p>
                <a href="logout.php"><button class="btnlogin-popup" style="width: 130px;">Logout</button></a>
            </div><br><br><br><br>
            <center class="#">
              <nav>
                <a href="inventoryhome.php"><button class="btnlogin-popup">Home</button></a><br><br>
                <a href="quotationboard.php" ><button class="btnlogin-popup">Quotation</button></a> <!--billing--><br><br>
                <a href="orderboard.php"><button class="btnlogin-popup">Order</button></a> <!--preorder--><br><br>
                <a href="extendrent/index.php"><button class="btnlogin-popup">Rent</button></a>    <!--rent--><br><br>
              </nav>
            </center>
        </div>

      
        
    </div>
    
          
    

        


            

</body>

</html>