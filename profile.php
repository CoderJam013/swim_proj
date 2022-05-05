<?php 
    session_set_cookie_params(0);
    session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
?>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

        <link rel="stylesheet" href="fonts/icomoon/style.css">

        <link rel="stylesheet" href="css/owl.carousel.min.css">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <link rel="stylesheet" href="css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

        <title>Profile Page</title>

        <style>  
            div.hero {
                opacity: 0.8;
            }
            .myHeader {
                background-color: rgb(60, 150, 181);
                color: rgb(246, 244, 244);
                padding: 40px;
                text-align: center;
                font-size: 25px;
            }
            .myHeader1 {
                background-color: rgb(60, 123, 181);
                color: rgb(246, 244, 244);
                padding: 40px;
                text-align: left;
                font-size: 20px;
            }
            .myDiv {
                background-color: lightblue;
                border-radius: 20px 20px;
                width: 600px;
                font-family: Cambria, Helvetica, sans-serif; font-weight:bold; font-size:19px; color: black;
  border: 3px ;
  border-style: solid;
  border-color: white;
  padding: 10px;
  margin: 40px;
}
.myDiv1 {
                background-color: navy;
                border-radius: 20px 20px;
                width: 200px;
                text-align: center;
                font-family: Cambria, Helvetica, sans-serif; font-weight:bold; font-size:19px;
  border: 3px ;
  border-style: solid;
  border-color: white;
  padding: 10px;
  margin: 40px;
}
        </style>
    </head>
    <body  style="background-image: url('images/hero_1.jpg') ; background-repeat: no-repeat; background-size: cover; background-attachment: fixed">
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
                    <li><a href="index.php"><span>Home</span></a></li>
                    <li class="active"><a href="profile.php"><span>Profile Page</span></a></li>
                    <li><a href="booking.php"><span>Book your slot</span></a></li>
                    <li><a href="pass.php"><span>Monthly Pass</span></a></li>
                    <li><a href="contact.php"><span>Contact</span></a></li>
                    <li><a href="logout.php"><span>Log out</span></a></li>
                </ul>
                </nav>
            </div>


            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

            </div>

            </div>
        </div>
        
        </header>  <br>  <br>  <br><br>
        <div class="grid grid-pad"  style="background-color: lightblue; opacity: 0.9;border-radius: 70px 20px; margin-left:250px;margin-right:250px; text-align:center;">
                    <div class="col-1-1">
                         <div class="content content-header" >
                        <p style="font-weight: bold; font-size: 60px; color: grey;">Your Profile Details </h2>
                         </div>
                    </div>
                </div>
        <div class="hero"  >
           
            <div id = "details">
                <br>
                <div class = "myDiv"><span>Name:  <?php echo $user_data['Name']?></span><br></div>
                <div class = "myDiv"><span>Username:  <?php echo $user_data['Username']?></span><br></div>
                <div class = "myDiv"><span>Age:  <?php echo $user_data['Age']?></span></div>
                <div class = "myDiv"><span>Gender:  <?php echo $user_data['Gender']?></span></div>
                <div class = "myDiv"><span>Insurance:  <?php echo $user_data['Insurance']?></span></div>
                <div class = "myDiv1"><span><a href = "pass.php">See Pass Details</a></span></div>
            </div>
        </div>
        <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery.sticky.js"></script>
      <script src="js/main.js"></script>
    </body>
</html>