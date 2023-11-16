<!DOCTYPE html>
<html>
<?php 
session_start();
require 'connection2.php';
// $conn = Connect();
?>
<head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">    
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>

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
            background: url('marble2.jpg') ;
            background-size: auto;
            background-position: center;
        }
</style>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="index.php">
                   AquaDB Rentals </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
               if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> CUSTOMER ID: <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Status <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturnitem.php">Return Update</a></li>
              <li> <a href="mybookings.php"> Booking Status</a></li>
            </ul>
            </li>
          </ul>
                    <li>
                        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </li>
                </ul>
            </div>

            <?php
            }
                else {
            ?>

            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                   
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
 
<?php $login_customer = $_SESSION['login_customer']; 

    $sql1 = "SELECT c.item_model, rc.rent_start_date, rc.rent_end_date, rc.total_amount, rc.id FROM rentpro rc, Inventory_Items c
    WHERE rc.customer_phone='$login_customer' AND c.item_id=rc.item_id AND rc.return_status='NR'";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
?>
<div class="container">
      <div class="jumbotron" style="background-color: steelblue; color:whitesmoke">
        <h1 class="text-center">Update Return Products Here</h1>
        
      </div>
    </div>

    <div class="table-responsive" style="padding-left: 120px; padding-right: 120px;" >
<table class="table table-striped">
  <thead class="thead-dark">
<tr style="background-color: black; color:whitesmoke">
<th width="20%">Item Model</th>
<th width="20%">Rent Start Date</th>
<th width="20%">Rent End Date</th>
<th width="20%">Charges</th>
<th width="20%">Action</th>
</tr>
</thead>
<?php
        while($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row["item_model"]; ?></td>
<td><?php echo $row["rent_start_date"] ?></td>
<td><?php echo $row["rent_end_date"]; ?></td>
<td>Rs. <?php echo $row["total_amount"]; ?>/-</td>
<!-- <td>Rs. <?php 
    if($row["charge_type"] == "days"){
        echo ($row["fare"] . "/day");
    } else {
        echo ($row["fare"] . "/km");
    }
 

?></td> -->
<td><a href="returnitem.php?id=<?php echo $row["id"];?>"> Return </a></td>
</tr>
<?php        } ?>
                </table>
                </div> 
        <?php } else {
            ?>
            <div class="container">
      <div class="jumbotron">
        <h1 class="text-center">No Rentals to return.</h1>
       
      </div>
    </div>

            <?php
        } ?>   

</body>

</html>