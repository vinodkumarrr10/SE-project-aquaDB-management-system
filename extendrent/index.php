<!DOCTYPE html>
<html>
<?php 
session_start(); 
require 'connection2.php';

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AquaDB Rentals</title>

   
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"> -->
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
            background-size: cover;
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
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Customer id: <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> STATUS <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturnitem.php">Update Return</a></li>
              <li> <a href="mybookings.php">Bookings</a></li>
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
                        <a href="logout2.php">Inventory Home</a>
                    </li>
                    <!-- <li>
                        <a href="clientlogin.php">Employee</a>
                    </li> -->
                    <li>
                        <a href="customerlogin.php">Customer</a>
                    </li>
                    <!-- <li>
                        <a href="faq/index.php"> FAQ </a>
                    </li> -->
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- <div class="bgimg-1"> -->
    <div class="#">
        <header class="intro">
            <div class="intro-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading" style="color: black">AquaDB Rentals</h1>
                            
                            <a href="#sec2" class="btn btn-circle page-scroll blink" style="color: steelblue;">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div id="sec2" style="color: #777;background-color:transparent;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;" style="color: steelblue;">Available Products😄</h3>
<br>
        <section class="menu-content">
            <?php   
            
            $sql1 = "SELECT * FROM Inventory_items WHERE rent_availability='yes'";
            $result1 = mysqli_query($conn,$sql1);

            if(mysqli_num_rows($result1) > 0) {
                while($row1 = mysqli_fetch_assoc($result1)){
                    $item_id = $row1["item_id"];
                    $item_name = $row1["item_model"];
                    
                    $non_ac_price_per_day = $row1["rent_price"];
                    $description = $row1["description"];
               
                    ?>
            <a href="booking.php?id=<?php echo($item_id) ?>">
            <div class="sub-menu">
            

            <p class="card-img-top" src="<?php echo $description; ?>" alt="Card image cap"><?php echo $description; ?> </p>
            <h5><b> <?php echo $item_name; ?> </b></h5>
            
            <h6> Rent Price: <?php echo ("Rs. " . $non_ac_price_per_day . "/-day \n additional Rs." . ($non_ac_price_per_day/5). "/- day"); ?></h6>

            
            </div> 
            </a>
            <?php }}
            else {
                ?>
                <h1> No Products available🫤</h1>
                <?php
            }
            ?>                                   
        </section>
                    
    </div>

  
    
    <!-- Container (Contact Section) -->
    <!-- -->
   
    <!-- <script>
        function sendGaEvent(category, action, label) {
            ga('send', {
                hitType: 'event',
                eventCategory: category,
                eventAction: action,
                eventLabel: label
            });
        };
    </script> -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="assets/js/theme.js"></script>
</body>

</html>