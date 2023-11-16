<?php
include('login_customer.php'); // Includes Login Script

if(isset($_SESSION['login_customer'])){
header("location: index.php"); //Redirecting
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title> Customer Login | AquaDB Rental </title>
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
    
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
   
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
   

    <body background="#">
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
                                <a href="#"><span class="glyphicon glyphicon-user"></span>CUSTOMER ID: <?php echo $_SESSION['login_customer']; ?></a>
                            </li>
                            <li>
                                <a href="#">History</a>
                            </li>
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
            <div class="#" style="background-color: transparent" style="font-weight: 100;"><br>
            <h1 class="text-center">AquaDB Rentals - Customer Panel </span>
                </h1>
                <br>
                <p class="text-center">Enter <b>REGISTERED MOBILE NUMBER</b> to continue.</p>
            </div>
        </div>

        <div class="container" style="margin-top: -1%; margin-bottom: 2%; margin-left: 6%">
            <div class="col-md-5 col-md-offset-4">
                <label style="margin-left: 5px;color: red;"><span> <?php echo $error;  ?> </span></label>
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color: steelblue;"> Login </div>
                    <div class="panel-body">

                        <form action="" method="POST">

                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <label for="customer_phone"><span class="text-danger" style="margin-right: 5px;">*</span>Phone Number: </label>
                                    <div class="input-group">
                                        <input class="form-control" id="customer_phone" type="text" name="customer_phone" placeholder="enter Mobile Number" required="" autofocus="">
                                        <span class="input-group-btn">
                <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true" style="font-size: smaller;"></label>
            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            

                            <div class="row">
                                <div class="form-group col-xs-4">
                                    <button class="btn btn-primary" name="submit" type="submit" value=" Login " style="background-color: steelblue;"> Submit</button>

                                </div>

                            </div>
                            <label style="margin-left: 5px;">or</label> <br>
                            <label style="margin-left: 5px;"><a href="customersignup.php" style="color: steelblue;">Unregistered Customer?</a></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>


    </html>