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
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;
            
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
                        <a href="#"><span class="glyphicon glyphicon-user"></span>CUSTOMER ID:<?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">STATUS<span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturnitem.php">Return Update</a></li>
              <li> <a href="mybookings.php">BOOKING Status</a></li>
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
                    
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<body>

<?php 
$id = $_GET["id"];
$distance = NULL;
$distance_or_days = $conn->real_escape_string($_POST['distance_or_days']);
$fare = $conn->real_escape_string($_POST['hid_fare']);
// $total_amount = $distance_or_days * $fare;
$item_return_date = date('Y-m-d');
$return_status = "R";
$login_customer = $_SESSION['login_customer'];

$sql0 = "SELECT rc.id, rc.rent_end_date, rc.rent_start_date, rc.total_amount,c.item_model, c.item_id FROM rentpro rc, Inventory_Items c WHERE id = '$id' AND c.item_id = rc.item_id";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
            $rent_end_date = $row0["rent_end_date"];  
            $rent_start_date = $row0["rent_start_date"];
            $total_amount = $row0["total_amount"];
            $item_name = $row0["item_model"];
            $item_id = $row0["item_id"];
            

            
            // $charge_type = $row0["charge_type"];
    }
}

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

$extra_days = dateDiff("$rent_end_date", "$item_return_date");
$total_fine = $extra_days*200; //200 per day fine

$duration = dateDiff("$rent_start_date","$rent_end_date");

if($extra_days>0) {
    $total_amount = $total_amount + $total_fine;  
}



$no_of_days = $distance_or_days;
$sql1 = "UPDATE rentpro SET item_return_date='$item_return_date', no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
$result1 = $conn->query($sql1);
$check="select employee_id from rentpro where id = '$id'";
$res99=$conn->query($check);

if ($result1 && $res99){
     $sql2 = "UPDATE Inventory_Items c, Employees d, rentpro rc SET c.rent_availability='yes', d.rent_service='yes' 
     WHERE rc.item_id=c.item_id AND rc.employee_id=d.employee_id AND rc.customer_phone= '$login_customer' AND rc.id = '$id'";
     $result2 = $conn->query($sql2);
}
else if($result1 && !($res99)){
    $sql2 = "UPDATE Inventory_Items c, rentpro rc SET c.rent_availability='yes'
    WHERE rc.item_id=c.item_id  AND rc.customer_phone= '$login_customer' AND rc.id = '$id'";
    $result2 = $conn->query($sql2);

}
else {
    echo $conn->error;
}
?>

    <div class="container">
        <div class="jumbotron" style="background-color: transparent;">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>Product Returned</h1>
        </div>
    </div>
    <br>

  
    <h3 class="text-center"> <strong>Rental Invoice Number:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <h5 class="text-center">Rental information</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
               
               
                <h3 style="color: orange;">Invoice</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Item Name: </strong> <?php echo $item_name;?></h4>
                <br>
                <h4> <strong>item ID:</strong> <?php echo $item_id; ?></h4>
                <br>
                <h4> <strong>Charge:&nbsp;</strong>  Rs. <?php 
            
            echo ($fare . "/- per day");
            ?></h4>
                <br>
                <h4> <strong>Charges for additonal days:&nbsp;</strong>  Rs. <?php 
            
            echo ($fare/5 . "/- per day");
            ?></h4>
                <br>
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Rent End Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>Product Return Date: </strong> <?php echo $item_return_date; ?> </h4>
                <br>
                <!-- <?php if($charge_type == "days"){?>
                    <h4> <strong>Number of days:</strong> <?php echo $distance_or_days; ?>day(s)</h4>
                <?php } else { ?>
                    <h4> <strong>Distance Travelled:</strong> <?php echo $distance_or_days; ?>km(s)</h4>
                <?php } ?> -->
                <h4> <strong>Number of days:</strong> <?php echo $distance_or_days; ?>day(s)</h4>
                <br>
                <?php
                    if($total_fine > 0){
                        
                ?>
                <h4> <strong>Total Fine:</strong> <label class="text-danger"> Rs. <?php echo $total_fine; ?>/- </label> for <?php echo $extra_days;?> extra days.</h4>
                <br>
                <?php } ?>
                <?php
                    if($total_fine <= 0){
                        
                ?>
                <h4> <strong>Total Fine :</strong> <label class="text-danger"> Nil </label> </h4>
                <br>
                <?php } ?>
                <h4> <strong>Total Amount: </strong> Rs. <?php echo $total_amount; ?>/-     </h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
        </div>
    </div>

</body>

</html>