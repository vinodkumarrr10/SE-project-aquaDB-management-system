<!DOCTYPE html>
<html>

<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body>
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
            background-size: cover;
            background-position: auto;
        }
</style>

<?php


    $type = $_POST['radio'];
    // $charge_type = $_POST['radio1'];
    $employee_id = $_POST['employee_id_from_dropdown'];
    $customer_username = $_SESSION["login_customer"];
    $item_id = $conn->real_escape_string($_POST['hidden_carid']);
    $rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $return_status = "NR"; // not returned
    $fare = "NA";


    function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    
    $err_date = dateDiff("$rent_start_date", "$rent_end_date");

    $sql0 = "SELECT * FROM Inventory_Items WHERE item_id = '$item_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while($row0 = mysqli_fetch_assoc($result0)) {

            if($type == "ac"){
                $fare = $row0["rent_price"]+150;
           
            } else if ($type == "non_ac"){
                $fare = $row0["rent_price"];
           
            } else {
                $fare = "NA";
            }
        }
    }
    if($err_date >= 0) { 
    if($type=="ac"){
        $sql1 = "INSERT into rentpro(customer_phone,item_id,employee_id,booking_date,rent_start_date,rent_end_date,fare,return_status,no_of_days,total_amount) 
        VALUES('" . $customer_username . "','" . $item_id . "','" . $employee_id . "','" . date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" . $fare . "','" . $return_status . "','" . $err_date . "','" . $fare+(($fare/5)*($err_date-1)) . "')";
        $result1 = $conn->query($sql1);
    
   

        $sql2 = "UPDATE Inventory_Items SET rent_availability = 'no' WHERE item_id = '$item_id'";
        $result2 = $conn->query($sql2);

        $sql3 = "UPDATE Employees SET rent_service = 'no' WHERE employee_id = '$employee_id'";
        $result3 = $conn->query($sql3);

        $sql4 = "SELECT * FROM  Inventory_Items c, Employees d, rentpro rc WHERE c.item_id = '$item_id' AND d.employee_id = '$employee_id'";
        $result4 = $conn->query($sql4);
    }
    else if($type=="non_ac"){
        $sql1 = "INSERT into rentpro(customer_phone,item_id,booking_date,rent_start_date,rent_end_date,fare,return_status,no_of_days,total_amount) 
        VALUES('" . $customer_username . "','" . $item_id . "','" . date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" . $fare . "','" . $return_status . "','" . $err_date . "','" . $fare+(($fare/5)*($err_date-1)) . "')";
        $result1 = $conn->query($sql1);
    
   

        $sql2 = "UPDATE Inventory_Items SET rent_availability = 'no' WHERE item_id = '$item_id'";
        $result2 = $conn->query($sql2);

        // $sql3 = "UPDATE Employees SET rent_service = 'no' WHERE employee_id = '$employee_id'";
        // $result3 = $conn->query($sql3);

        $sql4 = "SELECT * FROM  Inventory_Items c, rentpro rc WHERE c.item_id = '$item_id' ";
        $result4 = $conn->query($sql4);
    }

    if($type=="ac"){
        if (mysqli_num_rows($result4) > 0) {
            while($row = mysqli_fetch_assoc($result4)) {
                $id = $row["id"];
                $item_name = $row["item_model"];
                $item_id = $row["item_id"];
                $employee_name = $row["employee_name"];
                $employee_id = $row["employee_id"];
                $employee_phone = $row["employee_phone"];

            }
        }
        if (!$result1 | !$result2 | !$result3){
            die("Couldnt enter data: ".$conn->error);
        }
    }
    else if($type=="non_ac"){
        if (mysqli_num_rows($result4) > 0) {
            while($row = mysqli_fetch_assoc($result4)) {
                $id = $row["id"];
                $item_name = $row["item_model"];
                $item_id = $row["item_id"];
                $employee_name = "not applicable";
                // $employee_id = "";
                $employee_phone = "not applicable";

            }
        }
        if (!$result1 | !$result2 ){
            die("Couldnt enter data: ".$conn->error);
        }
    }

    

?>
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
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">STATUS <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturnitem.php">Return Now</a></li>
              <li> <a href="mybookings.php"> My Bookings</a></li>
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
                    <!-- <li>
                        <a href="#"> FAQ </a>
                    </li> -->
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
        <div class="jumbotron" style="background-color:transparent">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>Rental Confirmed.</h1>
        </div>
    </div>
    <br>

   

 

    <h3 class="text-center"> <strong>Booking id:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <h5 class="text-center">Rental Information</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">Booking confirmed and placed into out order processing system.</h3>
                <br>
               
                <br>
                <h3 style="color:green;"><u>RENTAL INVOICE</u></h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>PRODUCT NAME: </strong> <?php echo $item_name; ?></h4>
                <br>
                <h4> <strong>PRODUCT ID:</strong> <?php echo $item_id; ?></h4>
                <br>
                
                <!-- <?php     
                if($charge_type == "days"){
                ?>
                     <h4> <strong>PRICE:</strong> Rs. <?php echo $fare; ?>/day</h4>
                <?php } else {
                    ?>
                    <h4> <strong>PRICE:</strong> Rs. <?php echo $fare; ?>/km</h4>

                <?php } ?> -->
                <h4> <strong>Rental Charges:</strong> Rs. <?php echo $fare+($fare/5)*($err_date-1); ?>/- </h4>

                <br>
                <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Return Date: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>Coolie Name: </strong> <?php echo $employee_name; ?> </h4>
                <br>
                <h4> <strong>Coolie Contact:</strong>  <?php echo $employee_phone; ?></h4>
                <br>
               
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Warning! <strong>Do not reload this page</strong></h6>
        </div>
    </div>
</body>
<?php } else { ?>
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
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garagge <span class="caret"></span> </a>
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
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        You have selected an incorrect date.
        <br><br>
</div>
                <?php } ?>

</html>