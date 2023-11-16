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
    width:100%;padding:20px 100px;
    
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




.wrapper{
  position: relative;
  width: 250px;
  height:270px;
  background: transparent;
  border:2px solid black;
  border-radius: 20px;
  backdrop-filter: blur(20px);
  box-shadow: 0 0 30px rgba(0, 0, 0, .5);
  display: flex;
  align-items: center;
  transform: scale(1);
  overflow: hidden;
 
  
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
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  border-bottom-left-radius: 20px;
  

  

 }


</style>


<body>
  <header>
  
  
    <h2 class="logo">AquaDB Management System</h2>
    <nav class="navigation">
      <a href="index.php">Home</a>
      <a href="notifications.php">Notifications</a>
      <a href="analytics.php">Product Analytics</a>
      
      <button class="btnlogin-popup">login</button>
    </nav>
    
  </header>
  <div class="wrapper">
    <span class="icon-close">
    <ion-icon name="close-outline"></ion-icon>

    </span>
  
    <div class="form-box login">
      
      <h2>User type</h2><br>
      <a href="admin/adminlogin.php"> <button class="btn">Manager Login</button></a><br><br>
      <a href="inventorylogin.php"> <button class="btn">Inventory Login</button></a><br><br>
      <a href="employee/emplogin.php"> <button class="btn">Employee Login</button></a>
    </div>
  </div>
  <!--script>
  const wrapper = document.querySelector('.wrapper');
  const btnpopup = document.querySelector('.btnlogin-popup');
  const iconClose = document.querySelector('.icon-close');
  btnpopup.addEventListener('click',()=>{
    wrapper.classList.add('active-popup');
  });

  btnpopup.addEventListener('click',()=>{
    wrapper.classList.add('active-popup');
  });

  iconClose.addEventListener('click',()=>{
    wrapper.classList.remove('active-popup');
  });
 
  
</script-->
  
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  


</body>
</html>
