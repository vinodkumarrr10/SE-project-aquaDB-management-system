<?php
include('login1.php'); // Includes Login Script
if(isset($_SESSION['login_user']))
{
header("location: adminhome.php"); // Redirecting To Profile Page
}
?> 

<!DOCTYPE html>
<title>login page</title>

<style>
      *{
          margin :0;
          padding:0;
          box-sizing:border-box;
          font-family:'poppins',sans-serif;
        }

        body{
          display : flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
          background: url('marble.jpg') no-repeat;
          background-size: cover;
          background-position: center;
          
          
        }

        header{
          position: fixed;
          top:0;
          left:0;
          width:100%;
          padding:20px 100px;
          
          display: flex;
          justify-content: space-between;
          align-items: center;
          z-index: 99;
        }

        .logo{
          font-size:2.2em;
          color: black;
          font-weight: 100;
          user-select:none;
        }

        .navigation a{
          position: relative;
          font-size: 1.1em;
          color: black;
          text-decoration: none;
          font-weight: 500;
          margin-left: 40px;
        }

        .navigation a::after{
          content: ' ';
          position:absolute;
          left:0;
          bottom: -6px;
          width: 55px;
          height: 3px;
          background: black;
          border-radius: 2px;
          transform :scaleX(0);
        /*\transition: transform .5s;*/
        transition: transform 0.5s;


      }

      .navigation a::hover::after{
        transform-origin: left;
        transform :scaleX(1);


      }

      .navigation .btnlogin-popup{
        width: 130px;
        height: 50px;
        background: black;
        border: 2px solid black;
        outline: none;
        border-radius: 6px;
        cursor:pointer;
        font-size: 1.1em;
        color:whitesmoke;
        font-weight: 500;
        margin-left: 40px;
        transition: 0.5s;
      }

      .navigation .btnlogin-popup:hover{
        background:transparent;
        color:black;
      }





      .wrapper .active-popup{
        transform: scale(1);
        }

      .wrapper .form-box{
        width: 100%;
        padding: 40px;
      }
      .form-box h2{
        font-size : 2em;
        color: black;
        font-weight: 200;
        text-align: center;

      }
      .btn{
        width :100%;
        height:45px;
        background:steelblue;
        border: none;
        outline: none;
        border-radius: 6px;
        border: 2px solid steelblue;
        cursor: pointer;
        font-size: 1em;
        color: #fff;
        font-weight: 500;

      }
      .btn:hover{
        color:steelblue;
        background-color:transparent;
      }

      .wrapper .icon-close{
        position: absolute;
        top:0;
        right:0;width: 45px;
        height :45px;
        background-color:black;
        font-size: 2em;
        color: whitesmoke;
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom-left-radius: 20px;
        

        

      }

      .wrapper{
        position: relative;
        width: 320px;
        height:350px;
        background: transparent;
        border:2px solid rgba(255,255,255,.5);
        border-radius: 20px;
        backdrop-filter: blur(20px);
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
        display: flex;
        align-items: center;
        transform: scale(1);
        overflow: hidden;
      
        
      }

      .wrapper .form-box{
        width: 100%;
        padding: 40px;
      }

      .form-box h2{
        font-size : 2em;
        color: #162938;
        text-align: center;

      }

      .input-box {
        position: relative;
        width:100%;
        height:50px;
        border-bottom: 3px solid #162938;
        margin: 10px 0;
      }

      .input-box label{
        position: absolute;
        top:50%;
        left:5px;
        transform: translate(-50%);
        font-size: 1em;
        color:#162938;
        font-weight: 500;
        pointer-events: none;
      }

      .input-box input{
        width: 100%;
        height: 140%;
        background: transparent;
        border: none;
        outline : none;
        
      }

      .input-box input:focus~label,
      .input-box input:valid ~ label{
        top:-5px ;
      }




</style>


<body>
  <header>
  
  
    <h2 class="logo">AquaDB</h2>
    <nav class="navigation">
      
     <a href="logout1.php" ><button class="btnlogin-popup">Back</button></a>
    </nav>
    
  </header>
  
<div class="wrapper">
   

    
  
    <div class="form-box login">
      
      <h2>Manager login</h2><br>
      <form action=""  method="POST">
        <div class="input-box">
          <span class="icon"></span>
          <input type="number" name="lsid" required style="font-size: 1em;">
          <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UserID</label>
        </div>  
        <div class="input-box">
          <input type="Password" name="lspass" style="font-size: 1em;" required>
          <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password</label>
        </div>
        <div class="remember-forgot">
          
          <a href="#" style="color: steelblue;">Forgot Password?</a><br><br>
          <label><input type="checkbox">Remember me</label>

        </div><br>
        <button class="btn" name="submitq" type="submit" value="Login">Login</button>
        

        <span><?php echo $error; ?></span>
      </form>
    </div>
  </div>
  
  


</body>
</html>
