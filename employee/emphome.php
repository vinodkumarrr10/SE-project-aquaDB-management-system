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
            font-size: 40px;
            color: slateblue;
            font-weight: 400;
            font-family:cursive;
        }
        

        .btnlogin-popup{
            width: 350px;
            height: 50px;
            background: transparent;
            border: 2px solid black;
            outline: none;
            border-radius: 6px;
            cursor:pointer;
            font-size: 1.1em;
            color:black;
            font-weight: 500;
           
            transition: 0.5s;
            }

        .btnlogin-popup:hover{
          background: lightsteelblue;
          color:black;
        }
        #welcome{
            color:steelblue; 
            font: size 50px; 
            font-weight:500;
        }

        
    </style>
</head>



<body>
    
    <div class="container">
        <div class="data">
            <div class="top">
                <h1 style="font-size: 2em;font-weight: 100;">AquaDB</h1>
                <p class="header"  style="font-size: 3em;">Employee Dashboard</p>
                <a href="logout1.php"><button class="btnlogin-popup" style="width: 130px;">logout</button></a>
            </div><br><br>
            <center class="#">
              <nav class="navigation2">
              <b id="welcome" >Hola:) 
              <b style="color:Black"><h2><?php echo $login_session;?></h2></b></b>
              <b id="welcome"">Employee ID: <i style="color:Black"><?php echo $CustID; ?></i></b><br>
              
                <br>
                <a href="emphome.php"><button class="btnlogin-popup">Home</button></a><br><br>
                <a href="empprofile.php" ><button class="btnlogin-popup">Employee Profile</button></a> <!--employee details--><br><br>
                <a href="empprofileedit.php" ><button class="btnlogin-popup">Edit Profile</button></a><br><br>
                <a href="#" ><button class="btnlogin-popup">Payroll info</button></a><br><br>
                
               </nav>
            </center>
        </div>

      
        
    </div>
    
          
    

        


            

</body>

</html>