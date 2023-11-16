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
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Status <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="returncar.php">Return Update</a></li>
              <li> <a href="mybookings.php">booking Status</a></li>
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
                    <!-- <li>
                        <a href="clientlogin.php">Employee</a>
                    </li> -->
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <li>
                        <a href="#"> FAQ </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}


 $id = $_GET["id"];
 $check="select employee_id from rentpro where id = '$id'";
$res99=$conn->query($check);
 if($res99){
    $sql1 = "SELECT c.item_model, c.item_id, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.total_amount,d.employee_name, d.employee_phone
    FROM rentpro rc, Inventory_Items c, Employees d
    WHERE id = '$id' AND c.item_id=rc.item_id AND d.employee_id = rc.employee_id";
    $result1 = $conn->query($sql1);
    if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {
            $car_name = $row["item_model"];
            $car_nameplate = $row["item_id"];
            $driver_name = $row["employee_name"];
            $driver_phone = $row["employee_phone"];
            $rent_start_date = $row["rent_start_date"];
            $rent_end_date = $row["rent_end_date"];
            $fare = $row["fare"];
            $total_amount = $row["total_amount"];
        
            $no_of_days = dateDiff("$rent_start_date", "$rent_end_date");
        }
    }
 }
 else if (!$res99) {
    $sql1 = "SELECT c.item_model, c.item_id, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.total_amount
             FROM rentpro rc
             INNER JOIN Inventory_Items c ON c.item_id = rc.item_id
             WHERE rc.id = '$id'";

    $result1 = $conn->query($sql1);

    if ($result1 && $result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $car_name = $row["item_model"];
            $car_nameplate = $row["item_id"];
            $driver_name = "not applicable";
            $driver_phone = "not applicable";
            $rent_start_date = $row["rent_start_date"];
            $rent_end_date = $row["rent_end_date"];
            $fare = $row["fare"];
            $total_amount = $row["total_amount"];

            $no_of_days = dateDiff($rent_start_date, $rent_end_date);
        }
    }
}

?>
    <div class="container" style="margin-top: 65px;" >
    <div class="col-md-7" style="float: none; margin: 0 auto;">
      <div class="form-area">
        <form role="form" action="printbill.php?id=<?php echo $id ?>" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 5px; text-align: center; font-size: 30px;"> Rental Details </h3>
          

           <h5> Item Model:&nbsp;  <?php echo($car_name);?></h5>

           <h5> Item ID:&nbsp;  <?php echo($car_nameplate);?></h5>

           <h5> Rent date:&nbsp;  <?php echo($rent_start_date);?></h5>

           <h5> End Date:&nbsp;  <?php echo($rent_end_date);?></h5>

           <h5> Total Rent Charges:&nbsp;  <?php echo($total_amount);?>/-</h5>

           <!-- <h5> Fare:&nbsp;  Rs. <?php 
            if($charge_type == "days"){
                    echo ($fare . "/day");
                } else {
                    echo ($fare . "/km");
                }
            ?>
            </h5> -->

           <h5> coolie Name:&nbsp;  <?php echo($driver_name);?></h5>

           <h5> Coolie Contact:&nbsp;  <?php echo($driver_phone);?></h5>
          <?php if($charge_type == "km") { ?>
          <div class="form-group">
            <input type="text" class="form-control" id="distance_or_days" name="distance_or_days" placeholder="Enter the distance travelled (in km)" required="" autofocus>
          </div>
          <?php }  else { ?>
            <h5> Number of Day(s):&nbsp;  <?php echo($no_of_days);?></h5>
            <input type="hidden" name="distance_or_days" value="<?php echo $no_of_days; ?>">
          <?php } ?>
          <input type="hidden" name="hid_fare" value="<?php echo $fare; ?>">

           <input type="submit" name="submit" value="submit" class="btn btn-success pull-right">    
        </form>
      </div>
    </div>
   
    </div>

</body>

</html>