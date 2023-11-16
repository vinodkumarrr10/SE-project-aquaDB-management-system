<!DOCTYPE html>
<html>
<?php 
include('session_customer.php');
if (!isset($_SESSION['login_customer'])) {
    session_destroy();
    header("location: customerlogin.php");
}
?>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"></script>
    
    
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
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
<body ng-app="">
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    AquaDB Rentals
                </a>
            </div>

            <?php
            if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="glyphicon glyphicon-user"></span> CUSTOMER ID: <?php echo $_SESSION['login_customer']; ?>
                        </a>
                    </li>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Store <span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="prereturnitem.php">Update Return</a>
                                </li>
                                <li>
                                    <a href="mybookings.php">Bookings</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <li>
                        <a href="logout.php">
                            <span class="glyphicon glyphicon-log-out"></span> Logout
                        </a>
                    </li>
                </ul>
            </div>

            <?php
            } else {
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
            <?php }
            ?>
        </div>
    </nav>
    <br><br>

    <div class="container" style="margin-top: 65px;" >
        <div class="col-md-7" style="float: none; margin: 0 auto;" >
            <div class="form-area" style="background-color: whitesmoke;border:2px solid black;">
                <form role="form" action="bookingconfirm.php" method="POST">
                    <br style="clear: both">
                    <br>

                    <?php
                    $item_id = $_GET["id"];
                    $sql1 = "SELECT * FROM Inventory_Items WHERE item_id = '$item_id'";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $item_name = $row1["item_model"];
                            $item_id = $row1["item_id"];
                            $non_ac_price_per_day = $row1["rent_price"];
                        }
                    }
                    ?>

                    <h5> Product Model:&nbsp;  <b><?php echo($item_name);?></b></h5>
                    <h5> Product ID:&nbsp;<b> <?php echo($item_id);?></b></h5>

                    <label><h5>Start Date:</h5></label>
                    <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
                    &nbsp; 
                    <label><h5>End Date:</h5></label>
                    <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">

                    <label><h5>Choose rental type:</h5></label>
    <input onclick="reveal()" type="radio" name="radio" value="ac" ng-model="myVar"> <b>With coolie</b>&nbsp;
    <input onclick="reveal()" type="radio" name="radio" value="non_ac" ng-model="myVar"><b>Without coolie</b>

    <div ng-switch="myVar">
        <div ng-switch-when="ac">
            <h5>Charges (with coolie): <b><?php echo("Rs. " . $non_ac_price_per_day + 150 . "/- day and Rs. " . ($non_ac_price_per_day/5) . "/- for additional days");?></b></h5>
            <!-- Show the "Select Coolie" drop-down only when "With coolie" is selected -->
            <label>Select Coolie:</label>
            <select name="employee_id_from_dropdown" ng-model="myVar1">
                <?php
                $sql2 = "SELECT * FROM Employees d WHERE d.rent_service = 'yes'";
                $result2 = mysqli_query($conn, $sql2);

                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $employee_id = $row2["employee_id"];
                        $employee_name = $row2["employee_name"];
                        $employee_phone = $row2["employee_phone"];
                ?>
                        <option value="<?php echo($employee_id); ?>"><?php echo($employee_name); ?></option>
                <?php
                    }
                } else {
                ?>
                    <option value="">No Coolies available</option>
                <?php
                }
                ?>
            </select>
        </div>
        <div ng-switch-when="non_ac">
            <h5>Charges (without coolie): <b><?php echo("Rs. " . $non_ac_price_per_day . "/- day and Rs. " . $non_ac_price_per_day/5 . "/- for additional days");?></b></h5>
        </div>
    </div>
                       
                        
                        <br><br>
                        
                        <!-- Select Coolie: &nbsp;
                        <select name="employee_id_from_dropdown" ng-model="myVar1">
                            <?php
                            $sql2 = "SELECT * FROM Employees d WHERE d.rent_service = 'yes'";
                            $result2 = mysqli_query($conn, $sql2);

                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    $employee_id = $row2["employee_id"];
                                    $employee_name = $row2["employee_name"];
                                    $employee_phone = $row2["employee_phone"];
                            ?>

                            <option value="<?php echo($employee_id); ?>"><?php echo($employee_name); ?>

                            <?php }} else {
                            ?>
                            Sorry! No Coolies are currently available, try again later...
                            <?php
                            }
                            ?>
                        </select> -->

                     
                        <input type="hidden" name="hidden_carid" value="<?php echo $item_id; ?>">
                        <input type="submit" name="submit" value="CONFIRM" class="btn btn-warning pull-right" style="display: block; margin: 0 auto;border :2px solid orange">

                    </form>
                </div>
                <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                    <h6><strong>Note:</strong> You will be charged with extra <span class="text-danger">Rs. 200/-</span> for each day after the due date ends.</h6>
                </div>
            </div>
        </body>
        
        <script>
            function reveal(){
                console.log('clicked')
            }
        </script>
        </html>
