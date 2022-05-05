<?php 
    session_set_cookie_params(0);
    session_start();
    include("connection.php");
    include("functions.php");
?>

<html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Aqua Pools Swimming Club</title>
    <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/simplegrid.css">
        <link rel="stylesheet" href="css/icomoon.css">
        <link rel="stylesheet" href="css/lightcase.css">
        <link rel="stylesheet" href="js/owl-carousel/owl.carousel.css" />
        <link rel="stylesheet" href="js/owl-carousel/owl.theme.css" />
        <link rel="stylesheet" href="js/owl-carousel/owl.transitions.css" />
        <link rel="stylesheet" href="style.css">

        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <style>  
        div.hero {
            opacity: 0.8;
        }
        #myHeader {
                background-color: rgb(60, 150, 181);
                color: rgb(246, 244, 244);
                padding: 40px;
                text-align: center;
                font-size: 25px;
        }
    </style>
  
  </head>
    </head>
    <body  style="background-image: url('images/hero_1.jpg') ; background-repeat: no-repeat; background-size: cover; background-attachment: fixed ">
        <!--<img alt = "swimming pool" src="https://images.unsplash.com/photo-1576610616656-d3aa5d1f4534?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=435&q=80"><br>-->
        <!--<a href = 'logout.php'>Log Out</a>-->
            <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
        </div>
        
        <header class="site-navbar" role="banner">

        <div class="container">
            <div class="row align-items-center">
            
            <div class="col-11 col-xl-2">
                <h1 class="mb-0 site-logo"><a href="index.php" class="text-white mb-0">Aqua Pools</a></h1>
            </div>
            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                    <?php
                    if(isset($_SESSION['userid'])){
                    echo '<li class="active"><a href="index.php"><span>Home</span></a></li>
                    <li><a href="profile.php"><span>Profile Page</span></a></li>
                    <li><a href="booking.php"><span>Book your slot</span></a></li>
                    <li><a href="pass.php"><span>Monthly Pass</span></a></li>
                    <li><a href="contact.php"><span>Contact</span></a></li>
                    <li><a href="logout.php"><span>Log out</span></a></li>';
                    }
                    else
                    {
                        echo '<li class="active"><a href="index.php"><span>Home</span></a></li>
                        <li><a href="login.php"><span>Login</span></a></li>
                        <li><a href="signup.php"><span>Sign Up</span></a></li>';
                    }
                    ?>
                </ul>
                </nav>
            </div>


            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

            </div>

            </div>
        </div>
        
        </header>
        
        <br> <br><br> <br><br> <br><br> <br>

        <div >
                <div class="grid grid-pad"  style="background-color: lightblue; opacity: 0.9;border-radius: 80px 20px;">
                    <div class="col-1-1">
                         <div class="content content-header" >
                         <br> <p style="font-weight: bold; font-size: 60px; color: grey;">&emsp;Welcome to Aqua Pools &emsp;</h2>
                         <br> <br><br> <p style="font-family: Cambria, Helvetica, sans-serif; color: #4646d2; font-size: 20px; font-weight: bold;">Aqua pools is the first local swimming pool of this locality built over a decade ago. We promise to provide all the members of the Aqua Pools club with a large, clean and safe swimming pool for both adults and children. </p>
                            <br> <a style="font-family: Arial, Helvetica, sans-serif; color: navy; font-weight: bold; font-size: 16px;" target="_blank" class="btn btn-ghost" href="contact.php">Contact us</a>
                        </div>
                    </div>
                </div>
            </div><br> <br><br> 
 <!-- Services Section -->
 <div class="wrap services-wrap" id="services" style="background-color: lightblue; opacity: 0.9;margin-bottom: 100px;
  margin-right: 150px;border-radius: 80px 20px;">
                <section class="grid grid-pad services">
                    <h2>Our Services</h2>
                    <div class="col-1-4 service-box service-1" >
                        <div class="content">
                            <div class="service-icon">
                                <i class="circle-icon icon-heart4"></i>
                            </div>
                            <div class="service-entry">
                                <h3>Lifeguards </h3>
                                <p style="font-family: Arial, Helvetica, sans-serif; color: navy;">We put safety of the members of the club at most importance. We have at least 2 trained and experienced lifeguards watching the pools at all times.</p>
                             </div>
                        </div>
                    </div>
                    <div class="col-1-4 service-box service-2" >
                        <div class="content">
                            <div class="service-icon">
                                <i class="circle-icon icon-star4"></i>
                            </div>
                            <div class="service-entry">
                                <h3>Accessories</h3>
                                <p style="font-family: Arial, Helvetica, sans-serif; color: navy;">We provide members many kinds of accessories like swimming fins, swimming goggles, shorts etc... for no extra cost.</p>
                                </div>
                        </div>
                    </div>
                    <div class="col-1-4 service-box service-3">
                        <div class="content">
                            <div class="service-icon">
                                <i class="circle-icon icon-user6"></i>
                            </div>
                            <div class="service-entry">
                                <h3>Showers</h3>
                                <p style="font-family: Arial, Helvetica, sans-serif; color: navy;">We provide private room to shower after swimming in the chlorine mixed water.</p>                           
                            </div>
                        </div>
                    </div>
                    <div class="col-1-4 service-box service-4" >
                        <div class="content">
                            <div class="service-icon">
                                <i class="circle-icon icon-display"></i>
                            </div>
                            <div class="service-entry">
                                <h3>Locker and Parking facility</h3>
                                <p style="font-family: Arial, Helvetica, sans-serif; color: navy;"> We provide members with large locker facility with locks and parking facility for no extra cost.</p>
                               </div>
                        </div>
                    </div>
                </section>
            </div>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/main1.js"></script>
    </body>
</html>