<?php
include('session1.php');
if(!isset($_SESSION['login_user'])){
header("location: index.php");} // Redirecting To Home Page
$query4 = "SELECT * from Employees where employee_id='$user_check'";
              $ses_sq4 = mysqli_query($conn, $query4);
              $row4 = mysqli_fetch_assoc($ses_sq4);
              $para1 = $row4['employee_id'];
              $para2 = $row4['employee_name'];
              $para3 = $row4['job_title'];
              $para4 = $row4['employee_password'];
              if(isset($_POST['submitpa']))
  {$updtname = ($_POST['inputpa']);
    $updatequery1 = "UPDATE Employees set employee_name='$updtname' where employee_id='$para1'";mysqli_query($conn, $updatequery1);
    header("Refresh:0");}

    if(isset($_POST['submitn']))
  {$updtname = ($_POST['inputn']);
    $updatequery1 = "UPDATE Employees set employee_name='$updtname' where employee_id='$para1'";mysqli_query($conn, $updatequery1);
    header("Refresh:0");}
    /*
    if(isset($_POST['submitpt']))
  {$updtname = ($_POST['inputpt']);
    $updatequery1 = "UPDATE Employees set job_title='$updtname' where employee_id='$para1'";mysqli_query($conn, $updatequery1);
    header("Refresh:0");}
    */
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
            color: steelblue;
            padding-bottom: 15px;
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
           
            transition: 0.5s;
            }

        .btnlogin-popup:hover{
          background: lightsteelblue;
          color:black;
        }

        .table{
          
          position: relative;
          width: 450px;
          height:300px;
          background: transparent;
          border:2px solid black;
          border-radius: 40px;
          backdrop-filter: blur(200px);
          box-shadow: 0 0 30px rgba(0, 0, 0, .5);
          display: flex;
          align-items: center;
          padding-left: 30px;
         
          overflow: hidden;
        }
 
        .row{
          border: 2px solid grey;
          border-radius: 1.5px;
        }
    

        
    </style>
</head>



<body>
    
    <div class="container">
        <div class="data">
            <div class="top">
                <h1 style="font-size: 2em;font-weight: 100;">AquaDB</h1>
                <p class="header"  style="font-size: 3em;">Employee Dashboard</p>
                <a href="emphome.php"><button class="btnlogin-popup">Back</button></a>
            </div><br><br><br><br>
            <center class="" style="padding-left: 0px;">
              <nav class="table">
                <form method="POST"; action="">
                <h2>EDIT-PROFILE</h2>
                <table style="width:70%">
                <tr >
                <td>PEID:</td><td class="row"><?php echo "$para1"?></td>
                <td style="font-size:14px;">Not Allowed</td>
                </tr>
                <tr>
                <td>Designation:</td>
                <td class="row"><input type="text" name="inputpt" placeholder="<?php echo "$para3"?>"></td>
                <td style="font-size:14px;">Not Allowed</td>
                </tr>
                <tr >
                <td>Name:</td>
                <td class="row"><input type="text" name="inputn" placeholder="<?php echo "$para2"?>"></td>
                <td><input type="submit" name="submitn"></td>
                </tr>
                
                
                <tr>
                <td>Password:</td>
                <td class="row"><input type="text" name="inputpa" placeholder="*******"</td>
                <td><input type="submit" name="submitpa"></td>
                </tr>
                
                </table>
                </form></div>
                
                
                
            </nav>
          </center>
                
        
        

        </div>

      
        
    </div>
    
          
    

        


            

</body>

</html>